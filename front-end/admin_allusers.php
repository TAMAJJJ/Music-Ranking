<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Users Info</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/admin_allusers.css">

        <!--  Font -->
        <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
    </head>
    <body>

        <nav class="navbar navbar-dark" style="background-color: #f0a500;">
    <a class="navbar-brand" href="#">
        <img src="" width="30" height="30" class="d-inline-block align-top" alt="">
        Music Ranking
    </a>
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link active" href="admin_main.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin_musics.php">Musics</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin_allusers.php">User Info</a>
        </li>
    </ul>
</nav>

<div class="container">
    <?php
        require "connect.php";
        $sql = "USE dzhang29_1;";
        if ($conn->query($sql) === TRUE) {
           //echo "using Database dzhang29_1";
        } else {
           echo "Error using  database: " . $conn->error;
        }
        $sql = "SELECT * FROM USER;";
       $result = $conn->query($sql);

       echo"<table border = '1' class='table'>";
       echo"<thead class='thead-dark'><tr><th>UserID</th><th>Name</th><th>Phone</th><th>Email</th><th>Subscriber</th></tr></thead>\n";
       echo"<tbody>";
       $rank = 0;
       while($row = mysqli_fetch_assoc($result)){
           $rank = $rank + 1;
           echo"<tr><th scope='row'>{$row['UserID']}</th><td>{$row['Name']}</td><td>{$row['Phone']}</td><td>{$row['Email']}</td><td>{$row['Subscriber']}</td></tr>\n";
       }
       echo"</tbody>";
       echo"</table>";
    ?>

    <form class="search" action="admin_allusers.php" method="post">
        <label for="name">User Name: </label>
        <input type="text" name="name">

        <button type="submit" name="button">Search</button>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<div class = 'result'>";
            require "connect.php";
            $sql = "USE dzhang29_1;";
            if ($conn->query($sql) === TRUE) {
               //echo "using Database dzhang29_1";
            } else {
               echo "Error using  database: " . $conn->error;
            }

            $name = $_POST['name'];

            if($name != null){
                $sql = "SELECT * FROM USER WHERE Name = '$name';";
               $result = $conn->query($sql);
            }else{
               echo '<script>alert("Input is Empty")</script>';
               header("Refresh:0;");
            }

           echo"<table border = '1' class='table'>";
               echo"<thead class='thead-dark'><tr><th>UserID</th><th>Name</th><th>Phone</th><th>Email</th><th>Subscriber</th></tr></thead>\n";
               echo"<tbody>";
               $rank = 0;
               while($row = mysqli_fetch_assoc($result)){
                   $rank = $rank + 1;
                   echo"<tr><th scope='row'>{$row['UserID']}</th><td>{$row['Name']}</td><td>{$row['Phone']}</td><td>{$row['Email']}</td><td>{$row['Subscriber']}</td></tr>\n";
               }
               echo"</tbody>";
               echo"</table>";
        echo "</div>";
        }
    ?>
</div>
