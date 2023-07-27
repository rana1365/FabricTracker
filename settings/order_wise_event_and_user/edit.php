<?php
session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
/*
$sql="select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";

$result=mysql_query($sql) or die(mysqli_error());
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
$id=$_GET['id'];

$select_order_wise_event_and_user="select * from `order_wise_event_and_user` where `id`='$id'";
$result = mysqli_query($con,$select_order_wise_event_and_user) or die(mysqli_error());
$row = mysqli_fetch_array( $result);
//echo '<pre>';
//print_r($row);
?>
<script type='text/javascript' src='settings/order_wise_event_and_user/form_validation.js'></script>

<style>

    .form-group		/* This is for reducing Gap among Form's Fields */
    {

        margin-bottom: 5px;

    }

</style>

<script>

    function Remove_Value_Of_This_Element(element_name)
    {

        document.getElementById(element_name).value='';
        var alternate_field_of_date = "alternate_"+element_name;

        if(typeof(alternate_field_of_date) != 'undefined' && alternate_field_of_date != null) // This is for deleting Alternative Field of Date if exists
        {
            document.getElementById(alternate_field_of_date).value='';
        }

    }

    function Reset_Radio_Button(radio_element)
    {

        var radio_btn = document.getElementsByName(radio_element);
        for(var i=0;i<radio_btn.length;i++)
        {
            radio_btn[i].checked = false;
        }


    }

    function Reset_Checkbox(checkbox_element)
    {
        for(var i=0;i<checkbox_element.length;i++)
        {

            checkbox_element[i].checked = false;

        }
    }
</script>

<script>
    function sending_data_of_order_wise_event_and_user_form_for_saving_in_database()
    {


        var validate = Form_Validation_for_oweau();
        var url_encoded_form_data = $("#order_wise_event_and_user_form").serialize(); //This will read all control elements value of the form
        if(validate != false)
        {


            $.ajax({
                url: 'settings/order_wise_event_and_user/edit_saving.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                {
                    alert(data);
                },
                error: function( jqXhr, textStatus, errorThrown )
                {
                    //console.log( errorThrown );
                    alert(errorThrown);
                }
            }); // End of $.ajax({

        }//End of if(validate != false)

    }//End of function sending_data_of_order_wise_event_and_user_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

        <div class="panel-heading" style="department:#191970;"><b>Order Wise Event and User</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/order_wise_event_and_user/form.php')">Order Wise Event and User</a></li>
                <li class="breadcrumb-item"><a >Edit Order Wise Event and User</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="order_wise_event_and_user_form" id="order_wise_event_and_user_form">

            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id'] ?>"  >

            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="country_of_origin" style="margin-right:0px; color:#00008B;">Order Id:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="order_id" name="order_id">
                        <option select="selected" value="select" disabled'>Select Order Id</option>

                        <?php
                        $order_id = $row['order_id'];
                        $sql_for_order = 'select * from `orders` order by `order_id`';
                        $result_for_order= mysqli_query($con,$sql_for_order) or die(mysqli_error);
                        while( $row_for_order = mysqli_fetch_array( $result_for_order))
                        {
                            if($order_id == $row_for_order['order_id'])
                            {
                                echo '<option selected value="'.$row_for_order['order_id'].'">'.$row_for_order['order_id'].'</option>';
                            }
                            else{
                                echo '<option value="'.$row_for_order['order_id'].'">'.$row_for_order['order_id'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div><!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->

            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="country_of_origin" style="margin-right:0px; color:#00008B;">Event Col. Id:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="events_collab_id" name="events_collab_id">
                        <option select="selected" value="select" disabled'>Select Event Col. Id</option>

                        <?php
                        $events_collab_id = $row['events_collab_id'];
                        $sql_for_events_collab = 'select * from `event_wise_buyer` order by `id`';
                        $result_for_events_collab_id= mysqli_query($con,$sql_for_events_collab) or die(mysqli_error);
                        while( $row_for_event_col = mysqli_fetch_array( $result_for_events_collab_id))
                        {
                            if($events_collab_id == $row_for_event_col['id'])
                            {
                                echo '<option selected value="'.$row_for_event_col['id'].'">'.$row_for_event_col['id'].'</option>';
                            }
                            else{
                                echo '<option value="'.$row_for_event_col['id'].'">'.$row_for_event_col['id'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div><!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->



            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="country_of_origin" style="margin-right:0px; color:#00008B;">Event Wise User Id:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="event_wise_user_id" name="event_wise_user_id">
                        <option select="selected" value="select" disabled'>Select Event Wise User Id</option>

                        <?php
                        $event_wise_user_id = $row['event_wise_user_id'];
                        $sql = 'select * from `event_wise_user` order by `id`';
                        $result_for_event_wise_user= mysqli_query($con,$sql) or die(mysqli_error);
                        while( $row_for_event_wise_user = mysqli_fetch_array( $result_for_event_wise_user))
                        {
                            if($event_wise_user_id == $row_for_event_wise_user['id'])
                            {
                                echo '<option selected value="'.$row_for_event_wise_user['id'].'">'.$row_for_event_wise_user['id'].'</option>';
                            }
                            else{
                                echo '<option value="'.$row_for_event_wise_user['id'].'">'.$row_for_event_wise_user['id'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div><!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="approval_date" style="department:#00008B;">Approval Date:</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="approval_date" name="approval_date" value="<?php echo $row['approval_date'];?>" placeholder="Enter Approval Date" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('approval_date')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="plan_date" style="department:#00008B;">Plan Date:</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="plan_date" name="plan_date" value="<?php echo $row['plan_date'] ?>"  placeholder="Enter Plan Date" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('plan_date')"></i>
            </div>

            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary" onClick="sending_data_of_order_wise_event_and_user_form_for_saving_in_database()">Submit</button>
                    <button type="reset" class="btn btn-success">Reset</button>
                </div>
            </div>

        </form>

    </div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
