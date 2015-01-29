<div class="space">&nbsp;</div>

<div class="col-xs-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title">Update Report</h2>
        </div>
        <div class="panel-body">

            <?php echo $this->renderPartial('_form', array('model' => $model, 'presenters' => $presenters, 'sheets' => $sheets, 'sheet' => $sheet)); ?>

        </div>
    </div>
</div>


<div class="col-xs-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title">Attach a document</h2>
        </div>
        <div class="panel-body">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'sheet-form',
                    'action' => Yii::app()->createUrl('sheet/create'),
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('enctype' => 'multipart/form-data')
                ));
                ?>
            

                <p class="note">Please select a file below.</p>
                <?php echo $form->hiddenField($sheet, 'reportID', array('value' => $model->id)); ?>
                <?php echo $form->hiddenField($sheet, 'userID', array('value' => Yii::app()->user->getId())); ?>

                <div class="form-group form-inline">
                    <?php echo $form->fileField($sheet, 'sheetFile', array('class' => 'btn btn-default')); ?>
                </div>



                <?php echo CHtml::submitButton('Attach', array('class' => 'btn btn-primary')); ?>


                <?php $this->endWidget(); ?>
            

        </div>
    </div>
</div>

<div class="col-xs-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title">Existing Documents</h2>
        </div>
        <div class="panel-body">
            <?php
            if (sizeof($sheets) == 0)
                echo "<li class=\"list-group-item\">No documents uploaded yet.</li>";
            foreach ($sheets as $s) {

                echo "<li><a href=\"" . $s->sheetUrl . "\">" . $s->name . "</a> " . CHtml::link("<span class=\"glyphicon glyphicon-remove\" style=\"color:grey\"></span>", array("sheet/delete", "id" => $s->id)) . "</li>";
            }
            ?>
            </ul>    
        </div>
    </div>
</div>

<div class="space">&nbsp;</div>