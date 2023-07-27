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
                url: 'settings/order_wise_event_and_user/saving.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                {
                    alert(data);

                    $.ajax({
                        url: 'settings/order_wise_event_and_user/list.php',
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

    }//End of function sending_data_of_order_wise_event_and_user_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

        <div class="panel-heading" style="department:#191970;"><b>Order Wise Event and User</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/order_wise_event_and_user/form.php')">Order Wise Event and User</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="order_wise_event_and_user_form" id="order_wise_event_and_user_form">


            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="country_of_origin" style="margin-right:0px; color:#00008B;">Order:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="order_id" name="order_id">
                        <option select="selected" value="select" disabled'>Select Order Id</option>

                        <?php
                        $sql = 'select * from `orders` order by `order_id`';
                        $result= mysqli_query($con,$sql) or die(mysqli_error);
                        while( $row = mysqli_fetch_array( $result))
                        {
                            echo '<option value="'.$row['order_id'].'">'.$row['order_id'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div><!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->

            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="country_of_origin" style="margin-right:0px; color:#00008B;">Event Name:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="events_collab_id" name="events_collab_id">
                        <option select="">Select Event</option>

                        <?php
                        $sql = 'select * from `event_info` order by `id`';
                        $result= mysqli_query($con,$sql) or die(mysqli_error);
                        while( $row = mysqli_fetch_array( $result))
                        {
                            echo '<option value="'.$row['id'].'">'.$row['event_name'].'</option>';
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
                        $sql = 'select * from `event_wise_user` order by `id`';
                        $result= mysqli_query($con,$sql) or die(mysqli_error);
                        while( $row = mysqli_fetch_array( $result))
                        {
                            echo '<option value="'.$row['id'].'">'.$row['id'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div><!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="approval_date" style="department:#00008B;">Approval Date:</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="approval_date" name="approval_date" placeholder="Enter approval_date" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('approval_date')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="plan_date" style="department:#00008B;">Plan Date:</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="plan_date" name="plan_date" placeholder="Enter plan_date" required>
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

    <div class="panel panel-default">

        <div class="form-group form-group-sm">
            <label class="col-sm-offset-7 control-label col-sm-1" for="search">Search</label>
            <div class="col-sm-4">
                <input type="text" id="my_input" class="form-control " onkeyup="my_function()" placeholder="Please Type Department Name Keyword">
            </div>
        </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm">
            <label class="control-label col-sm-5" for="search">Order Wise Event and User</label>
        </div> <!-- End of <div class="form-group form-group-sm" -->

        <div class="form-group form-group-sm" >
            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                <tr >
                    <th style="text-align: center">SI</th>
                    <th style="text-align: center">Order Id</th>
                    <th style="text-align: center">Events Collab Id</th>
                    <th style="text-align: center">Event Wise User Id</th>
                    <th style="text-align: center">Approval Date</th>
                    <th style="text-align: center">Plan Date</th>
                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                <?php
                $s1 = 1;
                $sql_for_department = "SELECT * FROM order_wise_event_and_user ORDER BY id ASC";

                $res_for_department = mysqli_query($con, $sql_for_department);

                while ($row = mysqli_fetch_assoc($res_for_department))
                {
                ?>
                <tr>
                    <td><?php echo $s1; ?></td>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['events_collab_id']; ?></td>
                    <td><?php echo $row['event_wise_user_id']; ?></td>
                    <td><?php echo $row['approval_date']; ?></td>
                    <td><?php echo $row['plan_date']; ?></td>
                    <td>
                        <button type="submit" id="edit_department" name="edit_department"  class="btn btn-primary btn-xs" onclick="load_page('settings/order_wise_event_and_user/edit.php?id=<?php echo $row['id'] ?>')"> Edit </button>
                        <span>  </span>

                        <button type="submit" id="delete_department" name="delete_department"  class="btn btn-danger btn-xs" onclick="load_page('settings/order_wise_event_and_user/delete.php?id=<?php echo $row['id'] ?>')"> Delete </button>
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
