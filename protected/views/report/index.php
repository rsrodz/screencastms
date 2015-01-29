
<h1 class="title">Reports:</h1>



<a id="top"></a>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'template'=>'<table class="table table-striped"><tbody>{items}</tbody></table>'
)); ?>
