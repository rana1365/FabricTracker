<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
error_reporting(0);
?>
<style>
  .tableFixHead {
        overflow-y: auto;
        height: 600px;
      }
      .tableFixHead thead th {
        position: sticky;
        top: 0;
        background-color: gray;
        color:aliceblue
        }
        th{
          background-color:green;
          color:#ffffff;
      }
        table, th, td {
        border: 1px solid black;
      }

</style>

<?php
$input_dates = $_POST['input_date'];

$splitted_input_date = explode("/",$input_dates);

$input_date = $splitted_input_date[2].'-'.$splitted_input_date[0].'-'.$splitted_input_date[1];

$input_date_show = date_format(date_create($input_dates),"l, M d, Y");
$total_man_power_upper=0;
$total_avg_actual_hour_upper=0;
$total_cumilitive_target_qty=0;
$total_cumilitive_achieve_qty=0;
$loss_gain=0;
?>
          <div id="upper_section">

          </div>
          <div id="report_table" style="overflow:scroll">

            <table class="table table-hover table-bordered">
                    <thead>
                        <tr >
                            <th style="border: 1px solid black">Buyer Delivery Slot</th>
                            <th style="border: 1px solid black">Buyer Delivery Date</th>
                            <th style="border: 1px solid black">Order Qty</th>
                            <th style="border: 1px solid black">Color</th>
                            <th style="border: 1px solid black">Booking Date/ GD Issue Date</th>
                            <th style="border: 1px solid black">GD No</th>
                            <th style="border: 1px solid black">Grey Ready Date</th>
                            <th style="border: 1px solid black">Work Order No</th>
                            <th style="border: 1px solid black">Work Order Date-Plan</th>
                            <th style="border: 1px solid black">Work Order Date-Actual</th>
                            <th style="border: 1px solid black">Grey Inhouse Date-Plan</th>
                            <th style="border: 1px solid black">Grey Inhouse Date-Actual</th>
                            <th style="border: 1px solid black">Grey Issue Date- Plan</th>
                            <th style="border: 1px solid black">Grey Issue Date-Actual</th>
                            <th style="border: 1px solid black">Back Process Complete Date_Plan</th>
                            <th style="border: 1px solid black">Back Process Complete Date_Actual</th>
                            <th style="border: 1px solid black">Dying Date_Plan</th>
                            <th style="border: 1px solid black">Dying Date_Actual</th>
                            <th style="border: 1px solid black">PP Print Plan</th>
                            <th style="border: 1px solid black">PP Print Actual</th>
                            <th style="border: 1px solid black">PP approval Date_Plan</th>
                            <th style="border: 1px solid black">PP approval Date_Actual</th>
                            <th style="border: 1px solid black">Bulk Print Date_Plan</th>
                            <th style="border: 1px solid black">Bulk Print Date_Actual</th>
                            <th style="border: 1px solid black">Finishing Date_Plan</th>
                            <th style="border: 1px solid black">Finishing Date_Actual</th>
                            <th style="border: 1px solid black">Inspection Date</th>
                            <th style="border: 1px solid black">Buyer Delivery Date</th>
                            <th style="border: 1px solid black">Actual Delivery Date</th>
                            <th style="border: 1px solid black">Due/ Overdue</th>
                            <th style="border: 1px solid black">Remarks</th>
                            <th style="border: 1px solid black">Status</th>

                          </tr>
                          <?php
        $sql="SELECT o.buyer_delivery_slot,
        o.buyer_delivery_date,o.order_qty,
        o.color,o.order_id,o.buyer_id
        FROM `orders` o";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res))
        {
          $order_id=$row['order_id'];

                          ?>
                          <tr>
                            <td style="border: 1px solid black"><?php echo $row['buyer_delivery_slot']?></td>
                            <td style="border: 1px solid black"><?php echo $row['buyer_delivery_date']?></td>
                            <td style="border: 1px solid black"><?php echo $row['order_qty']?></td>
                            <td style="border: 1px solid black"><?php echo $row['color']?></td>
                            <?php
                            $buyer_id=$row['buyer_id'];
                            ?>
                            <td style="border: 1px solid black">
                              <?php
                               $sql1="SELECT buyer.buyer_name,
                              event_info.event_name,event_wise_buyer.days
                               FROM orders,`event_wise_buyer`,`buyer`,`event_info`
                               WHERE event_wise_buyer.buyer_id=buyer.buyer_id
                                and event_wise_buyer.event_id=event_info.id
                                and event_info.event_name='GD'
                              and buyer.buyer_id='$buyer_id'
                                  and orders.order_id='$order_id'
                                ";

                                $res1 = mysqli_query($con, $sql1);

                              while ($row1 = mysqli_fetch_assoc($res1))
                              {

                                $find_gd_issue_date=$row1['days'];
                              }
                              if($find_gd_issue_date){
                                $buyer_delivery_date=$row['buyer_delivery_date'];
                                $original_date = $buyer_delivery_date;
                                $days_to_subtract = $find_gd_issue_date;
                                $new_date = date('Y-m-d', strtotime("-$days_to_subtract days", strtotime($original_date)));

                                echo $new_date;
                              }

                                ?>

                            </td>
                            <?php
                            //finding GD order and length
                            $sql2="SELECT date(recording_time) as gray_ready_date,
                            event_name,
                            gd_wo_number,
                            gd_wo_length
                            FROM `event_approve`
                            WHERE order_id='$order_id'
                            and event_name='GD'";
                            $res2 = mysqli_query($con, $sql2);

                              ?>
                              <td style="border: 1px solid black">
                                <?php
                                if( mysqli_num_rows($res2) >0)
                                {
                                  while ($row2 = mysqli_fetch_assoc($res2))
                                  {
                                    $gd_wo_number=$row2['gd_wo_number'];
                                    $gd_wo_length=$row2['gd_wo_length'];
                                    $gray_ready_date=$row2['gray_ready_date'];

                                  }
                              }else{
                                $gd_wo_number='';
                                $gd_wo_length='';
                                $gray_ready_date='';

                              }
                                echo $gd_wo_number;
                              ?>

                            </td>
                            <td style="border: 1px solid black"><?php echo $gray_ready_date?></td>
                            <td style="border: 1px solid black">
                              <!-- Work Order Number -->

                            <?php
                            $sql_wo_number="SELECT date(recording_time) as gray_ready_date,
                             event_name,
                             gd_wo_number,
                             gd_wo_length
                             FROM `event_approve`
                             WHERE order_id='$order_id'
                             and event_name='Work Order'";
                              $res_wo_number = mysqli_query($con, $sql_wo_number);

                                 if( mysqli_num_rows($res_wo_number) >0)
                                 {
                                   while ($row_wo = mysqli_fetch_assoc($res_wo_number))
                                   {
                                     $wo_number=$row_wo['gd_wo_number'];
                                     $wo_length=$row_wo['gd_wo_length'];
                                     $wo_ready_date=$row_wo['gray_ready_date'];

                                   }
                               }else{
                                 $wo_number='';
                                 $wo_length='';
                                 $wo_ready_date='';
                               }
                                 echo $wo_number;
                               ?>
                            </td>
                            <td style="border: 1px solid black">
                        <?php
                        $sql3="SELECT buyer.buyer_name,
                        event_info.event_name,event_wise_buyer.days
                         FROM `event_wise_buyer`,`buyer`,`event_info`,orders
                         WHERE event_wise_buyer.buyer_id=buyer.buyer_id
                          and event_wise_buyer.event_id=event_info.id
                          and event_info.event_name='Work Order'
                        and buyer.buyer_id='$buyer_id'
                        and orders.order_id='$order_id'
                          ";
                          $res3 = mysqli_query($con, $sql3);

                        while ($row3 = mysqli_fetch_assoc($res3))
                        {

                          $find_wo_issue_date=$row3['days'];
                        }
                        if($find_wo_issue_date){
                          $days_to_subtract = $find_wo_issue_date;

                          $new_date = date('Y-m-d', strtotime("-$days_to_subtract days", strtotime($original_date)));

                          echo $new_date;
                        }
                         ?>

                            </td>

                            <td style="border: 1px solid black"><?php echo
                            $wo_ready_date?></td>

                          <!-- wiil create a array with event buyer_name
                          then find the issue + approve date  -->
                          <!-- //first doing this for 3 row -->
                          <?php

                          $event_array = [
                            'Grey Inhouse','Grey Issue','Back Process Complete',
                            'Dying','PP Print','PP approval','Bulk Print',
                            'Bulk Print','Finishing','Inspection'

                          ];

                          for ($i=0; $i <count($event_array) ; $i++) {
                            $event_name=$event_array[$i];
                            $sql_issue="SELECT event_wise_buyer.days
                            FROM `orders` INNER JOIN  event_wise_buyer ON
                            event_wise_buyer.buyer_id=orders.buyer_id
                            INNER JOIN event_info ON
                            event_info.id=event_wise_buyer.event_id
                            and orders.order_id='$order_id'
                            and event_info.event_name='$event_name'";


                            $res_issue = mysqli_query($con, $sql_issue);
                            $find_wo_issue_date='';
                            while ($row_issue = mysqli_fetch_assoc($res_issue))
                            {
                              $find_wo_issue_date=$row_issue['days'];
                            }
                            $issue_date='';
                            if($find_wo_issue_date){
                              $days_to_subtract = $find_wo_issue_date;

                              $issue_date = date('Y-m-d', strtotime("-$days_to_subtract days", strtotime($original_date)));


                            }
                            ?>
                            <td style="border: 1px solid black"><?php echo $issue_date;?></td>

                              <?php
                            $sql_receive="SELECT date(recording_time) as
                            ready_date
                             FROM `event_approve`
                             WHERE order_id='$order_id'
                             and event_name='$event_name'";
                             $res_receive = mysqli_query($con, $sql_receive);
                             $receive_date='';
                                 while ($row_receive = mysqli_fetch_assoc($res_receive))
                                 {
                                   $receive_date=$row_receive['ready_date'];

                                 }
                            ?>
                            <td style="border: 1px solid black"><?php echo $receive_date; ?></td>


                            <?php
                          }

                          ?>
                            <td style="border: 1px solid black"></td>
                            <td style="border: 1px solid black"></td>
                          </tr>
              <?php
                }
             ?>

                    </tbody>
                </table>


            </div>
            <div class="col-sm-12" id="export_to_excel_file">
                <button class="btn btn-success"><a id="downloadLink" onclick="exportF(this)">Export to excel</a></button>
            </div>
<script type="text/javascript">
function exportF(elem)
  {
      var table = document.getElementById("report_table");
      var html = table.innerHTML;
      var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url
      elem.setAttribute("href", url);
      elem.setAttribute("download", "output_board.xls"); // Choose the file name
      return false;
  }

</script>
