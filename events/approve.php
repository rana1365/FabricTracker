<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
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
/*
$sql = "select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";
$result = mysqli_query($con,$sql) or die(mysqli_error());

if( mysqli_num_rows($result) < 1 )
{

	header('Location:logout.php');

}
else
{
	while($row=mysql_fetch_array($result))
	{
		 $user_name=$row['user_name'];
	}
}

*/

$order_id= $_POST['order_id'];
$event_id= $_POST['event_id'];
$buyer_id= $_POST['buyer_id'];
$approver_id=$_POST['approver_id'];
$approval_status=$_POST['approval_status'];
$event_name=$_POST['event_name'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `event_approve`
where `order_id`='$order_id'
and `event_id`='$event_id' and
`buyer_id`='$buyer_id' and
`approver_id`='$approver_id' and
`event_name`='$event_name'
";
$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{

	if($event_name=="GD" ||	$event_name	=="Work Order"){

		$gd_wo_number=$_POST['gd_wo_number'];
		$gd_wo_length= $_POST['gd_wo_length'];

		$insert_sql_statement="insert into `event_approve`
		 ( `order_id`,`event_id`,
		 `buyer_id`,`approver_id`,`approval_status`,
		 `event_name`,`gd_wo_number`,`gd_wo_length`
		 )
		 values ('$order_id','$event_id',
		 '$buyer_id','$approver_id',
		 '$approval_status',
		 '$event_name','$gd_wo_number','$gd_wo_length'
		 )";


	}else{
		$insert_sql_statement="insert into `event_approve`
		 ( `event_name`,`order_id`,`event_id`,
		 `buyer_id`,`approver_id`,`approval_status`)
		 values ('$event_name','$order_id','$event_id',
		 '$buyer_id','$approver_id','$approval_status')";

	}


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
