<div class="space">&nbsp;</div>
<div class="col-xs-4">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $model->firstName . " " . $model->lastName ." ".CHtml::link("<span class=\"glyphicon glyphicon-pencil\"></span>", array('user/update', 'id' => $model->id)) ?></h3>
        </div>
        <div class="panel-body">
            Username: <?php echo $model->username; ?><br>
            Email: <?php echo CHtml::mailto(CHtml::encode($model->email), $model->email); ?><br>
            Last Login: <?php echo date_format(new DateTime($model->lastLogin), "m/d/y G:ia"); ?>

        </div>
    </div>
</div>


<div class="col-xs-4">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo count($reports);?> Reports</h3>
        </div>
        <div class="panel-body">
            <?php
            foreach ($reports as $r)
                echo "- ".CHtml::link($r->title,array('report/view','id'=>$r->id))."<br>";
            ?>
        </div>
    </div>
</div>



<div class="col-xs-4">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo count($sheets);?> Documents</h3>
        </div>
        <div class="panel-body">
            <?php
            foreach ($sheets as $s)
                echo "- ".CHtml::link($s->name,$s->sheetUrl)."<br>";
            ?>
        </div>
    </div>
</div>