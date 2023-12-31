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
?>
<script type='text/javascript' src='user/department_info_form_validation.js'></script>

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


       var validate = Department_Form_Validation();
       var url_encoded_form_data = $("#department_info_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {

		  	 $.ajax({
			 		url: 'user/department_info_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
			 				if(data == 'Data is successfully saved.')
                            {
                                $.ajax({
                                    url: 'user/department_list_load.php',
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

				<div class="panel-heading" style="department:#191970;"><b>Department Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					     <li class="breadcrumb-item"><a onclick="load_page('user/department_info.php')">Department Info</a></li>
					  </ol>
				</nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="department_info_form" id="department_info_form">

						<div class="form-group form-group-sm" id="form-group_for_location">
								<label class="control-label col-sm-3" for="location" style="department:#00008B;">Location:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('location')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_location"> -->

						<div class="form-group form-group-sm" id="form-group_for_department_name">
								<label class="control-label col-sm-3" for="department_name" style="department:#00008B;">Department Name:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="department_name" name="department_name" placeholder="Enter Department Name" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('department_name')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_department_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_section_name">
								<label class="control-label col-sm-3" for="section_name" style="department:#00008B;">Section Name:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="section_name" name="section_name" placeholder="Enter Section Name" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('section_name')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_section_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_contact_person_name">
								<label class="control-label col-sm-3" for="contact_person_name" style="department:#00008B;">Contact Person Name:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="contact_person_name" name="contact_person_name" placeholder="Enter Contact Person Name" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('contact_person_name')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_contact_person_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_contact_no">
								<label class="control-label col-sm-3" for="contact_no" style="department:#00008B;">Contact No:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact No" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('contact_no')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_contact_no"> -->

						<div class="form-group form-group-sm" id="form-group_for_email">
								<label class="control-label col-sm-3" for="email" style="department:#00008B;">Email:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('email')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_email"> -->

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
	          <label class="control-label col-sm-5" for="search">Department List</label>
	    </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm" >
         <table id="datatable-buttons" class="table table-striped table-bordered">
         	<thead>
                 <tr>
                 <th>SI</th>
                 <th>Department Name</th>
                 <th>Location</th>
                 <th>Section Name</th>
                 <th>Contact Person</th>
                 <th>Contact Number</th>
                 <th>Action</th>
                 </tr>
            </thead>
            <tbody id="table_body">
                    <?php
                                    $s1 = 1;
                                    $sql_for_department = "SELECT * FROM department_info ORDER BY id ASC";

                                    $res_for_department = mysqli_query($con, $sql_for_department);

                                    while ($row = mysqli_fetch_assoc($res_for_department))
                                    {
                     ?>

                 <tr>
                    <td><?php echo $s1; ?></td>
                    <td><?php echo $row['department_name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['section_name']; ?></td>
                    <td><?php echo $row['contact_person_name']; ?></td>
                    <td><?php echo $row['contact_no']; ?></td>
                    <td>


                            <button type="submit" id="edit_department" name="edit_department"  class="btn btn-primary btn-xs" onclick="load_page('user/edit_department_info.php?department_id=<?php echo $row['id'] ?>')"> Edit </button>
                           <span>  </span>

                             <button type="submit" id="delete_department" name="delete_department"  class="btn btn-danger btn-xs" onclick="load_page('user/department_info_deleting.php?department_id=<?php echo $row['id'] ?>')"> Delete </button>
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