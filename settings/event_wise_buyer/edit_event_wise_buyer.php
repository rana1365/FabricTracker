<?php
session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql="select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";

$result=mysqli_query($con,$sql) or die(mysqli_error()());
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/

$id = $_GET['event_wise_buyer_id'];
$select_event_wise_buyer="select * from `event_wise_buyer` where `id`='$id'";
$result = mysqli_query($con,$select_event_wise_buyer) or die(mysqli_error($con));
$row = mysqli_fetch_array( $result);
?>

<script type='text/javascript' src='settings/event_wise_buyer/event_wise_buyer_form_validation.js'></script>

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
    function sending_data_of_buyer_form_for_saving_in_database()
    {
        // alert('a');

        var validate = Event_wise_buyer_Form_Validation();
        var url_encoded_form_data = $("#edit_event_wise_buyer_form").serialize(); //This will read all control elements value of the form

        if(validate != false)
        {


            $.ajax({
                url: 'settings/event_wise_buyer/edit_event_wise_buyer_saving.php',
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

    }//End of function sending_data_of_buyer_form_for_saving_in_database()


    // function sending_data_for_delete(buyer_id)
    // {
    //
    //     var url_encoded_form_data = 'buyer_id='+buyer_id;
    //
    //     $.ajax({
    //         url: 'settings/event_wise_buyer_deleting.php',
    //         dataType: 'text',
    //         type: 'post',
    //         contentType: 'application/x-www-form-urlencoded',
    //         data: url_encoded_form_data,
    //         success: function( data, textStatus, jQxhr )
    //         {
    //             alert(data);
    //
    //         },
    //         error: function( jqXhr, textStatus, errorThrown )
    //         {
    //             //console.log( errorThrown );
    //             alert(errorThrown);
    //         }
    //     }); // End of $.ajax({
    //
    // }//End of function sending_data_for_delete()

    /***************************************************** FOR AUTO COMPLETE********************************************************************/

    $('.add_buyer').chosen();


    /***************************************************** FOR AUTO COMPLETE********************************************************************/
</script>

<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

        <div class="panel-heading" style="color:#191970;"><b>Buyer</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/buyer/buyer.php')">Add Event wise Buyer</a></li>
            </ol>
        </nav>
        <form class="form-horizontal" action="" style="margin-top:10px;" name="edit_event_wise_buyer_form" id="edit_event_wise_buyer_form" enctype="multipart/form-data" data-parsley-validate>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id']; ?>" >
            <div class="form-group form-group-sm" id="form-group_for_required_day">
                <label class="control-label col-sm-3" for="days" style="color:#00008B;">Required Days:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="days" name="days" value="<?php echo $row['days']; ?>" placeholder="Enter Required Days" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('required_day')"></i>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_required_day"> -->

            <div class="form-group form-group-sm" id="form-group_for_department">
                <label class="control-label col-sm-3" for="department" style="margin-right:0px; color:#00008B;">Buyer:</label>
                <div class="col-sm-5">
                    <!-- Code For Fetching Data from drop-down list From Buyer(table) -->
                    <select  class="form-control for_auto_complete" id="buyer_id" name="buyer_id">
                        <option select="selected" value="select">Select Buyer</option>
                        <?php
                        $buyer_id = $row['buyer_id'];
                        $sql_for_buyer = 'select * from `buyer` ';
                        $result_for_buyer = mysqli_query($con,$sql_for_buyer) or die(mysqli_error());
                        while( $row_for_buyer = mysqli_fetch_array( $result_for_buyer))
                        {
                            if($buyer_id == $row_for_buyer['buyer_id'])
                            {
                                echo '<option selected value="'.$row_for_buyer['buyer_id'].'">'.$row_for_buyer['buyer_name'].'</option>';
                            }
                            else{
                                echo '<option value="'.$row_for_buyer['buyer_id'].'">'.$row_for_buyer['buyer_name'].'</option>';
                            }
                        }

                        ?>
                    </select><!-- Code For Fetching Data from drop-down list From Buyer(table) -->
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_department"> -->

            <div class="form-group form-group-sm" id="form-group_for_designation">
                <label class="control-label col-sm-3" for="designation" style="margin-right:0px; color:#00008B;">Events:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="event_id" name="event_id">
                        <option select="selected" value="select" disabled'>Select Event</option>
                        <?php
                        $event_id = $row['event_id'];
                        $sql = 'select * from `event_info` order by `event_name`';
                        $result= mysqli_query($con,$sql) or die(mysqli_error);
                        while( $row_event = mysqli_fetch_array( $result))
                        {
                            ?>
                            <option <?php if($row_event['event_id'] == $event_id ){echo "selected";}?> value="<?php echo $row_event['event_id'];?>"> <?php echo $row_event['event_name'];?></option>
                            <?php
                        }
                        ?>

                    </select>
<!--                    <select  class="form-control for_auto_complete" id="event_id" name="event_id">-->
<!--                        <option select="selected" value="select">Select Event</option>-->
<!--                        --><?php
//                        $event_id = $row['event_id'];
//                        $sql_for_event = 'select * from `event_info` order by `event_name` ';
//                        $result_for_event = mysqli_query($con,$sql_for_event) or die(mysqli_error());
//                        while( $row_for_event = mysqli_fetch_array( $result))
//                        {
//
//                            if($event_id == $row_for_event['event_id'])
//                            {
//                                echo '<option selected value="'.$row_for_event['event_id'].'">'.$row_for_event['event_name'].'</option>';
//                            }
//                            else {
//                                echo '<option value="'.$row_for_event['event_id'].'">'.$row_for_event['event_name'].'</option>';
//                            }
//
//                        }
//
//                        ?>
<!---->
<!--                    </select>
                <!- Code For Fetching Data from drop-down list From Event(table) -->
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_designation"> -->

            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary" onClick="sending_data_of_buyer_form_for_saving_in_database()">Submit</button>
                    <button type="reset" class="btn btn-success">Reset</button>
                </div>
            </div>



        </form>

    </div> <!-- End of <div class="panel panel-default"> -->






</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
