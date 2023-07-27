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
    <script type='text/javascript' src='user/designation_info_form_validation.js'></script>

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
        function approve_event(val)
        {

          let data;
          let order_id=$("#order_id"+val).val()

          let event_id=$("#event_id"+val).val()
          let buyer_id=$("#buyer_id"+val).val()
          let approver_id=$("#approver_id"+val).val()
          let event_name=$("#event_name"+val).val()
          if(event_name=="GD" || event_name=="Work Order"){
            let gd_wo_number=$("#gd_wo_number"+val).val()
            if(gd_wo_number==""){
              alert("Please add "+event_name+" number!")
              return false;
            }
            let gd_wo_length=$("#gd_wo_length"+val).val()
            if(gd_wo_length==""){
              alert("Please add "+event_name+" length!")

              return false;
            }


           data = {
                  order_id: order_id,
                  event_id: event_id,
                  buyer_id: buyer_id,
                  approver_id: approver_id,
                  event_name:event_name,
                  gd_wo_number:gd_wo_number,
                  gd_wo_length:gd_wo_length,
                  approval_status: "approved"

              };
            }else{
               data = {
                      order_id: order_id,
                      event_id: event_id,
                      buyer_id: buyer_id,
                      approver_id: approver_id,
                      event_name:event_name,

                      approval_status: "approved"

                  };
            }
                $.ajax({
                    url: 'events/approve.php',
                    dataType: 'text',
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    data: data,
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

        }//End of function sending_data_of_department_info_form_for_saving_in_database()


        function dis_approve_event(val)
        {
          let order_id=$("#order_id").val()
          let event_id=$("#event_id").val()
          let buyer_id=$("#buyer_id").val()
          let approver_id=$("#approver_id").val()
          let data = {
                  order_id: order_id,
                  event_id: event_id,
                  buyer_id: buyer_id,
                  approver_id: approver_id,
                  approval_status: "rejected"

              };

                $.ajax({
                    url: 'events/approve.php',
                    dataType: 'text',
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    data: data,
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

        }//End of function sending_data_of_department_info_form_for_saving_in_database()



    </script>
    <div class="col-sm-12 col-md-12 col-lg-12">

        <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

            <div class="panel-heading" style="department:#191970;"><b>Designations Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                    <li class="breadcrumb-item"><a onclick="load_page('user/designation_info.php')">Designation Info</a></li>
                </ol>
            </nav>







        </div> <!-- End of <div class="panel panel-default"> -->





        <div class="panel panel-default">

            <div class="form-group form-group-sm">
                <label class="col-sm-offset-7 control-label col-sm-1" for="search">Search</label>
                <div class="col-sm-4">
                    <input type="text" id="my_input" class="form-control " onkeyup="my_function()" placeholder="Please Type Department Name Keyword">
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" -->




            <div class="form-group form-group-sm">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>SI</th>
                        <th>Buyer Name</th>
                        <th>Order No</th>
                        <th>Event Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                      <?php
                      $s1 = 1;
                     $sql_for_designation = "
                        SELECT event_wise_user.user_id, orders.order_id, event_info.event_name,
                        buyer.buyer_name, buyer.buyer_id, event_info.event_id  FROM `event_info`, buyer,event_wise_buyer,event_wise_user,orders WHERE event_info.event_id = event_wise_buyer.event_id and event_wise_buyer.buyer_id=buyer.buyer_id and buyer.buyer_id=orders.buyer_id
                        and event_wise_user.event_id = event_info.event_id and event_wise_user.user_id=(select user_info.id from user_info WHERE user_info.user_id='$user_id')";

                      $res_for_designation = mysqli_query($con, $sql_for_designation);

                      while ($row = mysqli_fetch_assoc($res_for_designation))
                      {


                        $select_sql_for_duplicacy="select * from `event_approve`
                        where `order_id`=$row[order_id]
                        and `event_id`=$row[event_id] and
                        `buyer_id`=$row[buyer_id] and
                        `approver_id`=$row[user_id]";
                        $result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

                        if(mysqli_num_rows($result)>0)
                        {
                          continue;
                        }

                      ?>
                      <input type="hidden"
                       name="order_id<?php echo $s1?>"
                       id="order_id<?php echo $s1?>"
                       value="<?php echo $row['order_id']?>">
                        <input type="hidden"
                           name="event_id<?php echo $s1?>"
                           id="event_id<?php echo $s1?>"
                           value="<?php echo $row['event_id']?>">
                           <input type="hidden"
                            name="buyer_id<?php echo $s1?>"
                            id="buyer_id<?php echo $s1?>"
                            value="<?php echo $row['buyer_id']?>">

                            <input type="hidden"
                             name="approver_id<?php echo $s1?>"
                              id="approver_id<?php echo $s1?>"
                             value="<?php echo $row['user_id']?>">

                             <input type="hidden"
                              name="event_name<?php echo $s1?>"
                               id="event_name<?php echo $s1?>"
                              value="<?php echo $row['event_name']?>"
                              >

                    <tr>
                        <td><?php echo $s1; ?></td>
                        <td><?php echo $row['buyer_name']; ?></td>
                        <td><?php echo $row['order_id']; ?></td>
                        <td>

                          <?php echo $row['event_name'];

                          if($row['event_name']=="GD" || $row['event_name']=="Work Order"){
                            ?>

                            <div class="">
                              <input type="text"
                               name="gd_wo_number<?php echo $s1?>"
                                id="gd_wo_number<?php echo $s1?>"
                               placeholder="<?php echo $row['event_name']?> Number"
                               >

                            </div>

                            <div class="">

                              <input type="text"
                               name="gd_wo_length<?php echo $s1?>"
                               id="gd_wo_length<?php echo $s1?>"
                               placeholder="<?php echo $row['event_name']?> length"
                               >
                            </div>
                            <?php
                          }
                           ?>
                        </td>

                        <td>
                            <button type="button"
                            id="edit_designation<?php echo $s1?>" name="edit_designation<?php echo $s1?>"  class="btn btn-primary btn-xs"
                            onclick="approve_event(<?php echo $s1?>)"> Approve </button>
                            <span>  </span>

                            <button type="button"
                            id="delete_designation<?php echo $s1?>"
                             name="delete_designation<?php echo $s1?>"
                             class="btn btn-danger btn-xs"
                              onclick="dis_approve_event(<?php echo $s1?>)"> Reject </button>
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
