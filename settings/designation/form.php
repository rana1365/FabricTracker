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
?>
<script type='text/javascript' src='settings/designation/form_validation.js'></script>

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
    function sending_data_of_designation_info_form_for_saving_in_database()
    {


        var validate = Designation_Form_Validation();
        var url_encoded_form_data = $("#designation_info_form").serialize(); //This will read all control elements value of the form
        if(validate != false)
        {

            $.ajax({
                url: 'settings/designation/saving.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                {
                    alert(data);
                    {
                        $.ajax({
                            url: 'settings/designation/list.php',
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
                    }
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

        <div class="panel-heading" style="department:#191970;"><b>Designations Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/designation/form.php')">Designation Info</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="designation_info_form" id="designation_info_form">

            <div class="form-group form-group-sm" id="form-group_for_designation_name">
                <label class="control-label col-sm-3" for="designation_name" style="department:#00008B;">Designation Name:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="designation_name" name="designation_name" placeholder="Enter Designation Name" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('designation_name')"></i>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_department_name"> -->

            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary" onClick="sending_data_of_designation_info_form_for_saving_in_database()">Submit</button>
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
            <label class="control-label col-sm-5" for="search">Designation List</label>
        </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm">
            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>SI</th>
                    <th>Designation Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $s1 = 1;
                $sql_for_designation = "SELECT * FROM designation_info ORDER BY id ASC";

                $res_for_designation = mysqli_query($con, $sql_for_designation);

                while ($row = mysqli_fetch_assoc($res_for_designation))
                {
                ?>
                <tr>
                    <td><?php echo $s1; ?></td>
                    <td><?php echo $row['designation_name']; ?></td>
                    <td>


                        <button type="submit" id="edit_designation" name="edit_designation"  class="btn btn-primary btn-xs" onclick="load_page('settings/designation/edit.php?designation_id=<?php echo $row['id'] ?>')"> Edit </button>
                        <span>  </span>

                        <button type="submit" id="delete_designation" name="delete_designation"  class="btn btn-danger btn-xs" onclick="load_page('settings/designation/delete.php?designation_id=<?php echo $row['id'] ?>')"> Delete </button>
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

    </div> <!-- End of <div class="panel panel-default"> -->


</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
