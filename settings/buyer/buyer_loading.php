<?php
session_start();
require_once("../../login/session.php");
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

?>
<thead>
       <tr>
       <th>SI</th>
       <th>buyer Name</th>
       <th>buyer Address</th>
       <th>Country of Origin</th>
       <th>Action</th>
       </tr>
  </thead>
  <tbody>
          <?php
                  $s1 = 1;
                  $sql_for_buyer = "SELECT * FROM buyer ORDER BY buyer_id ASC";

                  $res_for_buyer = mysqli_query($con, $sql_for_buyer);

                  while ($row = mysqli_fetch_assoc($res_for_buyer))
                  {
          ?>

   <tr>
      <td><?php echo $s1; ?></td>
      <td><?php echo $row['buyer_name']; ?></td>
      <td><?php echo $row['buyer_address']; ?></td>
      <td><?php echo $row['country_of_origin']; ?></td>


      <td>

              <button type="submit" id="" name="" class="btn btn-primary btn-xs" onclick="load_page('settings/buyer/edit_buyer.php?buyer_id=<?php echo $row['buyer_id']?>')"> Edit </button>

              <button type="submit" id="" name="" class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['buyer_id']?>')"> Delete </button>

          </td>
      <?php

      $s1++;
                        }
       ?>
   </tr>
</tbody>
