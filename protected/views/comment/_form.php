
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comment-form',
        'action' => Yii::app()->createUrl('comment/create'),
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->hiddenField($model, 'reportID', array('value' => $model->reportID)); ?>
    <div class="form-group">

        <?php echo $form->textArea($model, 'comment', array('rows' => 3, 'cols' => 75, 'class' => 'form-control')); ?>

    </div>

    <?php echo CHtml::submitButton('Comment', array('class' => 'btn btn-primary')); ?>

    <?php $this->endWidget(); ?>
