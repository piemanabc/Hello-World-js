<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <meta charset="utf-8">
    <title>Fiona's Crochet | Home</title>
</head>

<?php
include 'setup.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$remove = $_GET['remove'];

$sql    = "SELECT * FROM cart WHERE user_id=$user_id";
$result = $conn->query($sql);
$row    = $result->fetch_assoc();

if ($result->num_rows > 0) {
    // output data of each row
    $prod_ids = explode(", ", $row['prod_ids']);
    $amounts  = explode(", ", $row['amount']);
    $cart     = $row['cart_id'];

    echo "old amounts values ";
    print_r($amounts);

    $inarray = in_array($remove, $prod_ids);
    // if tis already in cart, add together
    if ($inarray == TRUE) {
        $key = array_search($remove, $prod_ids);


        // take one from the current amount if it is larger than 1
        if ($amounts[$key] > 1) {
            // find the old value
            $oamount = $amounts[$key];
            echo "old amount" . $oamount;
            // set the new one
            $namount = $oamount - 1;

            echo "new amount" . $namount;
            // make new amount an array
            $namount = array($namount);

            // put in the new one
            $amounts = array_replace($amounts, $namount);
            echo "new amounts values ";
            print_r($amounts);
        } elseif (($key = array_search($remove, $prod_ids)) !== false) {
            unset($prod_ids[$key]);
            unset($amounts[$key]);
        }


        if (count($prod_ids) > 0) {
            $prod_ids = implode(", ", $prod_ids);
            $amounts  = implode(", ", $amounts);
        } else {
          $sql = "DELETE FROM cart WHERE user_id=$user_id";
          $conn->query($sql);
          header("Location: cart.php", true, 301);
          }
        }

        $sql = "UPDATE cart SET prod_ids = '$prod_ids', amount = '$amounts' WHERE user_id = $user_id";

        if ($conn->query($sql)) {
            header("Location: cart.php", true, 301);
        } else {
            echo "there was a problem. Big oopsie";
        }





} else {
    echo "no results";
}

?>

</html>
