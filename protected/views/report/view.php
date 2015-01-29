<div class="space">&nbsp;</div>

<div class="row">
    <div class="col-xs-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-heading"><h3 class="title"><?php echo $model->title; ?></h3>
                 <small>- presented by <?php echo$model->getFullName(); ?> on <?php echo date_format(new DateTime($model->dateRecorded), 'l jS F Y'); ?></small> 
        <?php 
        echo CHtml::link("<span class=\"glyphicon glyphicon-thumbs-up\"></span>", array('report/like', 'id' => $model->id))." ";
        if ($model->presenterID == User::currentUser()->id || User::isAdmin()){
            echo CHtml::link("<span class=\"glyphicon glyphicon-pencil\"></span>", array('report/update', 'id' => $model->id))." ";
            echo CHtml::link("<span class=\"glyphicon glyphicon-trash\"></span>", array('report/delete', 'id' => $model->id))." ";
        }?>
        
                    
                </div>
                    
            </div>
            <div class="panel-body">


        <?php if ($model->videoUrl != ''): ?>
            <div class="row" align="center">
                <div id="videoElement"></div>
            </div>

            <div class="row" align="center">
                <div class="btn-group">

<a href="javascript:speed(0.5)"><button type="button" class="btn btn-default">0.5x</button></a>
<a href="javascript:speed(1.0)"><button type="button" class="btn btn-default">1.0x</button></a>
<a href="javascript:speed(1.5)"><button type="button" class="btn btn-default">1.5x</button></a>
<a href="javascript:speed(2.0)"><button type="button" class="btn btn-default">2.0x</button></a>

                    
                </div>

	       </div>
	       <script type="text/javascript">
	       
	       $.ajax(
		      {
		      type: "POST",
			  url: "<?php echo CHtml::normalizeURL(array('report/fetch','t'=>$token));?>",
			  dataType: "script"
			  });

			    
	       function speed(x) {
		 var m = document.getElementById("videoElement").querySelector("video");
		 m.playbackRate = x;
	       }
  </script>
  
        <?php else: ?>
            No video uploaded yet.
        <?php endif ?>
            </div>
        </div>

    </div>

    <div class="col-xs-4">
        <ul class="list-group">
            <li class="list-group-item active" style="color:#fff"><b>Associated Documents</b></li>
            <?php
            if (sizeof($sheets) == 0)
                echo "<li class=\"list-group-item\">No documents uploaded yet.</li>";
            foreach ($sheets as $s) {
                echo "<li class=\"list-group-item\"><a href=\"" . $s->sheetUrl . "\">" . $s->name . "</a></li>";
            }
            ?>



        </ul> 
    </div>
</div>





<div class="space">&nbsp;</div>
<div class="row">
    <div class="col-xs-8">
        <ul class="list-group">
            <li class="list-group-item active" style="color:#fff"><b>Comments</b></li>

            <?php
            foreach ($comments as $c) {
                echo "<li class=\"list-group-item\">" . $c->comment;
                if (User::currentUser()->id == $c->userID || User::isAdmin())
                    echo CHtml::link("<span class=\"glyphicon glyphicon-remove pull-right\" style=\"color:grey\"></span>", array("comment/delete", "id" => $c->id));
                echo "<br><small><i> by " . $c->getAuthor() . ", on " . date_format(new DateTime($c->dateCreated), 'g:ia \o\n l jS F Y') . "</i></small>";
            }
            ?>
        </ul>


        <?php echo $this->renderPartial('../comment/_form', array('model' => $commentModel)); ?>

    </div>


</div>





