<?php
session_start();
require_once("../../login/session.php");
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$data_previously_saved = "No";
$data_insertion_hampering = "No";
/*$user_name ="Iftekhar";
$user_id ="Iftekhar";
$password ="1234";*/

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];

$id = $_POST['id'];
//echo $id;
$buyer_id = $_POST['buyer_id'];
$event_id = $_POST['event_id'];
$days = $_POST['days'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `event_wise_buyer` where `id`='$id' and `buyer_id`='$buyer_id' and `event_id`='$event_id' and `buyer_id`='$buyer_id' and `days`='$days'";

//$select_sql_for_duplicacy="select * from `event_wise_buyer` where `id`='$id' AND `buyer_id`='$buyer_id' AND `event_id`='$event_id' and `days`='$days'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

    $data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


    $insert_sql_statement="UPDATE `event_wise_buyer` SET `buyer_id`='$buyer_id',`event_id`='$event_id',`days`='$days' WHERE `id`= '$id'";

    /*
       $insert_sql_statement="insert into `department_info` ( `location`,`department_name`,`section_name`,`contact_person_name`,`contact_no`,`email`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$location','$department_name','$section_name','$contact_person_name','$contact_no','$email','$user_id','$user_name',NOW())";*/

    mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

    if(mysqli_affected_rows($con)<>1)
    {

        $data_insertion_hampering = "Yes";

    }
}

if($data_previously_saved == "Yes")
{

    mysqli_query($con,"ROLLBACK");
    echo "Data is previously saved.";

}
else if($data_insertion_hampering == "No" )
{

    mysqli_query($con,"COMMIT");
    echo "Data is successfully updated.";

}
else
{
    mysqli_query($con,"ROLLBACK");
    echo "Data is not successfully updated.";
}

$obj->disconnection();

?>

