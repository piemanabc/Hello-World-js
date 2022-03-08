<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
include 'setup.php';
  $sql = "SELECT * FROM products";
  $result = $conn->query($sql);

?>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,400&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <title>Fiona's Crochet | Home</title>
</head>

<body>
    <!--page_container opening-->
    <div id="page_container">
          <?php include 'nav.php'?>
          <br>
          <!-- Portfolio Gallery Grid -->
          <br>
            <div class="wrapper">


            <div class="row">

              <?php
                if ($result->num_rows > 0) {
                    // output data of each row

                    while($row = $result->fetch_assoc()) {
                        $prod_key = $row["prod_key"];
                        $name =  $row["name"];
                        $cost = $row["cost"];
                        $image = $row["image"];
                        ?>
                        <div class="pocket">

                        <div class="wallet">

                        <div class="card">
                          <a href="item.php?prod_key=<?php print $prod_key?>" class="shop">
                          <img src="imgs/<?php echo $image; ?>" style="width:100%">
                            <h3><?php echo $name; ?></h3>
                            <p class="price"><b>$<?php echo $cost; ?></b></p>

                               View</a>
                               </div>
                        </div>
                      </div>
                        <?php
                      }

                    }
                  else {
                   echo "0 results";
      }
  $conn->close();

 ?>
    </div>


</div>
  <!--wrapper closing-->

      <?php include 'footer.html' ?>
    </div>
<!--page_container closing-->


  </body>

</html>
