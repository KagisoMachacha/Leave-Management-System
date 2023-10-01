<?php
    require('../php-includes/connect.php');
    if(isset($_POST['status']) && isset($_POST['comment']) && isset($_POST['leaveid'])){

        $status = mysqli_real_escape_string($con, $_POST['status']);
        $comment = mysqli_real_escape_string($con, $_POST['comment']);
        $id = mysqli_real_escape_string($con, $_POST['leaveid']);

        $query = mysqli_query($con,"UPDATE leaves SET status='$status', comment='$comment' WHERE id = '$id' ");

        if($query){
            echo '<script>
                alert("leave status have been updated!");
                window.location.assign("index.php");
            </script>';
        }else{
            echo '<script>
                alert("something went wrong while updating the status.");
                window.location.assign("index.php");
            </script>';
        }
    }
    echo '<script>
            window.location.assign("index.php");
            </script>';
?>