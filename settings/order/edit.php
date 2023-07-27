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
$order_id=$_GET['order_id'];

$select_order="select * from `orders` where `order_id`='$order_id'";
$result = mysqli_query($con,$select_order) or die(mysqli_error());
$row = mysqli_fetch_array( $result);
//echo '<pre>';
//print_r($row);
?>
<script type='text/javascript' src='settings/order/form_validation.js'></script>

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
    function sending_data_of_order_info_form_for_saving_in_database()
    {


        var validate = Department_Form_Validation();
        var url_encoded_form_data = $("#order_info_form").serialize(); //This will read all control elements value of the form
        if(validate != false)
        {


            $.ajax({
                url: 'settings/order/edit_saving.php',
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

    }//End of function sending_data_of_order_info_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

        <div class="panel-heading" style="department:#191970;"><b>Order</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/order/form.php')">Order</a></li>
                <li class="breadcrumb-item"><a >Edit Order</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="order_info_form" id="order_info_form">

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="order_id" style="department:#00008B;">Order Id:</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="order_id" name="order_id" value="<?php echo $row['order_id'] ?>" placeholder="Enter Order ID" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('order_id')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="buyer_delivery_date" style="department:#00008B;">Buyer Delivery Date:</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="buyer_delivery_date" name="buyer_delivery_date" value="<?php echo $row['buyer_delivery_date'] ?>" placeholder="Enter Buyer Delivery Date" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('buyer_delivery_date')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="buyer_delivery_slot" style="department:#00008B;">Buyer Delivery Slot:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="buyer_delivery_slot" name="buyer_delivery_slot" value="<?php echo $row['buyer_delivery_slot'] ?>" placeholder="Enter Buyer Delivery Slot" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('buyer_delivery_slot')"></i>
            </div>


            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="buyer_delivery_slot" style="department:#00008B;">Buyer Id:</label>
                <div class="col-sm-5">

                    <select  class="form-control for_auto_complete" id="buyer_id" name="buyer_id">
                        <option select="selected" value="select">Select Buyer</option>
                        <?php
                        $buyer_id = $row['buyer_id'];
                        $sql_for_buyer = 'select * from `buyer` order by `buyer_name`';
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
                    </select>

                </div>

            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="order_qty" style="department:#00008B;">Order Qty:</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="order_qty" name="order_qty" value="<?php echo $row['order_qty'] ?>" placeholder="Enter Order Qty" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('order_qty')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="color" style="department:#00008B;">Color:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="color" name="color" value="<?php echo $row['color'] ?>" placeholder="Color" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('color')"></i>
            </div>

            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary" onClick="sending_data_of_order_info_form_for_saving_in_database()">Submit</button>
                    <button type="reset" class="btn btn-success">Reset</button>
                </div>
            </div>

        </form>






    </div> <!-- End of <div class="panel panel-default"> -->





</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
