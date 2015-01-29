<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker'); ?>





    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'report-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    ));
    ?>

    
    
    <?php echo $form->errorSummary($model); ?>

   

    <div class="form-group form-inline">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 100,'class'=>'form-control')); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

     <div class="form-group form-inline">
        <?php echo $form->labelEx($model, 'dateRecorded'); ?>

        <?php
        $this->widget('CJuiDateTimePicker', array(
            'language' => '',
            'model' => $model, // Model object
            'value' => $model->dateRecorded,
            'attribute' => 'dateRecorded', // Attribute name
            'mode' => 'datetime', // Use "time","date" or "datetime" (default)
            'options' => array(), // jquery plugin options
            'htmlOptions' => array('readonly' => true,'class'=>'form-control') // HTML options
        ));
        ?> 
        <?php echo $form->error($model, 'dateRecorded',array('class'=>'form-control')); ?>
    </div>
    
    <div class="form-group form-inline">
        <?php echo $form->labelEx($model, 'presenterID'); ?>
        <?php echo $form->dropDownList($model, 'presenterID',$presenters, array('class'=>'form-control'));?>
        <?php echo $form->error($model, 'presenterID'); ?>
    </div>

    <div class="form-group form-inline">
        <?php echo $form->labelEx($model, 'videoUrl'); ?>
        <?php echo $form->textField($model, 'videoUrl', array('size' => 100, 'readonly'=>'readonly','class'=>'form-control')); ?>
        <?php echo $form->error($model, 'videoUrl'); ?>
    </div>
    
    
    <div class="form-group form-inline">
        
        <?php echo $form->fileField($model, 'videoFile',array('class'=>'btn btn-default'));?>
        
    </div>


        <?php 
        if($model->isNewRecord)
            echo CHtml::submitButton('Create', array('class'=>'btn btn-success'));
        else
            echo CHtml::submitButton('Save', array('class'=>'btn btn-primary'));
        ?>
    


    <?php $this->endWidget(); ?>


