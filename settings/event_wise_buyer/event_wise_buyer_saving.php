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

$session_user_id = $_SESSION['user_id'];
$session_password = $_SESSION['password'];
$session_user_name = $_SESSION['user_name'];



$buyer_id = $_POST['buyer_id'];
$event_id = $_POST['event_id'];
$days = $_POST['days'];





mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `event_wise_buyer` where `buyer_id`='$buyer_id' AND `event_id`='$event_id' AND 
 days = '$days' ";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{

    $data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


    $insert_sql_statement="insert into `event_wise_buyer` ( `buyer_id`,`event_id`,`days` )
 	values ('$buyer_id','$event_id','$days')";

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
    echo "Data is successfully saved.";

}
else
{

    mysqli_query($con,"ROLLBACK");
    echo "Data is not successfully saved.";

}

$obj->disconnection();

?>
