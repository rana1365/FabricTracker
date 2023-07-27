<?php
session_start();
require_once("../../login/session.php");
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_insertion_hampering = "No";

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];


$buyer_name= $_POST['buyer_name'];
$buyer_address= $_POST['buyer_address'];
$country_of_origin= $_POST['country_of_origin'];




mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `buyer` where `buyer_name`='$buyer_name' ";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{
    $select_sql_max_primary_key="select MAX(max_buyer_id) as max_buyer_id FROM (select CONVERT(substring(buyer_id,6,LENGTH(buyer_id)),UNSIGNED) as max_buyer_id from buyer) as temp_buyer_table"; //converted into string and find max

    $result_for_max_primary_key = mysqli_query($con,$select_sql_max_primary_key) or die(mysqli_error($con));

    $row_for_max_primary_key = mysqli_fetch_array($result_for_max_primary_key);

    $row_id=$row_for_max_primary_key['max_buyer_id']+1;

    if($row_for_max_primary_key['max_buyer_id']==0)
    {

    	$current_buyer_id='cust_1';

    }
    else
    {

    	$current_buyer_id ="cust_".($row_for_max_primary_key['max_buyer_id']+1);

    }

	$insert_sql_statement="insert into `buyer` (`row_id`,`buyer_id`,`buyer_name`,`buyer_address`,`country_of_origin`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$row_id','$current_buyer_id','$buyer_name','$buyer_address','$country_of_origin','$user_id','$user_name',NOW())";

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
