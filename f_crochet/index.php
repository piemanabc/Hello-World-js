<!DOCTYPE html>
<?php
include 'setup.php';
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<html lang="en" dir="ltr">

  <head>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto:100,400&display=swap" rel="stylesheet">
      <meta charset="utf-8">
      <title>Fiona's Crochet | Home</title>
  </head>
  <body>
    <?php include 'nav.php'?>
    <div class="indexbackground">
      <div class="titleitems">
        <br>
        <br>
        <br>

        <br>
        <br>
        <br>
          <div class="fronttitle">
            FIONA'S CROCHET
          </div>

          <h3>Amazing Quality!</h3>
          <br>
          <br>
          <div class="shopnow">

            <a href="chart.php">
              <div class="gogostore">
                Have a look Instore
            </div>
              <div class="gogoarrow">
                <img src="imgs/arrow.png" alt="go to store">
              </div>
            </a>

          </div>
        </div>
      </div>
    <div class="gimmiemoney">
      Come visit the store and buy some clothes
    </div>
  </body>
</html>
