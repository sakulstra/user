<?php
/**
 * User: lukas Strassel
 * Date: 06.11.13
 * Time: 11:55
 */
App::uses('CakeEventManager', 'Event');
App::uses('UserListener', 'User.Lib/Event');
CakeEventManager::instance()->attach(new UserListener());