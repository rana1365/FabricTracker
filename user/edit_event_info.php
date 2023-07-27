<?php
session_start();
include('../login/db_connection_class.php');
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
$id=$_GET['event_id'];
$select_event="select * from `event_info` where `event_id`='$id'";
$result = mysqli_query($con,$select_event) or die(mysqli_error());
$row = mysqli_fetch_array( $result);
?>
<script type='text/javascript' src='user/event_info_form_validation.js'></script>

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
    function sending_data_of_event_info_form_for_saving_in_database()
    {


        var validate = Event_Form_Validation();
        var url_encoded_form_data = $("#event_info_form").serialize(); //This will read all control elements value of the form
        if(validate != false)
        {


            $.ajax({
                url: 'user/edit_event_info_saving.php',
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

    }//End of function sending_data_of_department_info_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

        <div class="panel-heading" style="department:#191970;"><b>Events Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('user/event_info.php')">Events Info</a></li>
                <li class="breadcrumb-item"><a >Edit Event Info</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="event_info_form" id="event_info_form">

            <input type="hidden" class="form-control" id="event_id" name="event_id" value="<?php echo $id; ?>" required>

            <div class="form-group form-group-sm" id="form-group_for_event_name">
                <label class="control-label col-sm-3" for="event" style="department:#00008B;">Event Name:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="event_name" name="event_name" value="<?php echo $row['event_name']; ?>" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('event_name')"></i>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_department_name"> -->

            <div class="form-group form-group-sm" id="form-group_for_total_day">
                <label class="control-label col-sm-3" for="event" style="department:#00008B;">Total Days:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="total_day" name="total_day" value="<?php echo $row['total_day']; ?>" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('total_day')"></i>
            </div>

            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary" onClick="sending_data_of_event_info_form_for_saving_in_database()">Submit</button>
                    <button type="reset" class="btn btn-success">Reset</button>
                </div>
            </div>

        </form>






    </div> <!-- End of <div class="panel panel-default"> -->





</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->