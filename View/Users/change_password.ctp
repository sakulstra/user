<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 21.11.13
 * Time: 11:24
 */
echo $this->Form->create('User',array(
    'class'=>'form-signin',
    'inputDefaults'=>array(
        'class'=>'form-control',
        'wrapInput' => false,
        'div' => false,
        'value'=>'',
        'label'=>false
    )
));
echo $this->Form->input('old_password',array('type'=>'password','placeholder'=>__('Old Password'),
    'style'=>'border-bottom-left-radius: 0;border-bottom-right-radius: 0;'));
echo $this->Form->input('password',array('placeholder'=>__('Password'),
    'style'=>'border-bottom-left-radius: 0;border-bottom-right-radius: 0;border-top-left-radius: 0;border-top-right-radius: 0;'));
echo $this->Form->input('confirmation_password',array('type'=>'password',
    'placeholder'=>__('Confirm Password'),
    'style'=>'margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;'));
echo $this->Form->submit(__('change password'),array('class'=>'btn btn-lg btn-primary btn-block'));
echo $this->Form->end();
?>
    </div>
    <div class="col-lg-4"></div>
</div>