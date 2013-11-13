<?php
/**
 * User: lukas
 * Date: 29.10.13
 * Time: 23:39
 */
?>
<?php echo $this->Session->flash('auth');?>
<h2><?php echo __('Please sign in');?></h2>
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
echo $this->Form->input('password',array('label'=>false,'placeholder'=>__('Password')));
echo $this->Form->input('remember_me',array('type'=>'checkbox','class' => false,'div'=>'checkbox'));
echo $this->Form->submit(__('Sign in'),array('class'=>'btn btn-lg btn-primary btn-block','style'=>'margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;'));
echo $this->Form->end();
?>