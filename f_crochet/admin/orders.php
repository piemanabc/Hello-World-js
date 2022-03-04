<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!--page_container opening-->

  <head>
      <link rel="stylesheet" type="text/css" href="../css/style.css">
      <meta charset="utf-8">
      <title>Fiona's Crochet | Home</title>
  </head>

  <?php
  include '../setup.php';

$sql="SELECT orders.order_id, orders.completed, orders.items,  orders.amounts,  orders.total,  orders.address,  orders.postal_code,  users.first_name
FROM orders
LEFT JOIN users ON orders.user_id=users.id";
$result = $conn->query($sql) or die($conn->error);



 //$loop = $result->num_rows;
include 'anav.php';
?>
          <div id="container">
            <!--main content div starts below-->
            <div class="span_3_of_3">



              <h1>All orders</h1>
              <p>This is all the orders that have been ganialised and paid for. For more info on a order click the "more info" link</p>
                <?php
                      if ($result->num_rows > 0) {
                        ?>
                        <table class="results">
                          <tr class="results">
                            <th> order_id</th>
                            <th> user_id</th>
                            <th> Name</th>
                            <th> Items (IDs)</th>
                            <th> amounts</th>
                            <th> completed</th>
                            <th> More info</th>
                          </tr>
                          <?php
                            while($row = $result->fetch_assoc()) {
                                $order_id = $row["order_id"];
                                $cost = $row["total"];
                                $address = $row["address"];
                                $pcode = $row['postal_code'];
                                $items = $row['items'];
                                $amounts = $row['amounts'];
                                $name = $row['first_name'];
                                $comp = $row['completed']
                                ?>
                                <tr class="results">
                                  <td> <?php echo $order_id; ?></td>
                                  <td> <?php echo $user_id; ?></td>
                                  <td> <?php echo $name; ?></td>
                                  <td> <?php echo $items; ?></td>
                                  <td> <?php echo $amounts; ?></td>
                                  <td> <?php if ($comp == 1 ) {
                                    echo "yes";
                                  } elseif ($comp == 0) {
                                    echo "no";
                                  }?></td>
                                  <td> <a style="text-decoration: underline; "href="com.php?ord=<?php echo $order_id; ?>">More Info</a></td>
                                </tr>
                                <?php
                                }
                              }

                          else {
                           echo "0 results";
              }
              ?>
              </div>
              </div>
              <?php

include '../footer.html';
?>
