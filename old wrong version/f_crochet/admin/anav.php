

        <?php
        if ($user_id == 1) {          
        $log = "Logout";
        $logref = "../userAccount.php?logoutSubmit=1";
        ?>
        <div class="topnav">
            <div class="col span_1_of_4">
           <a class="navlink" href="../index.php">Home</a>
           </div>
           <div class="col span_1_of_4">
          <a class="navlink" href="orders.php">Orders</a>
          </div>
           <div class="col span_1_of_4">
           <a class="navlink" href="Coms.php">Comissions</a>
           </div>
           <div class="col span_1_of_4">
             <a class="navlink" href="<?php echo $logref ?>"><?php echo $log ?></a>
         </div>

          </div>
        <br>
        <br>

          <?php
      } else {
        ?> <a href="../index.php"> Back to home </a>
        <?php
      }
         ?>
