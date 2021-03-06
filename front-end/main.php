<html>

<head>
    <meta charset="utf-8">
    <title>Music Ranking</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/search.css">
    <!--  Font -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
</head>

<body>
     <?php include "inc/nav.php"; ?>

    <div class="container" style="margin-top:3%;">
        <?php
            require "connect.php";
            $sql = "USE dzhang29_1;";
            if ($conn->query($sql) === TRUE) {
               //echo "using Database dzhang29_1";
            } else {
               echo "Error using  database: 1" . $conn->error;
            }
            session_start();

            $sql = "SELECT Points,MusicTitle,NumReviews FROM RANKING JOIN MUSIC ON RANKING.MusicID = MUSIC.MusicID ORDER BY Points DESC;";
            $result = $conn->query($sql);
            
            echo"<table class='table'>";
            echo"<thead class='thead-dark'><tr><th>Rank</th><th>Points</th><th>Music Title</th><th>No. Reviews</th></tr></thead>\n";
            echo"<tbody>";
            $rank = 0;
            while($row = mysqli_fetch_assoc($result)){
                $rank = $rank + 1;
                echo"<tr><th scope='row'>$rank</th><td>{$row['Points']}</td><td>{$row['MusicTitle']}</td><td>{$row['NumReviews']}</td></tr>\n";
            }
            echo"</tbody>";
            echo"</table>";
        ?>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
