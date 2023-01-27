<?php
$servername = 'localhost'; // Change accordingly
$username = 'root'; // Change accordingly
$password = ''; // Change accordingly
$db = 'xampp_starter'; // Change accordingly

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// define all fields
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$hashed_pass = password_hash($pwd, PASSWORD_DEFAULT);

if ( // check whether the fields are null or not
    empty($email)
) { // if yes, display error message
    echo '<p class="text-danger"> Please fill out the email! </p>';
    $conn->close();
    die();
}

if (! empty($fname)){
    $sql1 = $conn->prepare('UPDATE User SET firstName = ? WHERE email = ?');
    $sql1->bind_param('ss', $fname, $email);
    $sql1->execute();
}

if (! empty($lname)){
    $sql2 = $conn->prepare('UPDATE User SET lastName = ? WHERE email = ?');
    $sql2->bind_param('ss', $lname, $email);
    $sql2->execute();
}

if (! empty($uname)){
    $sql3 = $conn->prepare('UPDATE User SET username = ? WHERE email = ?');
    $sql3->bind_param('ss', $uname, $email);
    $sql3->execute();
}

if (! empty($pwd)){
    $sql4 = $conn->prepare('UPDATE User SET password = ? WHERE email = ?');
    $sql4->bind_param('ss', $hashed_pass, $email);
    $sql4->execute();
}
  

$conn->close();

// success error messages
if ($email) {
     echo '<p class="text-success" >User updated successfully!</p>';
 } else {
    echo '<p class="text-danger" >User could not be updated!</p>';
 }

?>
