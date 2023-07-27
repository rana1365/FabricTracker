<?php
$json_file = file_get_contents("few_data.json");

// Converts to an array 
$my_array = json_decode($json_file, true);

$i=0;
foreach ($my_array as $key1 => $value1) 
{
        //print_r($my_array[$key1]['pp_date']);
		//print_r($my_array[$key1]['pp_date']);
		//echo $my_array[$key1]['pp_date'];
		$i++;
		echo $i." ".$my_array[$key1]['buyer']." , ".$my_array[$key1]['composition']." , ".$my_array[$key1]['construction']." , ".$my_array[$key1]['customer']." , ".$my_array[$key1]['finish_type']." , ".$my_array[$key1]['finish_width']." , ".$my_array[$key1]['pp_date']." , ".$my_array[$key1]['pp_no']." , ".$my_array[$key1]['shade']." , ".$my_array[$key1]['weave']." , ".$my_array[$key1]['work_order'];
		echo "<br/>";
		

}
?>
