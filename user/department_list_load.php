<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$s1 = 1;
$sql_for_department = "SELECT * FROM department_info ORDER BY id ASC";

$res_for_department = mysqli_query($con, $sql_for_department);

while ($row = mysqli_fetch_assoc($res_for_department))
{
?>

<tr>
    <td><?php echo $s1; ?></td>
    <td><?php echo $row['department_name']; ?></td>
    <td><?php echo $row['location']; ?></td>
    <td><?php echo $row['section_name']; ?></td>
    <td><?php echo $row['contact_person_name']; ?></td>
    <td><?php echo $row['contact_no']; ?></td>
    <td>


        <button type="submit" id="edit_department" name="edit_department"  class="btn btn-primary btn-xs" onclick="load_page('user/edit_department_info.php?department_id=<?php echo $row['id'] ?>')"> Edit </button>
        <span>  </span>

        <button type="submit" id="delete_department" name="delete_department"  class="btn btn-danger btn-xs" onclick="load_page('user/department_info_deleting.php?department_id=<?php echo $row['id'] ?>')"> Delete </button>
    </td>
    <?php

    $s1++;
    }
    ?>
</tr>