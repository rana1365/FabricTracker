<?php
session_start();
include('../login/db_connection_class.php');
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


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

</style>




<div class="col-sm-12 col-md-12 col-lg-12">

   <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

			    <nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					     <li class="breadcrumb-item"><a onclick="load_page('user/user_list.php')">User List</a></li>
					  </ol>
				</nav>

        <form class="form-horizontal" action="POST" style="margin-top:10px;" name="user_list_form" id="user_list_form">
 	                    

 	                    <div class="form-group form-group-sm table-responsive">
				          <label class="col-sm-offset-7 control-label col-sm-1" for="search">Search</label>
				          <div class="col-sm-4">
				             <input type="text" id="my_input" class="form-control " onkeyup="my_function()" placeholder="Please Type User Name Keyword">
				           </div>
				        </div> <!-- End of <div class="form-group form-group-sm" -->

				      <div class="form-group form-group-sm">
					        <table id="datatable-buttons" class="table table-striped table-bordered">
					         	<thead>
					                 <tr>
					                 <th>SI</th>
					                 <th>User Name</th>
					                 <th>User ID</th>
					                 <th>User Type</th>
					                 <th>Email</th>
					                 <th>Contact No.</th>
					                 <th>Department</th>
					                 <th>Designation</th>
                                         <th>Profile</th>
					                 <th>status</th>
					                 <th>Action</th>
					                 </tr>
					            </thead>
					            <tbody>
					            <?php 
					                            $s1 = 1;
					                            $sql_for_user_list = "SELECT * FROM user_login";

					                            $res_for_user_list = mysqli_query($con, $sql_for_user_list);

					                            while ($row = mysqli_fetch_assoc($res_for_user_list)) 
					                            {
					             ?>

					             <tr>
					                <td><?php echo $s1; ?></td>
					                <td><?php echo $row['user_name']; ?></td>
					                <td><?php echo $row['user_id']; ?></td>
					                <td><?php echo $row['user_type']; ?></td>
					                <td><?php echo $row['email']; ?></td>
					                <td><?php echo $row['contact_no']; ?></td>
					                <td><?php echo $row['department']; ?></td>
					                <td><?php echo $row['designation']; ?></td>
                                     <td>
                                         <img src="img/<?php echo $row['profile_picture']; ?>" alt="Girl in a jacket" width="50" height="50">
                                     </td>
					                <td><?php echo $row['status']; ?></td>
					                <td>
					                      
                                        <button type="submit" id="" name="" class="btn btn-primary btn-xs" onclick="load_page('user/edit_user.php?user_id=<?php echo $row['user_id']?>')"> Edit </button>


                                         <button type="submit" id="" name="" class="btn btn-danger btn-xs" onclick="load_page('user/user_deleting.php?user_id=<?php echo $row['user_id']?>')"> Delete </button>
					                     
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

                   
                        // Setup - add a text input to each footer cell
                       /* $('#datatable-buttons thead tr').clone(true).appendTo( '#datatable-buttons thead' );
                        $('#datatable-buttons thead tr:eq(1) th').each( function (i) {
                            var title = $(this).text();
                            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

                            $( 'input', this ).on( 'keyup change', function () {
                                if ( table.column(i).search() !== this.value ) {
                                    table
                                        .column(i)
                                        .search( this.value )
                                        .draw();
                                }
                            } );
                        } );*/
                      /*$(document).ready(function() {
                        var table = $('#datatable-buttons').DataTable( {
                           scrollY:        "500px",
                            scrollX:        true,
                            scrollCollapse: true,
                            paging:         true,
                            columnDefs: [
                                { width: '0%', targets: 0 }
                            ],
                            

                        } );
                    } );*/
						    </script>


						

			</form> <!-- End Of <form class="form-horizontal" action="POST" style="margin-top:10px;" name="user_list_form" id="user_list_form"> -->

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->