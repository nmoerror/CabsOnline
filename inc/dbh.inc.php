<!-- 
        Author: Alejandro González
        Auckland University of Technology
    -->
<?php

$servername = "";
$DBusername = "";
$DBpassword = "";
$DBname = "";

$conn = mysqli_connect($servername, $DBusername, $DBpassword, $DBname);
if (!$conn) {
    die("Connectiong Failed." . mysqli_connect_error());
}
