<?php
/**
 * User: lukas
 * Date: 29.10.13
 * Time: 23:59
 */
echo $this->Form->create('User.User');
echo $this->Form->input('username');
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->end(__('Sign up'));