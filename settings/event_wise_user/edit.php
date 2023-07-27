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

$select_ewu="select * from `event_wise_user` where `id`='$id'";
$result = mysqli_query($con,$select_ewu) or die(mysqli_error());
$row = mysqli_fetch_array( $result);
//echo '<pre>';
//print_r($row);
?>
<script type='text/javascript' src='settings/event_wise_user/form_validation.js'></script>

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
    function sending_data_of_department_info_form_for_saving_in_database()
    {


        var validate = Form_Validation_for_ewu();
        var url_encoded_form_data = $("#department_info_form").serialize(); //This will read all control elements value of the form
        if(validate != false)
        {


            $.ajax({
                url: 'settings/event_wise_user/edit_saving.php',
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

        <div class="panel-heading" style="department:#191970;"><b>Event Wise User</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/event_wise_user/form.php')">Event Wise User</a></li>
                <li class="breadcrumb-item"><a >Edit Event Wise User</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="department_info_form" id="department_info_form">


            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="country_of_origin" style="margin-right:0px; color:#00008B;">User:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="user_id" name="user_id">
                        <option select="selected" value="select" disabled'>Select User</option>

                        <?php
                        $user_id = $row['user_id'];
                        $sql_for_user = 'select * from `user_info` order by `user_name`';
                        $result_for_user= mysqli_query($con,$sql_for_user) or die(mysqli_error);
                        while( $row_for_user = mysqli_fetch_array( $result_for_user))
                        {
                        ?>
<!--//                            echo '<option selected="selected" value="'.$row['user_id'].'">'.$row['user_name'].'</option>';-->
                              <option <?php if($row_for_user['user_id'] == $user_id ){echo "selected";}?> value="<?php echo $row_for_user['user_id'];?>"> <?php echo $row_for_user['user_name'];?></option>
                            <?php
                        }
                        ?>

                    </select>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id'] ?>">
                </div>

            </div>


            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="country_of_origin" style="margin-right:0px; color:#00008B;">Event:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="event_id" name="event_id">
                        <option select="selected" value="select" disabled'>Select Event</option>
                        <?php
                        $event_id = $row['event_id'];
                        $sql_for_event = 'select * from `event_info` order by `event_name`';
                        $result_for_event= mysqli_query($con,$sql_for_event) or die(mysqli_error);
                        while( $row_for_event = mysqli_fetch_array( $result_for_event))
                        {
                        ?>
<!--                            echo '<option selected="selected" value="'.$row['event_id'].'">'.$row['event_name'].'</option>';-->
                             <option <?php if($row_for_event['event_id'] == $event_id ){echo "selected";}?> value="<?php echo $row_for_event['event_id'];?>"> <?php echo $row_for_event['event_name'];?></option>
<!--                            <option --><?php //if($department_row['department_name'] == $department ){echo "selected";}?><!-- value="--><?php //echo $department_row['department_name'];?><!--"> --><?php //echo $department_row['department_name'];?><!--</option>-->

                            <?php


                        }
                        ?>

                    </select>
                </div>

            </div><!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->


<!--            <div class="form-group form-group-sm" id="form-group_for_location">-->
<!--                <label class="control-label col-sm-3" for="user_id" style="department:#00008B;">User Name:</label>-->
<!--                <div class="col-sm-5">-->
<!--                    <input type="text" class="form-control" id="user_id" name="user_id" value="--><?php //echo $row['user_id'] ?><!--" required>-->
<!---->
<!--                    <input type="hidden" class="form-control" id="id" name="id" value="--><?php //echo $row['id'] ?><!--" required>-->
<!--                </div>-->
<!--                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('user_id')"></i>-->
<!--            </div>  End of <div class="form-group form-group-sm" id="form-group_for_location"> -->
<!---->
<!--            <div class="form-group form-group-sm" id="form-group_for_department_name">-->
<!--                <label class="control-label col-sm-3" for="user_id" style="department:#00008B;">Event Name:</label>-->
<!--                <div class="col-sm-5">-->
<!--                    <input type="text" class="form-control" id="event_id" name="event_id" value="--><?php //echo $row['event_id'] ?><!--" required>-->
<!--                </div>-->
<!--                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('event_id')"></i>-->
<!--            </div>  End of <div class="form-group form-group-sm" id="form-group_for_department_name"> -->


            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary" onClick="sending_data_of_department_info_form_for_saving_in_database()">Submit</button>
                    <button type="reset" class="btn btn-success">Reset</button>
                </div>
            </div>

        </form>






    </div> <!-- End of <div class="panel panel-default"> -->





</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
