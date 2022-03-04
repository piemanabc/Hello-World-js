<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
include 'setup.php';

 $prod_key = $_GET['prod_key'];

  $sql = "SELECT * FROM products WHERE prod_key='$prod_key' ";
  $result = $conn->query($sql);
?>

    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="utf-8">
        <title>Fiona's Crochet | Home</title>
    </head>

    <body>
        <!--page_container opening-->
        <div id="page_container">
            <?php include 'nav.php';

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  $prod_key = $row["prod_key"];
                  $name = $row["name"];
                  $cost = $row["cost"];
                  $image = $row["image"];
                  $prod_desc = $row["prod_desc"];
                  ?>
                <div class="span_holder">
                    <div class="span_3_of_3">

                        <div class="left">
                            <img src="imgs/<?php echo $image; ?>" width="100%" alt="<?php echo $prod_desc ?>">
                        </div>
                        <div class="itemcontent">
                          <br>

                            <h1><?php echo $name; ?></h1>

                            <h3>$<?php echo $cost; ?></h3>

                            <?php echo $prod_desc; ?>
                            <br>
                            <form class="add_to_cart" method="get" name="form" action="action.php">
                              <input type="hidden" name="prod_key" value="<?php echo $prod_key; ?>">
                              <input type="hidden" name="cartadd" value="1">
                              <input type="hidden" name="clearcart" value="0">
                              <input type="hidden" name="amount" value="1">
                              <input class="" name="" type="Submit" value="Add to Cart">
                              </form>


                            <br>
                            <br>

                        </div>
                    </div>
                </div>
                <?php
                  if(isset($_POST['submit']))
                  {
                       $SQL =
                       $result = mysql_query($SQL);
                  }
                  ?>

        </div>

        <?php
}
} ?>
            </div>
            <div class="section group">

            </div>
            </div>
            <!--wrapper closing-->

            <?php include 'footer.html' ?>
                </div>
                </div>
                <!--page_container closing-->

    </body>

</html>
