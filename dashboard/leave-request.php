// Kagiso Machacha


<?php
    require('../php-includes/connect.php');
    if(isset($_POST['startdate']) && isset($_POST['enddate']) && isset($_POST['reason']))
    {
        session_start();
        $startdate = mysqli_real_escape_string($con, $_POST['startdate']);
        $enddate = mysqli_real_escape_string($con, $_POST['enddate']);
        $reason = mysqli_real_escape_string($con, $_POST['reason']);

        $userid = $_SESSION['userid'];

        $leave_start_date_is_before = leave_start_date_is_before($startdate, $enddate);
        $leave_start_end_is_after_today = leave_start_end_is_after_today($startdate, $enddate);
        $leave_dates_do_not_overlap = leave_dates_do_not_overlap($startdate, $enddate,  $userid);

        if($leave_start_date_is_before && $leave_start_end_is_after_today && $leave_dates_do_not_overlap)
        {
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
            if(!$leave_start_date_is_before)
            {
                echo "
                    <script>
                        window.alert('The start date cannot be after the end date.');
                        window.location.href = 'index.php';
                    </script>
                ";
            }else if(!$leave_start_end_is_after_today)
            {
                echo "
                    <script>
                        window.alert('The start date and the end date must be after today\'s date. ');
                        window.location.href = 'index.php';
                    </script>
                ";
            }
            else if(!$leave_dates_do_not_overlap)
            {
                echo "
                    <script>
                        window.alert('Leave date shouled not overlap with existing approved leaves.');
                        window.location.href = 'index.php';
                    </script>
                ";
            }else{
                header("Location: index.php");
            }
        }
    }else{
        header("Location: index.php");
    }


    function leave_start_date_is_before($startdate, $enddate)
    {
        if(strtotime($startdate) < strtotime($enddate)){
            return true;
        }

        return false;
    }

    function leave_start_end_is_after_today($startdate, $enddate)
    {
        $today = date("Y/m/d");

        if(strtotime($startdate) > strtotime($today) && strtotime($enddate) > strtotime($today))
        {
            return true;
        }
        return false;
    }

    function leave_dates_do_not_overlap($startdate, $enddate,  $userid){
        require('../php-includes/connect.php');

        $query = mysqli_query($con,"select * from leaves where userid = '$userid' ");

        while($u = mysqli_fetch_assoc($query))
        {
            $sDate = $u['startdate'];
            $eDate = $u['enddate'];
            $status = $u['status'];

            if($status == 'approved')
            {
                if(strtotime($startdate) <= strtotime($eDate) && strtotime($startdate) >= strtotime($sDate))
                {
                    return false;
                }

                if(strtotime($enddate) <= strtotime($eDate) && strtotime($enddate) >= strtotime($sDate))
                {
                    return false;
                }
            }
        }

        return true;
    }

?>
