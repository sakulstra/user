<?php
/**
 * User: lukas
 * Date: 29.10.13
 * Time: 23:59
 */
echo $this->Session->flash('auth');?>
<h2><?php echo __('Please sign up');?></h2>
<?php
echo $this->Form->create('User',array(
    'class'=>'form-signin',
    'inputDefaults'=>array(
        'class'=>'form-control',
        'wrapInput' => false,
        'div' => false,
    )
));
echo $this->Form->input('email',array('label'=>false,'placeholder'=>__('Email adress')));
echo $this->Form->input('username',array('label'=>false,'placeholder'=>__('Max Mustermann'),
    'style'=>'border-bottom-left-radius: 0;border-bottom-right-radius: 0;border-top-left-radius: 0;border-top-right-radius: 0;'));
echo $this->Form->input('password',array('label'=>false,'placeholder'=>__('Password'),
    'style'=>'border-bottom-left-radius: 0;border-bottom-right-radius: 0;border-top-left-radius: 0;border-top-right-radius: 0;'));
echo $this->Form->input('confirmation_password',array('type'=>'password','label'=>false,
    'placeholder'=>__('Re Password'),
    'style'=>'margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;'));
echo $this->Form->submit(__('Sign up'),array('class'=>'btn btn-lg btn-primary btn-block'));
echo $this->Form->end();