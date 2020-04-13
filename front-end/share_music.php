
<?php
    require "connect.php";
    $sql = "USE dzhang29_1;";
    if ($conn->query($sql) === TRUE) {
        echo "using Database dzhang29_1";
    } else {
        echo "Error using  database: " . $conn->error;
    }

    $userid = $_POST['userid'];
    $time = $_POST['time'];
    $trackid = $_POST['trackid'];
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $albumid = $_POST['albumid'];
    $albumtitle = $_POST['albumtitle'];
    $producer = $_POST['producer'];
    $publisheddate = $_POST['publisheddate'];

    $sql = "INSERT INTO MUSIC VALUES ($trackid,'$title','$artist',$albumid);";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO ALBUM VALUES ($albumid,'$albumtitle',$publisheddate,'$producer');";
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
          echo"<tr><td>AlbumID</td><td>Title</td><td>PublishedDate</td><td>Producer</td></tr>\n";
          while($row = mysqli_fetch_assoc($result)){
              echo"<tr><td>{$row['AlbumID']}</td><td>{$row['Title']}</td><td>{$row['PublishedDate']}</td><td>{$row['Producer']}</td></tr>\n";
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
?>
