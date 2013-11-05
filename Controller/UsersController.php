<?php
App::uses('UserAppController', 'User.Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends UserAppController {


    /**
     * admin_index method
     *
     * @return void
     */
    public $components = array(
        'Paginator',
        'Security',
        'Session',
        'Cookie',
        'Auth'=>array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                'plugin' => 'user',
                'admin' => false
            ),
            'flash' => array(
                'element' => 'alert',
                'key' => 'auth',
                'params' => array(
                    'plugin' => 'User',
                    'class' => 'alert-danger'
                )
            ),
            'authenticate'=>array(
                'Form'=>array(
                    'passwordHasher' => 'Blowfish',
                    'userModel'=>'User.User',
                    'fields'=>array(
                        'username'=>'email'
                    ),
                    'scope'=>array('User.active' => 1),
                )
            )
        ));

    public $helpers = array('Session');

    public $uses = array('User');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('add','login');
        // set cookie options
        $this->Cookie->key = 'qSI232qsdf&sXSAvaXSL#$%)aq§bOw!adr23e@34$@11~_+!@#HKisasA4""$';
        $this->Cookie->httpOnly = true;

        if (!$this->Auth->loggedIn() && $this->Cookie->read('remember_me_cookie')) {
            $cookie = $this->Cookie->read('remember_me_cookie');

            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $cookie['email'],
                    'User.password' => $cookie['password']
                )
            ));

            if ($user && !$this->Auth->login($user)) {
                $this->redirect('/logout'); // destroy session & cookie
            }
        }
        if($this->Auth->loggedIn())
            $this->set('user',$this->Auth->user());
    }


    public function login(){
        $this->layout = 'User.login';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->request->data['User']['remember_me'] == 1) {
                    // remove "remember me checkbox"
                    unset($this->request->data['User']['remember_me']);

                    // hash the user's password
                    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);

                    // write the cookie
                    $this->Cookie->write('remember_me_cookie', $this->request->data['User'], true, '2 weeks');
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
            }
        }
    }

    public function logout(){
        $this->Cookie->delete('remember_me_cookie');
        return $this->redirect($this->Auth->logout());
    }

    public function add(){
        if($this->request->is('post')){
            $this->User->create();
            if($this->User->save($this->request->data)){
                $this->redirect('/');
            }
        }
    }

    public function admin_index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }}