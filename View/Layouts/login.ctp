<?php
/**
 *
 * PHP 5
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    //echo $this->Html->css('cake.generic');
    echo $this->Html->css('bootstrap.min');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body>
<div id="container">
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><?php echo($this->request->action=='login')?
                        $this->Html->link(__('Register'),'/register'):
                        $this->Html->link(__('Login'),'/login');?></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    <div id="content">
        <?php echo $this->Session->flash(); ?>
        <div style="margin:0 auto;width:330px;padding:15px;">
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
</div>
<?php //echo $this->element('sql_dump'); ?>
<?php
echo $this->Html->script(array('jquery.min','bootstrap.min'));
?>
</body>
<style type="text/css">
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
    }
    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin .checkbox {
        font-weight: normal;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
</style>
</html>
