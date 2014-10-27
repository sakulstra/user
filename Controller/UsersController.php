<?php
App::uses('UserAppController', 'User.Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends UserAppController {

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('add','login'));
    }

    public function isAuthorized($user = null){
        if($user != null && $this->request->action == 'changePassword'){
            return true;
        }
        return parent::isAuthorized($user);
    }
    /**
     * admin_index method
     *
     * @return void
     */
    public $components = array('Paginator');

    public $helpers = array('Session');

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

    public function changePassword(){
        if($this->request->is('post')){
            //überprüfen ob altes passwort richtig ist
            $this->request->data['User']['id'] = $this->Auth->user('id');
            $this->User->set($this->request->data);
            if($this->User->validates()){
                $user = $this->User->read(null,$this->Auth->user('id'));
                if($user['User']['password']==Security::hash($this->request->data['User']['old_password'], 'blowfish', $user['User']['password'])){
                    if($this->User->save($this->request->data)){
                        $this->redirect($this->Auth->logout());
                    }
                }else{
                    $this->User->invalidate('old_password','Flasches Passwort');
                }
            }
        }
    }

    public function add(){
        $this->layout = 'User.login';
        if($this->request->is('post')){
            $this->User->create();
            if($this->User->save($this->request->data)){
                $this->redirect('/login');
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
    }

    /**
     * Passwortgenerierung
     */
    public function newPassword(){
        if($this->request->is('post')){
            //wenn benutzer existiert
            if($this->User->hasAny(array(
                'User.email'=>$this->request->data['User']['email']))){
                $newpassword = String::uuid();
                $user = $this->User->findByEmail($this->request->data['User']['email']);
                $this->User->id = $user['User']['id'];
                $this->User->saveField('password',$newpassword);
                //debug($this->User);die();
                //$this->User->set(array('User.password'=>$newpassword));
                $this->User->save();
                $email = new CakeEmail('default');
                $email->to($this->request->data['User']['email']);
                $email->subject('Zentraldatei:Ihr Passwort wurde zurück gesetzt.');
                debug($email);
                if($email->send('Hallo ihr neues Passwort lautet:'.$newpassword)){
                    $this->Session->setFlash('Ein neues Passwort wurde generiert und ihnen als Email zugesendet. Bitte überprüfen sie auch ihren Spam-Ordner.');
                }else{
                    $this->Session->setFlash('Fehler beim senden der email.');
                }
            }else{
                $this->Session->setFlash('Ungültige Email-Adresse.');
            }
        }
    }


}
