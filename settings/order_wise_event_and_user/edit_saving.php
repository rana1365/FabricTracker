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

$id= $_POST['id'];
$order_id= $_POST['order_id'];
$events_collab_id= $_POST['events_collab_id'];
$event_wise_user_id= $_POST['event_wise_user_id'];
$approval_date = $_POST['approval_date'];
$plan_date= $_POST['plan_date'];



mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `order_wise_event_and_user` where `order_id`='$order_id' and `events_collab_id`='$events_collab_id' and `event_wise_user_id`='$event_wise_user_id' and `approval_date`='$approval_date' and `plan_date`='$plan_date'";
//$select_sql_for_duplicacy="select * from `order_wise_event_and_user` where `id`='$id' and `order_id`='$order_id' and `events_collab_id`='$events_collab_id' and `event_wise_user_id`='$event_wise_user_id' and `approval_date`='$approval_date' and `plan_date`='$plan_date'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());



if(mysqli_num_rows($result)>0)
{
    $data_previously_saved="Yes";
//    echo $data_previously_saved;

}
else if( mysqli_num_rows($result) < 1)
{

//    $insert_sql_statement="insert into `event_wise_user` ( `user_id`,`event_id`) values ('$location','$department_name')";
//    $insert_sql_statement="UPDATE `order_wise_event_and_user` SET `id`='$id',`order_id`='$order_id',`events_collab_id`='$events_collab_id',`event_wise_user_id`='$event_wise_user_id',`approval_date`='$approval_date',`plan_date`='$plan_date' WHERE `id`= '$id'";
    $insert_sql_statement="UPDATE `order_wise_event_and_user` SET `order_id`='$order_id',`events_collab_id`='$events_collab_id',`event_wise_user_id`='$event_wise_user_id',`approval_date`='$approval_date',`plan_date`='$plan_date' where `id` = '$id'";

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

