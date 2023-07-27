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

<div class="panel panel-default">

        <div class="form-group form-group-sm">
            <label class="col-sm-offset-7 control-label col-sm-1" for="search">Search</label>
            <div class="col-sm-4">
                <input type="text" id="my_input" class="form-control " onkeyup="my_function()" placeholder="Please Type Department Name Keyword">
            </div>
        </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm">
            <label class="control-label col-sm-5 text-center" for="search">Event Wise Order & Buyer Profile List</label>
        </div> <!-- End of <div class="form-group form-group-sm" -->

        <div class="form-group form-group-sm" >
            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                <tr >
                    <th style="text-align: center">SI</th>
                    <th style="text-align: center">Buyer Name</th>
                    <th style="text-align: center">Event Name</th>
                    <th style="text-align: center">Event Days</th>
                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                <?php
                $s1 = 1;
                $sql_for_ewu_info = "
                SELECT buyer_id, multi_events
                FROM buyer_profile
                WHERE buyer_profile_id IN (SELECT buyer_profile_id
                FROM orders
                WHERE order_id = '$order_id');
                ";

                $res_for_ewu = mysqli_query($con, $sql_for_ewu_info);
                while ($row = mysqli_fetch_assoc($res_for_ewu))
                {
                ?>

                <tr>
                    <td><?php echo $s1; ?></td>

                    <td></td>
                    <td></td>
                    <td></td>

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

    </div>