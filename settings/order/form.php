<?php
session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
//echo '<pre>';
//print_r($obj);
//echo '<pre>';

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

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
                url: 'settings/order/saving.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                {
                    alert(data);

                    $.ajax({
                        url: 'settings/order/list.php',
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: url_encoded_form_data,
                        success: function( data, textStatus, jQxhr )
                        {
                            document.getElementById('table_body').innerHTML = data;
                        },
                        error: function( jqXhr, textStatus, errorThrown )
                        {
                            //console.log( errorThrown );
                            alert(errorThrown);
                        }
                    }); // End of $.ajax({

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
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="order_info_form" id="order_info_form">

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="order_id" style="department:#00008B;">Order Id:</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="order_id" name="order_id" placeholder="Enter Order ID" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('order_id')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="buyer_delivery_date" style="department:#00008B;">Buyer Delivery Date:</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="buyer_delivery_date" name="buyer_delivery_date" placeholder="Enter buyer_delivery_date" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('buyer_delivery_date')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="buyer_delivery_slot" style="department:#00008B;">Buyer Delivery Slot:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="buyer_delivery_slot" name="buyer_delivery_slot" placeholder="Enter buyer_delivery_slot" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('buyer_delivery_slot')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="buyer_delivery_slot" style="department:#00008B;">Buyer Id:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="buyer_id" name="buyer_id">
                        <option select="selected" value="select" disabled'>Select Buyer Name</option>

                        <?php
                        $sql = 'select * from `buyer` order by `buyer_name`';
                        $result= mysqli_query($con,$sql) or die(mysqli_error);
                        while( $row = mysqli_fetch_array( $result))
                        {
                            echo '<option value="'.$row['buyer_id'].'">'.$row['buyer_name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>


            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="order_qty" style="department:#00008B;">Order qty:</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="order_qty" name="order_qty" placeholder="Enter order_qty" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('order_qty')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="color" style="department:#00008B;">Color:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="color" name="color" placeholder="color order_qty" required>
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


    <div class="panel panel-default">

        <div class="form-group form-group-sm">
            <label class="col-sm-offset-7 control-label col-sm-1" for="search">Search</label>
            <div class="col-sm-4">
                <input type="text" id="my_input" class="form-control " onkeyup="my_function()" placeholder="Please Type Order Name Keyword">
            </div>
        </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm">
            <label class="control-label col-sm-5" for="search">Order List</label>
        </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm" >
            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                <tr >
                    <th style="text-align: center">SI</th>
                    <th style="text-align: center">Order Id</th>
                    <th style="text-align: center">Buyer Delivery Date</th>
                    <th style="text-align: center">Buyer Delivery Slot</th>
                    <th style="text-align: center">Buyer Name</th>
                    <th style="text-align: center">Order Qty</th>
                    <th style="text-align: center">Color</th>
                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                <?php
                $s1 = 1;
                $sql_for_order = "
                 SELECT *, orders.order_id o_id from orders
                 join buyer on buyer.buyer_id = orders.buyer_id
                 ORDER BY orders.order_id ASC";

                $res_for_order = mysqli_query($con, $sql_for_order);

                while ($row = mysqli_fetch_assoc($res_for_order))
                {
                ?>

                <tr>
                    <td><?php echo $s1; ?></td>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['buyer_delivery_date']; ?></td>
                    <td><?php echo $row['buyer_delivery_slot']; ?></td>
                    <td><?php echo $row['buyer_name']; ?></td>
                    <td><?php echo $row['order_qty']; ?></td>
                    <td><?php echo $row['color']; ?></td>
                    <td>


                        <button type="submit" id="edit_department" name="edit_department"  class="btn btn-primary btn-xs" onclick="load_page('settings/order/edit.php?order_id=<?php echo $row['o_id'] ?>')"> Edit </button>
                        <span>  </span>

                        <button type="submit" id="delete_department" name="delete_department"  class="btn btn-danger btn-xs" onclick="load_page('settings/order/delete.php?order_id=<?php echo $row['o_id'] ?>')"> Delete </button>
                    </td>
                    <?php

                    $s1++;
                    }
                    ?>
                </tr>
                </tbody>
            </table>


        </div> <!-- End of <div class="form-group form-group-sm" -->

        <script>
            function my_function() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("my_input");
                filter = input.value.toUpperCase();
                table = document.getElementById("datatable-buttons");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
            $(document).ready( function () {
                $('#datatable-buttons').DataTable();
            } );
        </script>

    </div> <!-- End of <div class="panel panel-default"> -->


</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
