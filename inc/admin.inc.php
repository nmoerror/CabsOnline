	<!-- 
        Author: Alejandro González
        Auckland University of Technology
    -->
	<?php
    $action = $_POST['action'];
    $u = 'Unassigned';
    #Check request
    if ($action === "Search") {
        sleep(1);
        require 'dbh.inc.php';
        if (!$conn) {
            die("Connectiong Failed." . mysqli_connect_error());
        } else {
            $reference = $_POST['reference'];
            $sql = "SELECT Reference, Cust_Name, Phone, Origin, Destination, Travel_Date, Travel_Time, Passengers, Vehicle, Job_Status FROM taxijobs WHERE Reference LIKE '$reference' AND Job_Status LIKE '$u'";
            $queryResult = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($queryResult);

            if ($row[0] == null) {
                echo "<p> No Unassigned Requests Found. </p>";
                exit();
            }

            if ($row[2] == 0) {
                $row[2] = "Unavailable";
            }
            echo '<div id="kill" class="container-fluid">
            <div class=" mar">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Booking #</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Contact Phone</th>
                    <th scope="col">Pick up</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>';
            echo '<tbody>
                <tr id="loadedTable" class="unnasigned" >
                    <th scope="row">' . $row[0] . '</th>
                    <td>' . $row[1] . '</td>
                    <td>' . $row[2] . '</td>
                    <td>' . $row[3] . '</td>
                    <td>' . $row[4] . '</td>
                    <td>' . $row[5] . '</td>
                    <td>' . $row[6] . '</td>
                </tr>
                </tbody>';
            echo '</table>
            <button
            type="button"
            name="search-submit"
            class="btn btn-outline-success mb-2 shadow-sm px-md-5"
            onClick="attemptToAssign()"
            >
                <img
                class="mright"
                id="attempt"
                src="./img/taxi-driver.svg"
                width="22"
                height="22"
                />
            </button>
            <label class="form-check-label text-muted">
        Assign a Driver
      </label>
        </div>
        </div>';
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        exit();
    }
    if ($action === "Update") {
        require 'dbh.inc.php';
        $time = time();
        $atnow = date('H:i:s', $time);
        $time2 = strtotime("-2 hours", $time);
        $atbefore = date('H:i:s', $time2);
        $hoy = date('Y-m-d');


        if (!$conn) {
            die("Connectiong Failed." . mysqli_connect_error());
        } else {
            $sqli = "SELECT Reference, Cust_Name, Phone, Origin, Destination, Travel_Date, Travel_Time FROM taxijobs where Job_Status LIKE '$u' AND Travel_Date = '$hoy' and cast(Travel_Time as time) between '$atbefore' and '$atnow'";
            $Result = mysqli_query($conn, $sqli);
            $row = mysqli_fetch_row($Result);
            if ($row[0] == null) {
                echo "<p> No Requests Found - " . $atnow . " " . $atbefore . " </p>";
                exit();
            }
            if ($row[2] == 0) {
                $row[2] = "Unavailable";
            }
            echo '

        <thead>
            <tr>
                <th scope="col">Booking #</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Contact Phone</th>
                <th scope="col">Pick up</th>
                <th scope="col">Destination</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody>';

            while ($row) {
                echo '
            <tr class="unnasigned" >
                <th scope="row">' . $row[0] . '</th>
                <td>' . $row[1] . '</td>
                <td>' . $row[2] . '</td>
                <td>' . $row[3] . '</td>
                <td>' . $row[4] . '</td>
                <td>' . $row[5] . '</td>
                <td>' . $row[6] . '</td>
            </tr>
            ';
                $row = mysqli_fetch_row($Result);
            }
            echo '</tbody>
';
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        exit();
    }

    if ($action === "assign") {
        require 'dbh.inc.php';
        $new = $_POST['value'];

        if (!$conn) {
            die("Connectiong Failed." . mysqli_connect_error());
        } else {
            $sqli = "UPDATE taxijobs SET Job_Status = 'Assigned' WHERE Reference = '$new'";
            $Result = mysqli_query($conn, $sqli);
            $row = mysqli_fetch_row($Result);
            if ($row[0] == null) {
                echo "<p> Not Found ma bro </p>" . $new;
                exit();
            }
            echo $new;
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
