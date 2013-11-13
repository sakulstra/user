<?php
App::uses('CakeEventListener', 'Event');

class UserListener implements CakeEventListener{

    public function implementedEvents(){
        return array(
            'Controller.App.__construct' => 'loadComponents'
        );
    }

    public function loadComponents(CakeEvent $event){
        $event->subject()->components = array(
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
        return;
    }
}