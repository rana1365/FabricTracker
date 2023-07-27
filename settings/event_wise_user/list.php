<?php
session_start();
require_once("../../login/session.php");
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$s1 = 1;

//$sql_for_ewu_info = "   SELECT *
//                        FROM event_wise_user
//                        join user_info on user_info.user_id = event_wise_user.user_id
//                        join event_info on event_info.event_id = event_wise_user.event_id
//                        ORDER BY event_wise_user.id ASC
//                        ";
//$res_for_ewu_info = mysqli_query($con, $sql_for_ewu_info);
//$row_info = mysqli_fetch_assoc($res_for_ewu_info);


//$sql_for_ewu = "SELECT * FROM event_wise_user ORDER BY id ASC";
$sql_for_ewu_info = "
SELECT event_wise_user.id as
event_wise_user_id, user_info.employee_name as user_name,
event_info.event_name
FROM user_info,event_info,event_wise_user
where event_wise_user.id = event_info.event_id 
and event_wise_user.user_id = user_info.id
";
$res_for_ewu = mysqli_query($con, $sql_for_ewu_info);


while ($row = mysqli_fetch_array($res_for_ewu))
{
?>

<tr>
    <td><?php echo $s1; ?></td>
    <td><?php echo $row['user_name']; ?></td>
    <td><?php echo $row['event_name']; ?></td>

<!--    <td>--><?php //echo $row['user_name']; ?><!--</td>-->
<!--    <td>--><?php //echo $row['event_name']; ?><!--</td>-->

    <td>


        <button type="submit" id="edit_department" name="edit_department"  class="btn btn-primary btn-xs" onclick="load_page('user/edit_department_info.php?department_id=<?php echo $row['event_wise_user_id'] ?>')"> Edit </button>
        <span>  </span>

        <button type="submit" id="delete_department" name="delete_department"  class="btn btn-danger btn-xs" onclick="load_page('user/department_info_deleting.php?department_id=<?php echo $row['event_wise_user_id'] ?>')"> Delete </button>
    </td>
    <?php

    $s1++;
    }
    ?>
</tr>
