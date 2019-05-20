<!-- 
        Author: Alejandro González
        Auckland University of Technology
    -->
<?php

$servername = "cmslamp14.aut.ac.nz";
$DBusername = "wqt4858";
$DBpassword = "feb123456";
$DBname = "wqt4858";

$conn = mysqli_connect($servername, $DBusername, $DBpassword, $DBname);
if (!$conn) {
    die("Connectiong Failed." . mysqli_connect_error());
}
