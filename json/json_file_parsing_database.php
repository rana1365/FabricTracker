<?php
session_start();
include('../db_znzqc_connection_class.php');
$obj2 = new DB_Connection_Class();
$obj2->connection();

include('../db_connection_class.php');
$obj = new DB_Connection_Class_Main();
$obj->connection();

$recording_person_id = 'hriday';
$recording_person_name = 'Hriday';

$message = '';

$json_file = file_get_contents("few_data.json");

// Converts to an array 
$my_array = json_decode($json_file, true);

$i=0;
foreach ($my_array as $key1 => $value1) 
{
		$buyer = $my_array[$key1]['buyer'];
		$composition = $my_array[$key1]['composition'];
		$construction = $my_array[$key1]['construction'];
		$customer = $my_array[$key1]['customer'];
		$finish_type = $my_array[$key1]['finish_type'];
		$finish_width = $my_array[$key1]['finish_width'];
		$pp_date = $my_array[$key1]['pp_date'];
		$pp_no = $my_array[$key1]['pp_no'];
		$shade = $my_array[$key1]['shade'];
		$weave = $my_array[$key1]['weave'];
		$work_order = $my_array[$key1]['work_order'];

		$select_sql_for_duplicacy="select * from `proxima_software_data` where `buyer`='$buyer' and `composition`='$composition' and `construction`='$construction' and `customer`='$customer' and `finish_type`='$finish_type' and `finish_width`='$finish_width' and `pp_date`='$pp_date' and `pp_no`='$pp_no' and `shade`='$shade' and `weave`='$weave' and `work_order`='$work_order'";

		$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

		if(mysqli_num_rows($result)>0)
		{

			$message="Duplicate Data";

		}
		else if(mysqli_num_rows($result) < 1)
		{


			$insert_sql_statement="insert into `proxima_software_data` ( `buyer`,`composition`,`construction`,`customer`,`finish_type`,`finish_width`,`pp_date`,`pp_no`,`shade`,`weave`,`work_order`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$buyer','$composition','$construction','$customer','$finish_type','$finish_width','$pp_date','$pp_no','$shade','$weave','$work_order','$recording_person_id','$recording_person_name',NOW())";

			mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$message = "Data Save";
			
			}
		}

		// echo $i." ".$my_array[$key1]['buyer']." , ".$my_array[$key1]['composition']." , ".$my_array[$key1]['construction']." , ".$my_array[$key1]['customer']." , ".$my_array[$key1]['finish_type']." , ".$my_array[$key1]['finish_width']." , ".$my_array[$key1]['pp_date']." , ".$my_array[$key1]['pp_no']." , ".$my_array[$key1]['shade']." , ".$my_array[$key1]['weave']." , ".$my_array[$key1]['work_order'];
		// echo "<br/>";
		$i++;
}

echo $message;

?>
