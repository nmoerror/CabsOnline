	<!-- 
        Author: Alejandro González
        Auckland University of Technology
    -->
	<?php
    sleep(2);
    $name = $_POST['name'];
    $phone =  $_POST['phone'];
    $origin = $_POST['origin'];
    $destination = $_POST['xdestination'];
    $travelday = substr($_POST['travelDate'], 0, 10);
    $travelDate = date('Y-m-d', strtotime($travelday));
    $travelTime = date("H:i", strtotime(substr($_POST['travelDate'], 11)));
    $passengers = $_POST['passengers'];
    $vehicle = $_POST['vehicle'];
    $status = 'Unassigned';


    require 'dbh.inc.php';

    if (!$conn) {
        die("Connectiong Failed." . mysqli_connect_error());
    } else {
        $test_sql = "SELECT * FROM taxijobs";
        $result = mysqli_query($conn, $test_sql);
        if (!$result) {
            echo "Error at Test";
            exit();
        } else {
            $reference = time() . rand(10 * 45, 100 * 98);

            $sqls = "INSERT INTO taxijobs" . "(Reference, Job_Status, Cust_Name, Phone, Origin, Destination, Travel_Date, Travel_Time, Passengers, Vehicle)" . VALUES . "('$reference','$status','$name','$phone','$origin','$destination','$travelDate','$travelTime','$passengers','$vehicle')";
            $result = mysqli_query($conn, $sqls);
            if (!$result) {
                echo "Error, some of the variables are irrealisticly long.";
                exit();
            } else {
                echo '<div class="container"> ' .
                    '<label> Your booking reference number is: ' . $reference . '</label> <br/>' .
                    '<label> You will be picked up at ' . $origin . '</label> <br/>' .
                    '<label> Your Destination: ' . $destination . '</label> <br/>' .
                    '<label> Your Travel Date: ' . $travelDate . ' at ' . $travelTime . 'hrs</label> <br/>' .
                    '<label> Passengers: ' . $passengers . '</label> <br/>' .
                    '<label> Preffered Vehicle: ' . $vehicle . '</label> <br/>' .
                    '</div> ' .
                    '<a class="btn btn-secondary btn-custom shadow-sm px-md-5" href="./booking.html" role="button">Post Again</a>';
                exit();
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
