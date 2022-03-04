<!DOCTYPE html>
<html lang="en" dir="ltr">


  <head>
      <link rel="stylesheet" type="text/css" href="../css/style.css">
      <meta charset="utf-8">
      <title>Fiona's Crochet | Home</title>
  </head>


<?php

if (empty($_GET['succ'])) {
  $succ = 0;
} else {
  $succ = $_GET['succ'];
}


include '../setup.php';
include 'anav.php';


?>
<body>
  <div id="page_container">
    <br><br>
    <?php

      if ($succ == 1) {
       ?>
       <div class="span_3_of_3">


       Status Updated!
       </div>
       <?php
     }
      ?>
      <div class="span_3_of_3">


<h2>Hello Admin!</h2>

<p>select a link above to track orders or commissons.</p>
</div>

    <?php include '../footer.html' ?>
    </div>
  <!--page_container closing-->
</body>

</html>
