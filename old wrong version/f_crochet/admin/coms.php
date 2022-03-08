<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!--page_container opening-->

  <head>
      <link rel="stylesheet" type="text/css" href="../css/style.css">
      <meta charset="utf-8">
      <title>Fiona's Crochet | Home</title>
  </head>

  <?php
  include '../setup.php';

 $sql="SELECT * FROM `coms`";
 $result = $conn->query($sql);

include 'anav.php';
?>
          <div id="container">
            <!--main content div starts below-->
            <div class="span_3_of_3">
              <h1>All Commissons</h1>

                <?php
                      if ($result->num_rows > 0) {
                        ?>
                        <table class="results">
                          <tr class="results">
                            <th class="results"> Com ID</th>
                            <th class="results"> Email</th>
                            <th class="results"> More info  </th>
                            <th class="results"> completed</th>
                          </tr>
                          <?php
                            while($row = $result->fetch_assoc()) {
                                $com_id = $row["com_ID"];
                                $email = $row["email"];
                                $completed = $row['completed'];
                                ?>
                                <tr class="results">
                                  <td class="results"> <?php echo $com_id; ?></td>
                                  <td class="results"> <?php echo $email; ?></td>
                                  <td class="results"> <a style="text-decoration: underline;" href="com.php?com=<?php echo $com_id; ?>">More details </a></td>
                                  <td class="results"> <?php if ($completed == 1 ) {
                                    echo "yes";
                                  } elseif ($completed == 0) {
                                    echo "no";
                                  } ?></td>
                                </tr>
                                <?php
                                }
                              }

                          else {
                           echo "0 results";
              }
              ?>
            </div>
              </div>
              <?php

include '../footer.html';
?>
