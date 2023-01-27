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
$account_types = $_POST['accounttypes'];
$studentId = $_POST['studentId'];
$fac = $_POST['fac'];
$dep = $_POST['dep'];

if ( // check whether the fields are null or not
    empty($email) ||
    empty($account_types)
) { // if yes, display error message
    echo '<p class="text-danger"> Please fill out all fields! </p>';
    $conn->close();
    die();
}

// get teh role number for the given role
$sql19 = $conn->prepare('SELECT idx FROM userType WHERE userType = ?');
$sql19->bind_param('s', $account_types);
$sql19->execute();
$result29 = $sql19->get_result();
$user29 = $result29->fetch_assoc();

// check whether the user exists
$sql79 = $conn->prepare('SELECT * FROM User_UserType WHERE userId = ? AND userTypeId = ?');
$sql79->bind_param('ss', $email, $user29['idx']);
$sql79->execute();
$result79 = $sql79->get_result();

if (mysqli_num_rows($result79) != 0) { // if it already exists, display the error message
    echo '<p class="text-danger" > User already has the role.</p>';
    $conn->close();
    die();
}

else {
    // check whether such user exists in the database
    $sql31 = $conn->prepare('SELECT * FROM User_UserType WHERE userId = ?');
    $sql31->bind_param('s', $email);
    $sql31->execute();
    $result31 = $sql31->get_result();

    if (mysqli_num_rows($result31) == 0) { // if it doesnt exist, display error message
        echo '<p class="text-danger" > No such user exists.</p>';
        $conn->close();
        die();
    }

    else {
        $sql = $conn->prepare('SELECT * FROM User WHERE email = ?');
$sql->bind_param('s', $email);
$sql->execute();
$result = $sql->get_result();
$user = $result->fetch_assoc();

$sql1 = $conn->prepare('SELECT idx FROM userType WHERE userType = ?');
$sql1->bind_param('s', $account_types);
$sql1->execute();
$result2 = $sql1->get_result();
$user2 = $result2->fetch_assoc();

if (!empty($studentId)) {
    $query = $conn->prepare('UPDATE User SET studentId = ? WHERE email = ?');
    $query->bind_param('ss', $studentId, $email);
    $query->execute();
}

$sql = $conn->prepare(
    'INSERT INTO User_UserType (userId, userTypeId) VALUES (?, ?)'
);
$sql->bind_param('si', $email, $user2['idx']);

$result = $sql->execute();

if (!empty($fac) and !empty($dep)) {
    $query = $conn->prepare('SELECT * FROM Prof_Info WHERE email = ?');
    $query->bind_param('s', $email);
    $query->execute();

    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if (empty($user)) {
        $query = $conn->prepare(
            'INSERT INTO Prof_Info (email, faculty, department) VALUES (?, ?, ?)'
        );
        $query->bind_param('sss', $email, $fac, $dep);
        $query->execute();
    } else {
        $query = $conn->prepare(
            'UPDATE Prof_Info SET faculty = ?, department = ? WHERE email = ?'
        );
        $query->bind_param('sss', $fac, $dep, $email);
        $query->execute();
    }
}
    }

$conn->close();
}
// success error messages
if ($result) {
     echo '<p class="text-success" >User updated successfully!</p>';
 } else {
    echo '<p class="text-danger" >User could not be updated!</p>';
 }

?>
