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

$user = $_POST['email'];
$role = $_POST['role'];

$sql = $conn->prepare('SELECT DISTINCT idx FROM UserType WHERE userType = ?');
$sql->bind_param('s', $role);
$sql->execute();
$result = $sql->get_result();
$user1 = $result->fetch_assoc();

$sql1 = $conn->prepare(
    'INSERT INTO USER_ACCESS (email, userTypeId) VALUES (?, ?)'
);
$sql1->bind_param('ss', $user, $user1['idx']);
$sql1->execute();

?>
