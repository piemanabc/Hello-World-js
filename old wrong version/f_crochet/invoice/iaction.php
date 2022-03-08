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

if (!empty($sessData)) {
  $user_id = $sessData['userID'];
} else {
  $user_id = 0;
}
if ($user_id > 0) {

$_SESSION["prod_ids"] = $_POST["items"];
$prod_ids = $_POST["items"];

$_SESSION['amounts'] = $_POST["amounts"];
$amounts = $_POST["amounts"];

$_SESSION['total'] = $_POST["total"];
$total = $_POST["total"];

$_SESSION['address'] = $_POST["address"];
$address = $_POST["address"];

$_SESSION['postal_c'] = $_POST["postal_code"];
$postal_c = $_POST["postal_code"];



 $sql = "DELETE FROM cart WHERE user_id=$user_id";

if ($conn->query($sql) === TRUE) {
echo "got this far";
}

$sql = "INSERT INTO `orders` (`items`, `amounts`, `total`, `address`, `postal_code`, `user_id`) VALUES ('$prod_ids', '$amounts', '$total', '$address', '$postal_c', '$user_id')";

if ($conn->query($sql) === TRUE) {
    echo "<br> <br> New record created successfully";
    header("Location: index.php", true, 301);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

} else {
  echo "There was a error.";
}

?>

</html>
