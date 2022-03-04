<!DOCTYPE html>
<html>
<?php
include 'setup.php';
$user_id = $sessData['userID'];
// grab user info
$sql     = "SELECT * FROM users WHERE id='$user_id'";
$result  = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $row   = $result->fetch_assoc();
    $fname = $row["first_name"];
    $lname = $row["last_name"];
    $email = $row["email"];
    $phone = $row["phone"];
}
$sql    = "SELECT order_id FROM orders WHERE user_id='$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row      = $result->fetch_assoc();
    $order_id = $row['order_id'];
}
// grab order info
$sql    = "SELECT * FROM orders WHERE order_id='$order_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $row      = $result->fetch_assoc();
    $prod_ids = $row["items"];
    $amounts  = $row["amounts"];
    $address  = $row["address"];
    $postal_c = $row["postal_code"];
} else {
    echo "error";
}
$date   = date('d/m/y', time());
// grab cart
$sql    = "SELECT * FROM orders WHERE order_id='$order_id'";
$result = $conn->query($sql);
// if they have a cart edit it

    // output data of each row
    $prod_ids = $_SESSION['prod_ids'];
    $prod_ids = explode(", ", $_SESSION['prod_ids']);
    $amounts  = explode(", ", $_SESSION['amounts']);

$total = array();
foreach ($prod_ids as $key => $value) {
    $sql    = "SELECT * FROM products WHERE prod_key='$value'";
    $result = $conn->query($sql);
    $row    = $result->fetch_assoc();
    $cost   = $row["cost"];
    //trying to calculate the total
    $item_t = (int) $amounts[$key] * $cost;
    array_push($total, "$item_t");
}
$total = array_sum($total);
?>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>Invoice for order #</title>

    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <link rel='stylesheet' type='text/css' href='css/print.css' media="print" />


</head>

<body>

    <div id="page-wrap">

        <div id="header">INVOICE</div>

        <div id="identity">

            <div id="address">
              <h4>Seller:</h4>
              Fiona Rutherford <br>
              10 Woodcocks Road <br>
              Warkworth, 2232 <br>

              Phone: (555) 555-5555



              <h4>Buyer:</h4>
              <?php
echo $fname . " ";
echo $lname;
?> <br>
              <?php
echo $email;
?> <br>


              Phone: <?php
echo $phone;
?>
             <br>
              <br>


            </div>



            <div id="logo">


              <img id="image" src="images/logo.png" alt="logo" />

        </div>

        <div style="clear:both"><br><br><br></div>

        <div id="customer">

            <div id="customer-title">
              Fiona's Crochet Invoice for order #<?php
echo $order_id;
?>
             </div>

            <table id="meta">
                <tr>
                    <td class="meta-head">Order ID #</td>
                    <td><div><?php
echo $order_id;
?></div></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><div id="date"><?php
echo $date;
?></div></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">$ <?php
echo $total;
?></div></td>
                </tr>

            </table>

        </div>

        <table id="items">

          <tr>
              <th>Item</th>
              <th>Description</th>
              <th>Unit Cost</th>
              <th>Quantity</th>
              <th>Price</th>
          </tr>
<?php
$total = array();
foreach ($prod_ids as $key => $value) {
    $sql       = "SELECT * FROM products WHERE prod_key='$value'";
    $result    = $conn->query($sql);
    $row       = $result->fetch_assoc();
    $prod_key  = $row["prod_key"];
    $name      = $row["name"];
    $prod_desc = $row["prod_desc"];
    $cost      = $row["cost"];
    //trying to calculate the total
    $item_t    = (int) $amounts[$key] * $cost;
    array_push($total, "$item_t");
?>


          <tr class="item-row">
              <td class="item-name"><div class="delete-wpr"><div><?php
    echo $name;
?></div></div></td>
              <td class="description"><div><?php
    echo $prod_desc;
?></div></td>
              <td><div class="cost">$<?php
    echo $cost;
?></div></td>
              <td><div class="qty"><?php
    echo $amounts[$key];
?></div></td>
              <td><span class="price">$<?php
    echo $item_t;
?></span></td>
          </tr>
      <?php
}
$total = array_sum($total);
?>

          <tr>
              <td colspan="2" class="blank"> </td>
              <td colspan="2" class="total-line balance">Total</td>
              <td class="total-value balance"><div class="due">$<?php
echo $total;
?></div></td>
          </tr>

        </table>
        <div id="terms">
          <h5>Terms</h5>
          <div>Atleast 50% of final total Must be paid before production of your requested items begins. <br>
          No Refunds on any products sold. Make sure you have spoken with fiona <i>before</i> Ordering a custom garment. <br>
          Copyright Fiona Rutherford 2019. All rights reserved.
       </div>
        </div>

    </div>

</body>

</html>
