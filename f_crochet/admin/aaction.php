<?php

include 'asetup.php';


$statchng = $_GET['statchng'];
$ordvcom = $_GET['ovc'];

if ($statchng == 1) {
    $id = $_GET['comid'] or $id = $_GET['ordid'];
    $newstat = $_GET['newstat'];

    if ($ordvcom == 'c') {
    $sql = "UPDATE COMS SET completed = '$newstat' WHERE com_ID = $id";
    }
    if ($ordvcom == 'o') {
      $sql = "UPDATE orders SET completed = '$newstat' WHERE order_ID = $id";
    }

     if ($conn->query($sql) === TRUE) {
         echo "Updated";
         // PHP permanent URL redirection
         header("Location: aindex.php?succ=1", true, 301);
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }

    }

 ?>
