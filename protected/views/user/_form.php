

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model, array('class' => 'flow-control')); ?>


<div class="form-group form-inline">
    <?php echo $form->labelEx($model, 'username'); ?>
    <?php if ($model->isNewRecord)
        echo $form->textField($model, 'username', array('size' => 50, 'class' => 'form-control'));
    else
        echo $form->textField($model, 'username', array('size' => 50, 'class' => 'form-control', 'readonly' => true));
    ?>
    <?php echo $form->error($model, 'username'); ?>
</div>

<?php if ($model->isNewRecord):?>
<div class="form-group form-inline">
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password', array('size' => 50, 'class' => 'form-control')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<?php endif;?>

<div class="form-group form-inline">
    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model, 'email', array('size' => 50, 'class' => 'form-control')); ?>
    <?php echo $form->error($model, 'email'); ?>
</div>

<div class="form-group form-inline">
    <?php echo $form->labelEx($model, 'firstName'); ?>
    <?php echo $form->textField($model, 'firstName', array('size' => 50, 'class' => 'form-control')); ?>
    <?php echo $form->error($model, 'firstName'); ?>
</div>

<div class="form-group form-inline">
    <?php echo $form->labelEx($model, 'lastName'); ?>
    <?php echo $form->textField($model, 'lastName', array('size' => 50, 'class' => 'form-control')); ?>
    <?php echo $form->error($model, 'lastName'); ?>
</div>

<?php if (User::isAdmin()): ?>
    <div class="form-group form-inline">
        <?php echo $form->labelEx($model, 'userStatus'); ?>
        <?php echo $form->dropDownList($model, 'userStatus', array('0' => 'USER', '1' => 'ADMIN'), array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'userStatus'); ?>
    </div>
<?php endif; ?>

<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>


<?php $this->endWidget(); ?>

