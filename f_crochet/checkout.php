<!DOCTYPE html>
<html lang="en" dir="ltr">



<?php
include 'setup.php';
include 'nav.php';

$user_id = $sessData['userID'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
  $email = $row["email"];
  $fname = $row["first_name"];
  $lname = $row["last_name"];
}


$prod_ids = $_POST['prod_ids'];
$amounts = $_POST['amounts'];
$cost = $_POST['cost'];

?>
<head>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <meta charset="utf-8">
    <title>Fiona's Crochet | Home</title>
</head>

<body>

<div class="section group">
  <div class="span_2_of_3">
    <div class="container">
      <form method="post" action="invoice/iaction.php">
        <input type="hidden" name="cost" value="<?php echo $_POST['cost']; ?>">
        <input type="hidden" name="fname" value="<?php echo $fname; ?>">
        <input type="hidden" name="lname" value="<?php echo $lname; ?>">
        <input type="hidden" name="items" value="<?php echo $prod_ids; ?>">
        <input type="hidden" name="amounts" value="<?php echo $amounts; ?>">
        <input type="hidden" name="total" value="<?php echo $cost; ?>">
        <h1>Billing Address</h1>
        <table>
          <tr>
            <td>Full Name: </td>
            <td> <input required type="text" id="fname" name="name" placeholder="Full Name..." value="<?php echo $fname." ". $lname; ?>"></td>
          </tr>
          <tr>
            <td>Email </td>
            <td><input required type="text" id="email" name="email" placeholder="Email..." value="<?php echo $email; ?>"></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><input required type="text" id="adr" name="address" placeholder="Address..."></td>
          </tr>
          <tr>
            <td>Postal code:</td>
            <td><input required type="text" id="zip" name="postal_code" placeholder="0000"></td>
          </tr>
          <tr>
            <td>Name on card:</td>
            <td><input required type="text" id="cname" name="cardname" value="<?php echo $fname." ". $lname; ?>"></td>
          </tr>
          <tr>
            <td>Card Number:</td>
            <td><input required type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444"></td>
          </tr>
          <tr>
            <td>Exp Month:</td>
            <td><input required type="text" id="expmonth" name="expmonth" placeholder="Month"></td>
          </tr>
          <tr>
            <td>Exp Year:</td>
            <td><input required type="text" id="expyear" name="expyear" placeholder="Year"></td>
          </tr>
          <tr>
            <td>CVV</td>
            <td><input required type="text" id="cvv" name="cvv" placeholder="352"></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="span_1_of_3">
      <div class="container">
        <h4>Cart</h4>
<?php
$prod_ids = explode(",",$prod_ids);
$amounts = explode(",", $amounts);
        $total = array();
        $item_t = 0;
        foreach ($prod_ids as $key => $value) {

          $sql = "SELECT * FROM products WHERE prod_key='$value'";
          $result = $conn->query($sql);

          $row = $result->fetch_assoc();
          // output data of each row
          $prod_key = $row["prod_key"];
          $name =  $row["name"];
          $cost = $row["cost"];

          //trying to calculate the total
          $item_t = (int)$amounts[$key] * $cost;

          array_push($total, "$item_t");

          ?>
          <div class="items">
            <h3></h3>
            <p><?php echo $name; ?> <span class="price">$<?php echo $cost;?></span></p>

          </div>
          <?php
          }

          $total = array_sum($total);
          ?>


        <hr>
        <p>Total <span class="price" style="color:black"><b>$<?php echo $total; ?></b></span></p>
      </div>
    </div>
  </div>

        <input type="submit" value="Continue to checkout" class="btn">
      </form>


</body>

</html>
