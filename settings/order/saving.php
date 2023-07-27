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


$order_id= $_POST['order_id'];
$buyer_delivery_date= $_POST['buyer_delivery_date'];
$buyer_delivery_slot= $_POST['buyer_delivery_slot'];
$buyer_id= $_POST['buyer_id'];
$order_qty= $_POST['order_qty'];
$color= $_POST['color'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `orders` where `order_id`='$order_id' and `buyer_delivery_date`='$buyer_delivery_date' and `buyer_delivery_slot`='$buyer_delivery_slot' and `buyer_id`='$buyer_id' and `order_qty`='$order_qty' and `color`='$color'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{

    $data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


    $insert_sql_statement="
    insert into `orders` 
    ( `order_id`,`buyer_delivery_date`,`buyer_delivery_slot`,`buyer_id`,`order_qty`,`color`) 
    values 
    ('$order_id','$buyer_delivery_date','$buyer_delivery_slot','$buyer_id','$order_qty','$color')";

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

