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
    $prod_ids = explode(",",$row["prod_ids"]);
    $amount = explode(",",$row["amount"]);
}

?>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
    <title>Fiona's Crochet | Home</title>
</head>



<body>
  <!--page_container opening-->
  <div id="page_container">
    <?php
    include 'nav.php';
    $total = array();
    ?>
    <div class="row">
      <?php

      if ($user_id > 0) {
        // code...

      if ($result->num_rows > 0) {
      ?>
        <div class="box">
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
              <h3><?php echo $name; ?></h3>
              <img src="imgs/<?php echo $image; ?>" alt="<?php echo $name; ?>" width="150">
              <div class="right">
                $<?php echo $cost;
                echo "<br> In cart:";
                echo $amount[$key];
                echo "<br> Total: $";
                echo $item_t;
                ?>
                <form class="" action="remove.php?remove=<?php echo $prod_ids[$key]; ?>" method="post">
                  <button type="submit" name="button">Remove from  Cart</button>

                </form>
              </div>
            </div>
            <?php
            }
            ?>

          <div class="items">
            <?php
            $total = array_sum($total);
            echo "Your total is: $".$total;

            $prod_ids = implode(", ", $prod_ids);
            $amount  = implode(", ", $amount);
            ?>

              <div class='right'>
                <form method="post" name="form" action="checkout.php">
                  <input type="hidden" name="cost" value="<?php echo $total; ?>">
                  <input type="hidden" name="prod_ids" value="<?php echo $prod_ids; ?>">
                  <input type="hidden" name="amounts" value="<?php echo $amount; ?>">
                  <button type="submit" value="" name="">Continue to checkout</button>
                </form>
              </div>
          </div>
          </div>
          <?php
          } else {
            echo "You have nothing in your cart. <a href='shop.php'>Add some here!</a>";
          }
        $conn->close();
        }
        else {

          ?>
          <div class="not-logged-in">


          You're not logged in!<a href="loginnew.php"> Try logging in here</a>

          </div>
          <?php
        }
        ?>
      </div>
      <!--wrapper closing-->
      <?php include 'footer.html'; ?>
    </div>

<!--page_container closing-->
  </body>
</html>
