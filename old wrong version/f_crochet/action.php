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

if (empty($_GET['cartadd'])) {
  $cart_add = 0;
} else {
  $cart_add = $_GET['cartadd'];
}

if (empty($_GET['clearcart'])) {
  $cart_del = 0;
} else {
  $cart_del = $_GET['clearcart'];
}

if (empty($_POST['com'])) {
  $com = 0;
} else {
  $com = $_POST['com'];
}


if ($user_id == 0) {
  header("Location: loginnew.php?plslog=1", true, 301);
}




// If the person wants to add to their cart (or edit) the below statement will control that

if ($cart_add == 1 and $user_id > 0 ) {
    $user_id = $sessData['userID'];

    if ($sessData == empty($sessData['userID'])) {
        $user_id = 0;
    }

    if ($user_id > 0) {

        $prod_key = $_GET['prod_key'];
        $amount   = $_GET['amount'];

        //see if the user already has a cart
        $sql    = "SELECT * FROM cart WHERE user_id=$user_id";
        echo "<br>";
        echo $sql;
        $result = $conn->query($sql);


        $row    = $result->fetch_assoc();

        // if they have a cart edit it
        if ($result->num_rows > 0) {
            // output data of each row
            $prod_ids = explode(", ", $row['prod_ids']);
            $amounts  = explode(", ", $row['amount']);
            $cart    = $row['cart_id'];


            $inarray = in_array($prod_key, $prod_ids);
            // if tis already in cart, add together

            if ($inarray == TRUE) {
                $key = array_search($prod_key, $prod_ids);

                if ($prod_key == $prod_ids[$key]) {


                    $item_amount = $amounts[$key];
                    //adds the two amounts together
                    $item_amount = $item_amount + $amount;
                    //makes  a new array with the new amount
                    $amount_n    = array($key => $item_amount);
                    //adds it in
                    $amounts     = array_replace($amounts, $amount_n);

                }

            } else {
              echo "prod_ids before ";
              var_dump($prod_ids);
              echo "<br>amounts before ";
              var_dump($amounts);
                array_push($prod_ids, "$prod_key");
                array_push($amounts, "$amount");

            }
            if (count($prod_ids) > 0) {
                $prod_ids = implode(", ", $prod_ids);
                $amounts  = implode(", ", $amounts);
            }
            // sql
            $sql = "UPDATE cart SET prod_ids = '$prod_ids', amount = '$amounts' WHERE user_id = $user_id";


                if ($conn->query($sql) === TRUE) {
                    echo "edited old cart";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

            // if the user if the user doesnt have one make another
        }
         else {
            $sql = "INSERT INTO `cart` (`user_id`, `prod_ids`, `amount`) VALUES ('$user_id','$prod_key', '$amount')";
                // send to data base if debug is disabled.
                if ($conn->query($sql) == TRUE) {
                    echo "<br> <br> New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();

            // PHP permanent URL redirection
            header("Location: cart.php", true, 301); echo "you just got pre";

}

// If the person wants to delete their cart, then they can use the below statement

if ($cart_del == 1) {
    $user_id = $sessData['userID'];

    if ($sessData = empty($sessData['userID'])) {
        $user_id = 0;
        if ($debug == 1) {
            echo "user ID: ";
            echo $user_id;
        }
    }
    if ($user_id > 0) {
     $sql = "DELETE FROM cart WHERE user_id=$user_id";

     if ($conn->query($sql) === TRUE) {
         echo "<br> <br> emptied cart";
         // PHP permanent URL redirection
         header("Location: cart.php", true, 301);
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }

    }
}

if ($com == 1) {

  $email = $_POST['email'];
  $request = $_POST['request'];

  $sql = "INSERT INTO `coms` (`email`, `request`, `completed`) VALUES ('$email','$request', '0')";

      if ($conn->query($sql) == TRUE) {
          echo "<br> <br> New record created successfully";
          // PHP permanent URL redirection
          header("Location: about.php?succ=1", true, 301);
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;

  }




}

?>

</html>
