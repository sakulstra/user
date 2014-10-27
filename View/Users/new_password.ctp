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
        echo $this->Form->input('email',array('placeholder'=>__('Email'),
            'style'=>'border-bottom-left-radius: 0;border-bottom-right-radius: 0;border-top-left-radius: 0;border-top-right-radius: 0;'));
        echo $this->Form->submit(__('Passwort anfordern'),array('class'=>'btn btn-lg btn-primary btn-block'));
        echo $this->Form->end();
        echo $this->Html->link('Zurück zum Login','/login');
        ?>
    </div>
    <div class="col-lg-4"></div>
</div>