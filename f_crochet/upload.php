<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!--page_container opening-->

  <head>
      <link rel="stylesheet" type="text/css" href="css/style1.css">
      <meta charset="utf-8">
      <title>Fiona's Crochet | Home</title>
  </head>


<?php
include 'setup.php';


$db = mysqli_connect("localhost", "sec_user", "greenChair153", "f_crochet");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
    $prod_desc = $_POST['prod_desc'];
    $prod_cost = $_POST['prod_cost'];
    $name = $_POST['name'];


  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$prod_name = mysqli_real_escape_string($db, $_POST['name']);

  	// image file directory
  	$target = "imgs/".basename($image);

  	$sql = "INSERT INTO `products` (`image`, `name`, `prod_desc`, `cost`) VALUES ('$image', '$prod_name', '$prod_desc', '$prod_cost' )";
  	// execute query
        if ($conn->query($sql) === TRUE) {
          $querysucc = 1;
        } else {
          $querysucc = 0;
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  } else {
    $querysucc = 0;
  }



?>
<body>

  <div id="page_container">

  <?php
  include 'nav.php';
   if ($user_id == 1) {

     if ($querysucc == 1) {
       echo "Image uploaded";
     }

     ?>

<h1>Upload a new product</h1>

<form class="upload" action="upload.php" method="POST" enctype="multipart/form-data">
  <table>
    <input type="hidden" name="size" value="1000000000">
    <tr>
      <td>Product Name: </td>
      <td> <input type="text" name="name" placeholder="Product name..." required></td>
    </tr>
    <tr>
      <td>Product Description: </td>
      <td><input type="text" name="prod_desc" placeholder="Description..." required></td>
    </tr>
    <tr>
      <td>Product Cost: </td>
      <td><input type="number" name="prod_cost" placeholder="Cost..." required ></td>
    </tr>
    <tr>
      <td> Product Image:</td>
      <td> <input type="file" name="image" required> </td>
    </tr>
    <input type="hidden" name="upload" value="1">
    <tr>
      <td><input type="submit" name="submit" value="Upload"></td>
    </tr>



  </table>
</form>

<?php
} else {
  echo "You're not supposed to be here. Try log in.";
}
?>


</div>
<?php include 'footer.html' ?>
</div>
<!--page_container closing-->
</body>

</html>
