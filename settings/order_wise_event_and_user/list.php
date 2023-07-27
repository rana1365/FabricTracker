<?php
session_start();
require_once("../../login/session.php");
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$s1 = 1;
$sql_for_department = "SELECT * FROM order_wise_event_and_user ORDER BY id ASC";

$res_for_department = mysqli_query($con, $sql_for_department);

while ($row = mysqli_fetch_assoc($res_for_department))
{
?>

<tr>
    <td><?php echo $s1; ?></td>
    <td><?php echo $row['order_id']; ?></td>
    <td><?php echo $row['events_collab_id']; ?></td>
    <td><?php echo $row['event_wise_user_id']; ?></td>
    <td><?php echo $row['approval_date']; ?></td>
    <td><?php echo $row['plan_date']; ?></td>
    <td>
        <button type="submit" id="edit_department" name="edit_department"  class="btn btn-primary btn-xs" onclick="load_page('settings/order_wise_event_and_user/edit.php?id=<?php echo $row['id'] ?>')"> Edit </button>
        <span>  </span>

        <button type="submit" id="delete_department" name="delete_department"  class="btn btn-danger btn-xs" onclick="load_page('settings/order_wise_event_and_user/delete.php?id=<?php echo $row['id'] ?>')"> Delete </button>
    </td>
    <?php

    $s1++;
    }
    ?>
</tr>
