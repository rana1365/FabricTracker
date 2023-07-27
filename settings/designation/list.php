<?php
session_start();
require_once("../../login/session.php");
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$s1 = 1;
$sql_for_designation = "SELECT * FROM designation_info ORDER BY id ASC";

$res_for_designation = mysqli_query($con, $sql_for_designation);

while ($row = mysqli_fetch_assoc($res_for_designation))
{
?>

<tr>
    <td><?php echo $s1; ?></td>
    <td><?php echo $row['designation_name']; ?></td>
    <td>

        <button type="submit" id="edit_designation" name="edit_designation"  class="btn btn-primary btn-xs" onclick="load_page('settings/designation/edit.php?designation_id=<?php echo $row['id'] ?>')"> Edit </button>


        <button type="submit" id="delete_designation" name="delete_designation"  class="btn btn-danger btn-xs" onclick="load_page('settings/designation/delete.php?designation_id=<?php echo $row['id'] ?>')"> Delete </button>
    </td>
    <?php

    $s1++;
    }
    ?>
</tr>
