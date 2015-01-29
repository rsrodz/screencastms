
<h1>Users<?php echo CHtml::link("<span class=\"glyphicon glyphicon-plus pull-right\"></span>", array('user/create'));?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'template'=>'<table class="table table-striped"><thead><tr><td>Name</td><td>Email</td><td>Status</td><td>Date Created</td><td>Last Login</td><td>Tasks</td></tr></thead><tbody>{items}</tbody></table>'
)); ?>
