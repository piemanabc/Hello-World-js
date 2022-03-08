<?php

$sql = "SELECT page_id, title, para1, image FROM pages where page_id='$page_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        # print_r($row);
        $page_id = $row["page_id"];
        $title =  $row["title"];
        $para1 = $row["para1"];
        $images = $row["image"];

      }
    }
  else {
   echo "0 results";
    }
$conn->close();

?>
