      <?php
      if ($user_id > 0) {
        $colspan = 5;
      $log = "Logout";
      $logref = "userAccount.php?logoutSubmit=1";

    } else {
      $colspan = 4;
      $log = "Login";
      $logref = "loginnew.php";
    }

    if ($user_id == 1) {
      $colspan = 6;
    }


       ?>
      <div class="topnav">
          <div class="col span_1_of_<?php echo $colspan ?>">
         <a class="navlink" href="index.php">Home</a>
         </div>
         <div class="col span_1_of_<?php echo $colspan ?>">
         <a class="navlink"href="shop.php">Shop</a>
         </div>
         <div class="col span_1_of_<?php echo $colspan ?>">
         <a class="navlink" href="about.php">About</a>
         </div>
         <div class="col span_1_of_<?php echo $colspan ?>">
           <a class="navlink" href="<?php echo $logref ?>"><?php echo $log ?></a>
       </div>
                <?php
            if ($user_id == 1) {  ?>
              <div class="col span_1_of_<?php echo $colspan ?>">
              <?php echo "<a class='navlink' href='admin/aindex.php'>Admin</a>"; ?>
            </div>
          <?php
            }
            if ($user_id > 0) {
           ?>
            <div class="col span_1_of_<?php echo $colspan ?>">
            <a href='cart.php'>
              <img src='imgs/cart.png' alt='cart icon' width='25'>
            </a>
            </div>
          <?php } ?>

        </div>
      <br>
      <br>
