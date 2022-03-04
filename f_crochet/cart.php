<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
include 'setup.php';

if (empty($sessData['userID'])) {
  $user_id = 0;
} else {
  $user_id = $sessData['userID'];
}

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
  $fname = $row["first_name"];
  $lname = $row["last_name"];
}

$sql = "SELECT * FROM cart WHERE user_id='$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();



if ($result->num_rows > 0) {
    // output data of each row
    $prod_ids = explode(", ",$row["prod_ids"]);
    $amount = explode(", ",$row["amount"]);

}

$total = array();

?>

    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="utf-8">
        <title>Fiona's Crochet | Home</title>
    </head>

    <body>
        <!--page_container opening-->
            <?php
    include 'nav.php';

    ?>
          <div class="halfholder">
              <div class="cartleft">
                <div class="cartleftholder">
                  <h2>Here is your cart <?php echo $fname; ?></h2>
                  <br><br>
                  <form method="get" name="form" action="action.php">
                    <input type="hidden" name="clearcart" value="1">
                    <input type="hidden" name="cartadd" value="0">
                    <button type="submit" value="" name="">clear cart</button>
                  </form>
                  <?php
                  $item_t = 0;
                  foreach ($prod_ids as $key => $value) {

                    $sql = "SELECT * FROM products WHERE prod_key='$value'";
                    $result = $conn->query($sql);

                    $row = $result->fetch_assoc();
                    // output data of each row

                    $prod_key = $row["prod_key"];
                    $name =  $row["name"];
                    $cost = $row["cost"];
                    $image = $row["image"];

                    //trying to calculate the total
                    $item_t = (int)$amount[$key] * $cost;

                    array_push($total, "$item_t");

                    ?>
                    <div class="items">


                      <table>
                        <tr>
                          <td><h3><?php echo $name; ?></h3></td>
                          <td></td>
                        </tr>
                          <tr>
                          <td>
                          <img src="imgs/<?php echo $image; ?>" alt="<?php echo $name; ?>" width="50%">
                          </td>

                        <tr>
                          <td>
                              $<?php echo $cost;?>
                              <?php echo "<br> In cart:"; ?>
                              <?php echo $amount[$key]; ?>
                              <?php echo "<br> Total: $"; ?>
                              <?php echo $item_t;?>
                          </td>
                        </tr>



                        <form class="" action="remove.php?remove=<?php echo $prod_ids[$key]; ?>" method="post">
                          <button type="submit" name="button">Remove from  Cart</button>
                        </form>
                        </div>
                    </div>
                    <br>

                    <?php
                    }
                    ?>
                    </table>
                </div>
              </div>
            </div>
          </div>

              <div class="cartright">
              <div class="cartrightholder">
              <br>
              <br>
              <?php
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
              // mid way through making this bit

              ?>
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

                <input type="submit" value="Continue to checkout" class="btn">
              </form>
                    <br>
                    <br><br>

     <?php include 'footer.html'; ?>

    </body>

</html>
