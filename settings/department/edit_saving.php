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

$id= $_POST['id'];
$location= $_POST['location'];
$department_name= $_POST['department_name'];
$section_name= $_POST['section_name'];
$contact_person_name= $_POST['contact_person_name'];
$contact_no= $_POST['contact_no'];
$email= $_POST['email'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `department_info` where `location`='$location' and `department_name`='$department_name' and `section_name`='$section_name' and `contact_person_name`='$contact_person_name' and `contact_no`='$contact_no' and `email`='$email'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{

    $data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{

    $insert_sql_statement="UPDATE `department_info` SET `location`='$location',`department_name`='$department_name',`section_name`='$section_name',`contact_person_name`='$contact_person_name',`contact_no`='$contact_no',`email`='$email',`recording_person_id`='$user_id',`recording_time`=NOW() WHERE `id`= '$id'";


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

