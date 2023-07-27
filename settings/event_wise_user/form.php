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
      let al=document.getElementById("event_id").value
      alert(al);
        var validate = Form_Validation_for_ewu();
        // alert(validate);
        // var url_encoded_form_data = new FormData(document.getElementById('#department_info_form'));
        var url_encoded_form_data = $("#department_info_form").serialize(); //This will read all control elements value of the form
        // alert(url_encoded_form_data);
        if(validate != false)
        {

            $.ajax({
                url: 'settings/event_wise_user/saving.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                {
                    alert(data);

                    $.ajax({
                        url: 'settings/event_wise_user/list.php',
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

    }//End of function sending_data_of_department_info_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

        <div class="panel-heading" style="department:#191970;"><b>Event Wise User</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/event_wise_user/form.php')">Event Wise User</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="department_info_form" id="department_info_form">

            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="country_of_origin" style="margin-right:0px; color:#00008B;">User:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="user_id" name="user_id" required>
                        <option select="selected" value="select" disabled'>Select User</option>

                        <?php
                        $sql_user_info = 'select * from `user_info` order by `user_name`';
                        $result_user_info= mysqli_query($con,$sql_user_info) or die(mysqli_error);
                        while( $row_user_info = mysqli_fetch_array( $result_user_info))
                        {
                          ?>
                            <option value="<?php echo $row_user_info['id']?>"><?php echo $row_user_info['user_name']?></option>;
                          <?php
                        }
                        ?>

                    </select>
                </div>

            </div><!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->

            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="country_of_origin" style="margin-right:0px; color:#00008B;">Event:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="event_id" name="event_id" required>
                        <option select="selected" value="select">Select Event</option>

                        <?php
                        $sql_event_info = 'select * from `event_info` order by `event_name`';
                        $result_event_info= mysqli_query($con,$sql_event_info) or die(mysqli_error);
                        while( $row_event_info = mysqli_fetch_array( $result_event_info))
                        {
                          ?>
                            <option value="<?php echo $row_event_info['event_id']?>">
                              <?php echo $row_event_info['event_name']?></option>;
                          <?php
                        }
                        ?>

                    </select>
                </div>

            </div><!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->

            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary" onClick="sending_data_of_department_info_form_for_saving_in_database()">Submit</button>
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
            <label class="control-label col-sm-5" for="search">Event Wise User List</label>
        </div> <!-- End of <div class="form-group form-group-sm" -->

        <div class="form-group form-group-sm" >
            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                <tr >
                    <th style="text-align: center">SI</th>
                    <th style="text-align: center">User Name</th>
                    <th style="text-align: center">Event Name</th>
                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                <?php
                $s1 = 1;
                $sql_for_ewu_info = "
                SELECT
                event_wise_user.id as
                event_wise_user_id, user_info.employee_name as user_name,event_info.event_name
                FROM user_info,event_info,event_wise_user
                where event_wise_user.event_id=event_info.event_id
                and event_wise_user.user_id=user_info.id
                ";

                $res_for_ewu = mysqli_query($con, $sql_for_ewu_info);
                while ($row = mysqli_fetch_assoc($res_for_ewu))
                {
                ?>

                <tr>
                    <td><?php echo $s1; ?></td>

                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['event_name']; ?></td>

                    <td>

                        <button type="submit" id="edit_department" name="edit_department"  class="btn btn-primary btn-xs" onclick="load_page('settings/event_wise_user/edit.php?id=<?php echo $row['event_wise_user_id'] ?>')"> Edit </button>
                        <span>  </span>

                        <button type="submit" id="delete_department" name="delete_department"  class="btn btn-danger btn-xs" onclick="load_page('settings/event_wise_user/delete.php?id=<?php echo $row['event_wise_user_id'] ?>')"> Delete </button>
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
