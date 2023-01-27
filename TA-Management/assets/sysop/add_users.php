<?php
$servername = "localhost"; // Change accordingly
$username = "root"; // Change accordingly
$password = ""; // Change accordingly
$db = "xampp_starter"; // Change accordingly

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// define all fields to add to the database
$password = $_POST['password'];
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
$email = $_POST['email'];
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$usernamezort = $_POST['usernamezort'];
$studentId = $_POST['studentId'];
$fac = $_POST['fac'];
$dep = $_POST['dep'];
$prof_number = 2;
$account_types = $_POST['accounttypes'];
$account_types = json_decode($account_types, true); // convert JSON to array of account types

// check whether any of the fields are null
// if yes, display an error message
if (
    empty($password) ||
    empty($email) ||
    empty($first_name) ||
    empty($last_name) ||
    empty($usernamezort) ||
    empty($account_types)
) {
    echo '<p class="text-danger"> Please fill out all fields! </p>';
    $conn->close();
    die();
}

// check whether such user already exists
$sql8 = $conn->prepare("SELECT * FROM User WHERE email = ?");
$sql8->bind_param('s', $email);
$sql8->execute();
$result8 = $sql8->get_result();

if (mysqli_num_rows($result8) != 0) { //change the condition
    echo '<p class="text-danger"> The user already exists.</p>';
    $conn->close();
    die();
} else {
    // hash the password
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = $conn->prepare("INSERT INTO User (firstName, lastName, email, password, username, studentId) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param('ssssss', $first_name, $last_name, $email, $hashed_pass, $usernamezort, $studentId);

    // if the user has professor as a role
    if (in_array($prof_number, $account_types)){
        if ((! empty($fac)) and (! empty($dep))){
            $sql4 = $conn->prepare("INSERT INTO Prof_Info (email, faculty, department) VALUES (?, ?, ?)");
            $sql4->bind_param('sss', $email, $fac, $dep);
            $sql4->execute();
        }
        else {
            echo '<p class="text-danger"> Please fill out all fields! </p>';
            $conn->close();
            die();
        }
    }
    
    if ($sql->execute()) {
        // add the user to the User_UserType table for each account type provided as the input
        foreach ($account_types as $account_type) {
            $user_type_sql = $conn->prepare("INSERT INTO User_UserType (userId, userTypeId) VALUES (?, ?)");
            $user_type_sql->bind_param('si', $email, $account_type);
            $result = $user_type_sql->execute();
        }
    }
    $conn->close();
}

// success failure messages
if ($result) {
    echo '<p class="text-success" >User created successfully!</p>';
} else {
    echo '<p class="text-danger" >User creation failed...</p>';
} 
?>