<?php
$servername = 'localhost'; // Change accordingly
$username = 'root'; // Change accordingly
$password = ''; // Change accordingly
$db = 'xampp_starter'; // Change accordingly

$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// $conn = new SQLite3('../database/ta_management.db', SQLITE3_OPEN_READWRITE);

$sql = $conn->prepare('SELECT DISTINCT term, years FROM TA ORDER BY years');
$sql->execute();
$result = $sql->get_result();
echo '<option value="" selected disabled>Term & Year...</option>';

while ($ta = $result->fetch_assoc()) {
    echo '<option value="' .
        $ta['term'] .
        ' ' .
        $ta['years'] .
        '">' .
        $ta['term'] .
        ' ' .
        $ta['years'] .
        '</option>';
}
$sql->close();

?>
