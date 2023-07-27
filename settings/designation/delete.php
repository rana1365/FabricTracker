<?php
session_start();
require_once("../../login/session.php");
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_deleteion_hampering = "No";


$id=$_GET['designation_id'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());



$delete_sql_statement="DELETE FROM `designation_info` WHERE `id`='$id'";

mysqli_query($con,$delete_sql_statement) or die(mysqli_error());

if(mysqli_affected_rows($con)<>1)
{

    $data_deleteion_hampering = "Yes";

}

if($data_deleteion_hampering == "No" )
{

    mysqli_query($con,"COMMIT");
    echo "Department Info is successfully Deleted.";
    header('Location: form.php');


}
else
{

    mysqli_query($con,"ROLLBACK");
    echo "Department Info is not successfully Deleted.";

}

$obj->disconnection();

?>
