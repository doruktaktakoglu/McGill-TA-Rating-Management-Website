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
$instructor_email = $_POST['professor'];
$faculty = $_POST['faculty'];
$department = $_POST['department'];
$course_number = $_POST['course'];

if ( // check whether the fields are null
    empty($course_number) ||
    empty($department) ||
    empty($faculty) ||
    empty($instructor_email)
) { // if yes, display error message
    echo '<p class="text-danger"> Please fill out all fields! </p>';
    $conn->close();
    die();
}

// check whether there is such a professor
$sql7 = $conn->prepare("SELECT * FROM Professor WHERE professor = ? AND faculty = ? AND department = ? AND course = ?");
$sql7->bind_param('ssss', $course_instructor_email, $faculty, $department, $course_number);
$sql7->execute();
$result7 = $sql7->get_result();

if (! $result7) { // fisplay error message
    echo '<p class="text-danger"> No such professor exists.</p>';
    $conn->close();
    die();
} else {

    // remove professor
$sql = $conn->prepare(
'DELETE FROM Professor WHERE professor = ? AND faculty = ? AND department = ? AND course = ?'
);
$sql->bind_param(
    'ssss',
    $instructor_email,
    $faculty,
    $department,
    $course_number,
);
$result = $sql->execute();


$sql92 = $conn->prepare('DELETE FROM Course WHERE courseNumber = ? AND courseInstructor = ?');
$sql92->bind_param('ss', $course_number, $instructor_email)
$sql92->execute();
$conn->close();
}

// success error messages
if ($result) {
    echo '<p class="text-success" >Professor successfully removed!</p>';
} else {
    echo '<p class="text-danger" >Professor could not be removed...</p>';
}
?>