<?php
    require('../php-includes/connect.php');
    if(isset($_POST['startdate']) && isset($_POST['enddate']) && isset($_POST['reason']))
    {
        session_start();
        $startdate = mysqli_real_escape_string($con, $_POST['startdate']);
        $enddate = mysqli_real_escape_string($con, $_POST['enddate']);
        $reason = mysqli_real_escape_string($con, $_POST['reason']);

        $userid = $_SESSION['userid'];

        $query = mysqli_query($con, "INSERT INTO leaves (userid, reason, startdate, enddate) VALUES ('$userid', '$reason','$startdate','$enddate') ");
        if($query){
            echo "
                <script>
                    window.alert('Leave request have been submited successfully');
                    window.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    window.alert('Oops Something went wrong.');
                    window.location.href = 'index.php';
                </script>
            ";
        }

    }else{
        header("Location: index.php");
    }

?>