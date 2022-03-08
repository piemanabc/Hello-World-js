<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!--page_container opening-->

  <head>
      <link rel="stylesheet" type="text/css" href="../css/style1.css">
      <meta charset="utf-8">
      <title>Fiona's Crochet | Home</title>
  </head>

  <?php
  include '../setup.php';

include 'anav.php';
// if they want a com do this
if (empty($_GET['ord'])) {

 $sql="SELECT * FROM `coms`";
 $result = $conn->query($sql);
 while($row = $result->fetch_assoc()) {
     $com_id = $row["com_ID"];
     $email = $row["email"];
     $request = $row['request'];
     $completed = $row['completed'];
   }

?>
          <div id="container">


            <!--main content div starts below-->
            <div class="section group">
              <h1>Rquest for <?php echo $email ?></h1>
              <div class="col span_2_of_3">
                <h3>Request:</h3>
                <?php echo $request; ?>
                 <br>
                 <br>
                  Completed:
                  <?php if ($completed == 1 ) {
                    echo "yes";
                  } elseif ($completed == 0) {
                    echo "no";} ?>
                    <br>
                    <br>
                    <a href="mailto:<?php echo $email; ?>">Email Customer</a>
                    <br><br>

                    Change status:

                    <table>
                   <tr>
                     <td>
                       <form class="" method="get" name="form" action="aaction.php">
                         <input type="hidden" name="ovc" value="c">
                         <input type="hidden" name="statchng" value="1">
                         <input type="hidden" name="comid" value="<?php echo $com_id; ?>">
                         <br>
                             status:
                             <br>
                             <select class="" name="newstat" class="add_to_cart">
                               <option value="<?php echo $completed; ?>">(please choose)</option>
                               <option value="0">Incomplete</option>
                               <option value="1">Completed</option>
                           </td>
                         <tr>
                           <div class="send-button">
                           <td width="50%"><input type="submit" name="" value="Update"></td>
                         </div>
                         </tr>
                       </table>
                       </form>
              <?php

              // if they want a order do this
} elseif (empty($_GET['com'])) {
  $sql="SELECT orders.order_id, orders.completed, orders.items,  orders.amounts,  orders.total,  orders.address,  orders.postal_code,  users.first_name, users.last_name
  FROM orders
  LEFT JOIN users ON orders.user_id=users.id";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
      $order_id = $row["order_id"];
      $prod_ids = explode(",",$row["items"]);
      $amount = explode(",",$row["amounts"]);
      $name = $row['first_name'] . " " . $row['last_name'];
      $cost = $row["total"];
      $address = $row["address"];
      $pcode = $row['postal_code'];
      $comp = $row['completed'];
    }

    ?>
    <h1>Order for <?php echo $name; ?></h1>
    <h2>Cost:   $<?php echo $cost; ?></h2>
    Completed: <?php if ($comp == 1 ) {
      echo "yes";
    } elseif ($comp == 0) {
      echo "no";} ?>
    <h3>address:</h3>
    <p><?php echo $address; ?><br>
        postal code: <?php echo $pcode; ?>
    </p>


    <table>
    <tr>
     <td>
       <form class="" method="get" name="form" action="aaction.php">
         <input type="hidden" name="ovc" value='o'>
         <input type="hidden" name="statchng" value="1">
         <input type="hidden" name="ordid" value="<?php echo $order_id; ?>">
         <br>
             status:
             <br>
             <select class="" name="newstat" class="add_to_cart">
               <option value="<?php echo $completed; ?>">(please choose)</option>
               <option value="0">Incomplete</option>
               <option value="1">Completed</option>
           </td>
         <tr>
           <td width="50%"><input type="submit" name="" value="Update"></td>
         </tr>
       </table>
       </form>
    <p>Listed below is all of the items on the order:</p>

    <?php
    foreach ($prod_ids as $key => $value) {

      $sql = "SELECT * FROM products WHERE prod_key='$value'";
      $result = $conn->query($sql);

      $row = $result->fetch_assoc();
      // output data of each row


      $prod_key = $row["prod_key"];
      $name =  $row["name"];
      $cost = $row["cost"];
      $image = $row["image"];

      ?>
      <div class="items">
        <h3><?php echo $name; ?></h3>
        <h4>Quantity: <?php echo $amount[$key] ?></h4>
        <img src="../imgs/<?php echo $image; ?>" alt="<?php echo $name; ?>" width="150">


        <?php

        }
}

include '../footer.html';
?>
