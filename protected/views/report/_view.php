




<?php
    $tableClass = "";
    $today = new DateTime("now");
        $tomorrow = new DateTime("now + 1 day");
        $yesterday = new DateTime("now -1 days");
        $lectureDate = new DateTime($data->dateRecorded);
        if (strcmp($yesterday->format("YYYY-mm-dd"), $lectureDate->format("YYYY-mm-dd")) == 0){
            echo "<a id=\"yesterday\"></a>";
            $tableClass = "warning";
        }
        if (strcmp($today->format("YYYY-mm-dd"), $lectureDate->format("YYYY-mm-dd")) == 0){
            echo "<a id=\"today\"></a>";
            $tableClass = "success";
        }
        if (strcmp($tomorrow->format("YYYY-mm-dd"), $lectureDate->format("YYYY-mm-dd")) == 0)
            echo "<a id=\"tomorrow\"></a>";
        ?>
    
<tr>
    <td class="<?php echo $tableClass;?>">
    <h3><?php echo CHtml::link($data->title, array('report/view', 'id' => $data->id),array('style'=>'color:#000')); ?></h3>
    <small>- presented by <?php echo$data->getFullName(); ?> on <?php echo date_format(new DateTime($data->dateRecorded), 'l jS F Y'); ?></small>
        <?php 
        echo " ".CHtml::link("<span class=\"glyphicon glyphicon-thumbs-up\"></span>", array('report/like', 'id' => $data->id));
        if ($data->presenterID == User::currentUser()->id || User::isAdmin()){
            echo " ".CHtml::link("<span class=\"glyphicon glyphicon-pencil\"></span>", array('report/update', 'id' => $data->id));
            echo " ".CHtml::link("<span class=\"glyphicon glyphicon-trash\"></span>", array('report/delete', 'id' => $data->id));
        }?>
        
        
    </td>
</tr>
    
        