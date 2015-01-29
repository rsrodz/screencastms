<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->lastName).", ".CHtml::encode($data->firstName),array('user/view','id'=>$data->id));?></td>
    <td><?php echo CHtml::encode($data->email); ?></td>
    <td><?php echo ($data->userStatus == 1)? "ADMIN": "USER";?></td>
    <td><?php echo CHtml::encode(date_format(new DateTime($data->dateCreated),"m/d/Y g:ia")); ?></td>
    <td><?php echo CHtml::encode(date_format(new DateTime($data->lastLogin),"m/d/Y g:ia")); ?></td>
    <td><?php echo CHtml::link("<span class=\"glyphicon glyphicon-pencil\"></span>", array('user/update', 'id' => $data->id))." ". CHtml::link("<span class=\"glyphicon glyphicon-trash\"></span>", array('user/delete', 'id' => $data->id)); ?></td>
</tr>
