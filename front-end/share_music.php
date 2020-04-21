
<?php
    require "connect.php";
    $sql = "USE dzhang29_1;";
    if ($conn->query($sql) === TRUE) {
        echo "using Database dzhang29_1";
    } else {
        echo "Error using  database: " . $conn->error;
    }

    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $music_title = $_POST['music_title'];
    $artist = $_POST['artist'];
    $published_date = $_POST['published_date'];
    $points = $_POST['points'];
    $comments = $_POST['comments'];
    

    $sql = "INSERT INTO MUSIC VALUES ($music_id,'$music_title','$published_date',$publisher, $artist);";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO ALBUM VALUES ($albumid,'$albumtitle',$published_date,'$producer');";
       $result = $conn->query($sql);

       if ($result === TRUE) {
           echo "New record created successfully";
       } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
       }
    
    $sql = "INSERT INTO SHARES VALUES ($userid,$trackid,$albumid,$time);";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $sql = "SELECT * FROM MUSIC;";
       $result = $conn->query($sql);
        echo"<h2>MUSIC</h2>";
        echo"<table border = '1'>";
        echo"<tr><td>TrackID</td><td>Title</td><td>Artist</td><td>AblumID</td></tr>\n";
        while($row = mysqli_fetch_assoc($result)){
            echo"<tr><td>{$row['TrackID']}</td><td>{$row['Title']}</td><td>{$row['Artist']}</td><td>{$row['AlbumID']}</td></tr>\n";
        }
        echo"</table>";
       
       $sql = "SELECT * FROM ALBUM;";
         $result = $conn->query($sql);
          echo"<h2>ALBUM</h2>";
          echo"<table border = '1'>";
          echo"<tr><td>AlbumID</td><td>Title</td><td>published_date</td><td>Producer</td></tr>\n";
          while($row = mysqli_fetch_assoc($result)){
              echo"<tr><td>{$row['AlbumID']}</td><td>{$row['Title']}</td><td>{$row['published_date']}</td><td>{$row['Producer']}</td></tr>\n";
          }
          echo"</table>";
       
       $sql = "SELECT * FROM SHARES;";
            $result = $conn->query($sql);
       echo"<h2>SHARES</h2>";
       echo"<table border = '1'>";
          echo"<tr><td>UserID</td><td>TrackID</td><td>AblumID</td><td>Time</td></tr>\n";
          while($row = mysqli_fetch_assoc($result)){
              echo"<tr><td>{$row['UserID']}</td><td>{$row['TrackID']}</td><td>{$row['AlbumID']}</td><td>{$row['Time']}</td></tr>\n";
          }
          echo"</table>";

    $conn->close();

    //update ranking, calculate avg points for each music, and change points ranking table
    
    //count how many reviews are there
    $sql = "SELECT MusicTitle,Artist FROM MUSIC;";
    $result = $conn->query($sql); 
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['MusicTitle'];
        $select_reviews = "SELECT MUSIC.MusicTitle,MUSIC.Artist,REVIEW.Points,REVIEW.Review FROM MUSIC LEFT JOIN REVIEW ON MUSIC.MusicID = REVIEW.MusicID WHERE MusicTitle = '$title'";
        $review_result = $conn->query($select_reviews);
        $review_count = mysqli_num_rows($review_result);

        echo "<li class='list-group-item d-flex justify-content-between align-items-center'><strong>{$row['MusicTitle']}</strong> BY {$row['Artist']}<span class='badge badge-primary badge-pill'>$review_count</span></li>";
    }
?>
