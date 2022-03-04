<?php
include 'setup.php';

if(!empty($sessData)){
    $user_id = $sessData['userID'];
} else {
  $user_id = 0;
}

if ($user_id > 0 ) {
  $sql = "SELECT * FROM users WHERE id='$user_id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    $email = $row["email"];
  }
  $placeholder = "value='$email'";
} else {
  $placeholder = "placeholder='Email'";
}

if (empty($_GET['succ'])) {
  $succ = 0;
} else {
  $succ = $_GET['succ'];
}
 ?>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="utf-8">
        <title>Fiona's Crochet | Home</title>
    </head>

    <body>
        <?php
   include 'nav.php';

   ?>
            <div id="page_container">
                <?php
     if ($succ == 1) {
      ?>
                    Request sent! We will be in touch shortly
                    <?php
     } ?>
                      <div class="aboutcontent">
                        <br><br>
                        <div class="span_holder">
                            <div class="span_2_of_3">
                                <div class="img">
                                    <img src="imgs/fry.jpg" width="350" alt="photo of Fiona">
                                </div>

                                <h1>About</h1>

                                <p>Fiona likes to crochet in her spare time. Although it can be hard to find some spare time. She is a loving mother of two and is passionate about her family. She decided after having all her creations accumulate, that she should sell them. After months of development she finally got her website up and running inorder to sell them. </p>
                                <p>You can request a commisson <a href="mailto:mr11@mahurangi.school.nz" style="text-decoration: underline;">
      By emailing</a> Or by using the below form
                                </p>
                            </div>
                            <br>
                            <div class="span_1_of_3">
                                <form class="" action="action.php" method="post">
                                    <tr>
                                        <td>
                                            Your request:
                                            <br>
                                            <br>
                                        </td>
                                        <td>
                                            <input type="text" name="request" value="" required>
                                            <br>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        Your email:
                                        <br>
                                        <br>
                                        <input type="email" name="email" <?php echo $placeholder; ?>required>
                                        <br>
                                        <br>
                                        <input type="hidden" name="com" value="1">
                                    </tr>
                                    <tr>
                                        <input type="submit" name="comsubmit" value="Submit">
                                    </tr>
                                </form>
                            </div>
                        </div>
                  </div>
            </div>
            </div>
    </body>

    </html>
