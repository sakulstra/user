<?php
/**
 * User: lukas
 * Date: 30.10.13
 * Time: 10:28
 */
Router::connect('/login', array('plugin'=>'user','controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('plugin'=>'user','controller' => 'users', 'action' => 'logout'));
Router::connect('/register', array('plugin'=>'user','controller' => 'users', 'action' => 'add'));
Router::connect('/changePassword', array('plugin'=>'user','controller' => 'users', 'action' => 'changePassword'));
Router::connect('/newPassword', array('plugin'=>'user','controller' => 'users', 'action' => 'newPassword'));