<?php
    require "connect.php";
    $sql = "USE dzhang29_1;";
    if ($conn->query($sql) === TRUE) {
       //echo "using Database dzhang29_1";
    } else {
       echo "Error using  database: " . $conn->error;
    }

    $userID = $_REQUEST['userID'];

    //check if they made Comments
    $select_comments_query = "SELECT * FROM REVIEW WHERE UserID = $userID";
    $comments_selected = $conn -> query($select_comments_query);
    $comment_num = mysqli_num_rows($comments_selected);

    if ($comment_num != 0) {
        //for each comment
        while($row = mysqli_fetch_assoc($comments_selected)){
            $reviewID = $row['ReviewID'];
            //check if the music only has 1 comment
            $select_review_num = "SELECT * FROM REVIEW JOIN RANKING ON REVIEW.MusicID = RANKING.MusicID WHERE `ReviewID` = $reviewID";
            $review_num = $conn->query($select_review_num);

            $row = mysqli_fetch_assoc($review_num);
            $review_number = $row['NumReviews'];
            $musicID = $row['MusicID'];

            $select_points = "SELECT * FROM REVIEW WHERE ReviewID= $reviewID";
            $get_points = $conn->query($select_points);
            $row = mysqli_fetch_assoc($get_points);
            $points = $row['Points'];

            $delete_review_query="DELETE FROM REVIEW WHERE MusicID = $musicID";
            $review_deleted=$conn->query($delete_review_query);

             if($review_number == 1){
                 $delete_ranking_query="DELETE FROM RANKING WHERE MusicID = $musicID";
                 $ranking_deleted=$conn->query($delete_ranking_query);

                 $delete_music_query="DELETE FROM MUSIC WHERE MusicID = $musicID";
                 $music_deleted=$conn->query($delete_music_query);

                 if ($music_deleted == TRUE) {
                    //echo "using Database dzhang29_1";
                 } else {
                    echo "Error using  database: " . $conn->error;
                 }

             }else{
                 $select_ranking = "SELECT * FROM RANKING WHERE MusicID = $musicID";
                 $row = mysqli_fetch_assoc($conn->query($select_ranking));

                 $total_pts = $row["Points"] * $review_number - $points;

                 $avg_points = $total_pts/($review_number - 1);

                 //echo $avg_points;


                $new_RankingID = $row["RankingID"];
                $new_NumReviews = $row["NumReviews"] - 1;
                //update Ranking table
                $update_ranking = "UPDATE RANKING SET Points = $avg_points, NumReviews = $new_NumReviews WHERE RankingID = $new_RankingID;";
                $result = $conn->query($update_ranking);
             }

        }

                $delete_user_query = "DELETE FROM USER WHERE UserID = $userID";
                $user_deleted = $conn->query($delete_user_query);

                if ($user_deleted === TRUE) {
                   //echo "using Database dzhang29_1";
                } else {
                   echo "Error using  database: " . $conn->error;
                }
    
    }

    $delete_user_query = "DELETE FROM USER WHERE UserID = $userID";
    $user_deleted = $conn->query($delete_user_query);

         echo '<script>alert("Successfully Deleted!")</script>';
         //header("Refresh:0; url=../front-end/admin_allusers.php");
?>
