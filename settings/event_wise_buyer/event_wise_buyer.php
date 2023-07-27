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

?>
<script type='text/javascript' src='settings/event_wise_buyer/event_wise_buyer_form_validation.js'></script>

<style>

    .form-group /* This is for reducing Gap among Form's Fields */
    {

        margin-bottom: 5px;

    }

</style>

<script>

    function Remove_Value_Of_This_Element(element_name) {

        document.getElementById(element_name).value = '';
        var alternate_field_of_date = "alternate_" + element_name;

        if (typeof (alternate_field_of_date) != 'undefined' && alternate_field_of_date != null) // This is for deleting Alternative Field of Date if exists
        {
            document.getElementById(alternate_field_of_date).value = '';
        }

    }

    function Reset_Radio_Button(radio_element) {

        var radio_btn = document.getElementsByName(radio_element);
        for (var i = 0; i < radio_btn.length; i++) {
            radio_btn[i].checked = false;
        }


    }

    function Reset_Checkbox(checkbox_element) {
        for (var i = 0; i < checkbox_element.length; i++) {

            checkbox_element[i].checked = false;

        }
    }
</script>

<script>
    function sending_data_of_events_wise_buyer_info_form_for_saving_in_database() {


        var validate = Event_wise_buyer_Form_Validation();
        //var url_encoded_form_data = $("#user_info_form").serialize(); //This will read all control elements value of the form
        var url_encoded_form_data = new FormData(document.getElementById('event_wise_buyer_info_form'));
        url_encoded_form_data.append('profile_picture', document.getElementById('profile_picture'));
        if (validate != false) {

            $.ajax({
                url: 'settings/event_wise_buyer/event_wise_buyer_saving.php',
                type: 'post',
                data: url_encoded_form_data,
                processData: false,
                contentType: false,
                success: function (data, textStatus, jQxhr) {
                    alert(data);
                },
                error: function (jqXhr, textStatus, errorThrown) {
                    //console.log( errorThrown );
                    alert(errorThrown);
                }
            });
        }
    }

    /***************************************************** FOR AUTO COMPLETE********************************************************************/

    $('.for_auto_complete').chosen();


    /***************************************************** FOR AUTO COMPLETE********************************************************************/
</script>


<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

        <div class="panel-heading" style="color:#191970;"><b>Events wise User & Buyer</b></div>
        <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/event_wise_buyer/event_wise_buyer.php')">Create Events wise
                        Buyer</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="event_wise_buyer_info_form"
              id="event_wise_buyer_info_form" enctype="multipart/form-data" data-parsley-validate>

            <div class="form-group form-group-sm" id="form-group_for_required_day">
                <label class="control-label col-sm-3" for="days" style="color:#00008B;">Required Days:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="days" name="days" placeholder="Enter Required Days"
                           required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('required_day')"></i>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_required_day"> -->

            <!-- ******** Start <div class="form-group form-group-sm" id="form-group_for_department_info-->
            <div class="form-group form-group-sm" id="form-group_for_department">
                <label class="control-label col-sm-3" for="department"
                       style="margin-right:0px; color:#00008B;">Buyer:</label>
                <div class="col-sm-5">
                    <select class="form-control for_auto_complete" id="buyer_id" name="buyer_id">
                        <option select="selected" value="select">Select Buyer</option>
                        <?php
                        $sql = 'select * from `buyer` order by `buyer_name`';
                        $result = mysqli_query($con, $sql) or die(mysqli_error());
                        while ($row = mysqli_fetch_array($result)) {

                            echo '<option value="' . $row['buyer_id'] . '">' . $row['buyer_name'] . '</option>';

                        }

                        ?>
                    </select>
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_department"> -->

            <!-- ******** Start <div class="form-group form-group-sm" id="form-group_for_designation_info-->
            <div class="form-group form-group-sm" id="form-group_for_designation">
                <label class="control-label col-sm-3" for="designation"
                       style="margin-right:0px; color:#00008B;">Events:</label>
                <div class="col-sm-5">
                    <select class="form-control for_auto_complete" id="event_id" name="event_id">
                        <option select="selected" value="select">Select Event</option>
                        <?php
                        $sql = 'select * from `event_info` order by `event_name`';
                        $result = mysqli_query($con, $sql) or die(mysqli_error());
                        while ($row = mysqli_fetch_array($result)) {

                            echo '<option value="' . $row['event_id'] . '">' . $row['event_name'] . '</option>';

                        }

                        ?>
                    </select>
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_designation"> -->

            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary"
                            onClick="sending_data_of_events_wise_buyer_info_form_for_saving_in_database()">Submit
                    </button>
                    <button type="reset" class="btn btn-success">Reset</button>
                </div>
            </div>


        </form>

    </div> <!-- End of <div class="panel panel-default"> -->
    <div class="panel panel-default">

        <div class="form-group form-group-sm">
            <label class="col-sm-offset-7 control-label col-sm-1" for="search">Search</label>
            <div class="col-sm-4">
                <input type="text" id="my_input" class="form-control " onkeyup="my_function()"
                       placeholder="Please Type Buyer Name or Event Name Keyword">
            </div>
        </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm">
            <label class="control-label col-sm-5" for="search">Event wise Buyer List</label>
        </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm">
            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="text-center">SI</th>
                    <th class="text-center">Days</th>
                    <th class="text-center">Buyer Name</th>
                    <th class="text-center">Event Name</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">

                <?php
                $s1 = 1;
                $sql_for_department = "SELECT event_wise_buyer.days,event_wise_buyer.id, buyer.buyer_name, event_info.event_name FROM event_wise_buyer,buyer,event_info
WHERE buyer.buyer_id=event_wise_buyer.buyer_id and event_info.event_id=event_wise_buyer.event_id

                ORDER BY event_wise_buyer.id ASC;";

                $res_for_department = mysqli_query($con, $sql_for_department);

                while ($row = mysqli_fetch_assoc($res_for_department))
                {
                ?>

                <tr>
                    <td><?php echo $s1; ?></td>
                    <td><?php echo $row['days'] ?></td>
                    <td>
                        <?php
                        echo $row['buyer_name'];
                        ?>
                    </td>
                    <td>
                        <?php
                      echo $row['event_name'];
                        ?>
                    </td>
                    <td>


                        <button type="submit" id="edit_event_wise_buyer" name="edit_event_wise_buyer"
                                class="btn btn-primary btn-xs"
                                onclick="load_page('settings/event_wise_buyer/edit_event_wise_buyer.php?event_wise_buyer_id=<?php echo $row['id'] ?>');">
                            Edit
                        </button>
                        <span>  </span>

                        <button type="submit" id="delete_event_wise_buyer" name="delete_event_wise_buyer"
                                class="btn btn-danger btn-xs"
                                onclick="load_page('settings/event_wise_buyer/event_wise_buyer_deleting.php?event_wise_buyer_id=<?php echo $row['id'] ?>');">
                            Delete
                        </button>
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
        </script>

    </div>

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
