<?php 
    $db_name="demo_db";

    $db_host="localhost";

    $db_password="";

    $db_user="root";



    $con = mysqli_connect($db_host,$db_user,$db_password,$db_name);

    if(mysqli_error($con))

    {

        echo "There was an error connecting to the database.";

    }

?>