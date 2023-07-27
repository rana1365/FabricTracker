<?php
session_start();
require_once('db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$user_name= $_POST['user_name'];
$password=$_POST['password'];

 $sql_for_user_privilege = "SELECT *
                             FROM `user_login`
                            WHERE user_id = '$user_name'
                              AND password = '$password'
                              AND status = 'Active'";


$res_for_user_privilege = mysqli_query($con, $sql_for_user_privilege) or die(mysqli_error($con));


if(mysqli_num_rows($res_for_user_privilege) > 0)
{

    while($row = mysqli_fetch_array($res_for_user_privilege))
    {

        /********** Session Variable defined here **********/

      $_SESSION['user_id']       = $row['user_id'];

      $_SESSION['user_name']     = $row['user_name'];
        $_SESSION['password']      = $row['password'];
        $_SESSION['first_name']    = $row['first_name'];
        $_SESSION['last_name']     = $row['last_name'];
        $_SESSION['middle_name']   = $row['middle_name'];
        $_SESSION['user_type']     = $row['user_type'];
        $_SESSION['status']        = $row['status'];
        $_SESSION['last_activity'] = time();
    }


    header('Location:../framework.php');

}
else
{
  //  header('Location: logout.php');
}
