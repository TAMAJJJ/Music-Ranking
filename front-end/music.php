<?php
    require "connect.php";
    $sql = "USE dzhang29_1;";
    if ($conn->query($sql) === TRUE) {
       echo "using Database dzhang29_1";
    } else {
       echo "Error using  database: " . $conn->error;
    }
    $sql = "SELECT MUSIC.MusicTitle,MUSIC.Artist,REVIEW.Points,REVIEW.Review FROM MUSIC LEFT JOIN REVIEW ON MUSIC.MusicID = REVIEW.MusicID WHERE Artist = 'Myra Estrada';";
   // $result = $conn->query($sql);

   if ($conn->query($sql) === TRUE) {
      echo "using Database dzhang29_1";
   } else {
      echo "Error using  database: " . $conn->error;
   }

    echo"<table border = '1'>";
    echo"<tr><td>Music Title</td><td>Artist</td><td>Points</td><td>Review</td></tr>\n";
    while($row = mysqli_fetch_assoc($result)){
        echo"<tr><td>{$row['MusicTitle']}</td><td>{$row['Artist']}</td><td>{$row['Points']}</td><td>{$row['Review']}</td></tr>\n";
    }
    echo"</table>";

    $sql = "SELECT * FROM MUSIC;";
    $result = $conn->query($sql);

    echo"<table border = '1'>";
    echo"<tr><td>MusicID</td><td>MusicTitle</td><td>Date</td><td>Publisher</td><td>Artist</td></tr>\n";
    while($row = mysqli_fetch_assoc($result)){
        echo"<tr><td>{$row['MusicID']}</td><td>{$row['MusicTitle']}</td><td>{$row['Date']}</td><td>{$row['Publisher']}</td><td>{$row['Artist']}</td></tr>\n";
    }
    echo"</table>";

    $sql = "SELECT * FROM REVIEW;";
    $result = $conn->query($sql);

   echo"<table border = '1'>";
   echo"<tr><td>ReviewID</td><td>MusicID</td><td>Review</td><td>Points</td><td>UserID</td></tr>\n";
     while($row = mysqli_fetch_assoc($result)){
         echo"<tr><td>{$row['ReviewID']}</td><td>{$row['MusicID']}</td><td>{$row['Review']}</td><td>{$row['Points']}</td><td>{$row['UserID']}</td></tr>\n";
     }
   echo"</table>";

?>
