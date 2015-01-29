<div class="space">&nbsp;</div>
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                Login
            </h3>

        </div>
        <div class="panel-body">


            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>


            <form role="form">
                <div class="form-group">
                    <label for="LoginForm_username">Username</label>
                    <div >
                        <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Username')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="LoginForm_password">Password</label>
                    <div >
                        <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password')) ?>
                    </div>
                </div>

                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'rememberMe'); ?> Remember me
                    </label>
                </div>
                <?php echo CHtml::submitButton('Login'); ?>
            </form>

            <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
</div>
</div>