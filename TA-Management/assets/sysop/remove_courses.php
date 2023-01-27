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

// define all fields
$course_number = $_POST['courseNumber'];
$course_term = $_POST['term'];
$course_year = $_POST['year'];
$course_instructor_email = $_POST['instrEmail'];

if ( // check whether any of the fields are null
    empty($course_number) ||
    empty($course_term) ||
    empty($course_year) ||
    empty($course_instructor_email)
) { // display error messages as necessary
    echo '<p class="text-danger"> Please fill out all fields! </p>';
    $conn->close();
    die();
}


$sql7 = $conn->prepare("SELECT * FROM Course WHERE courseNumber = ? AND term = ? AND year = ? AND courseInstructor = ?");
$sql7->bind_param('ssss', $course_number, $course_term, $course_year, $course_instructor_email);
$sql7->execute();
$result7 = $sql7->get_result();
//check whether the course exists

if (mysqli_num_rows($result7) == 0) {
    echo '<p class="text-danger"> No such course exists.</p>';
    $conn->close();
    die();
} else {

// first the prof removal

//$sql79 = $conn->prepare("SELECT * FROM Course WHERE courseNumber = ? AND courseInstructor = ?");
//$sql79->bind_param('ss', $course_number, $course_instructor_email);
//$sql79->execute();
//$result79 = $sql79->get_result();
//check whether the course exists


$sql31 = $conn->prepare('DELETE FROM Professor WHERE professor = ? AND course = ?');
$sql31->bind_param('ss', $course_instructor_email, $course_number);
$sql31->execute();

// course removal
$sql = $conn->prepare('SELECT * FROM Course WHERE term = ? AND year = ? AND courseNumber = ? AND courseInstructor = ?');
$sql->bind_param('ssss', $course_term, $course_year, $course_number, $course_instructor_email);
$sql->execute();
$result = $sql->get_result();
$user = $result->fetch_assoc();
$sql = $conn->prepare(
'DELETE FROM COURSE WHERE term = ? AND year = ? AND courseNumber = ? AND courseInstructor = ?'
);
$sql->bind_param(
    'ssss',
    $course_term,
    $course_year,
    $course_number,
    $course_instructor_email
);
$result = $sql->execute();

$sql64 = $conn->prepare("SELECT * FROM Course WHERE courseNumber = ? AND courseInstructor = ?");
$sql64->bind_param('ss', $course_number, $course_instructor_email);
$sql64->execute();
$result64 = $sql64->get_result();
//check whether the course exists

if (mysqli_num_rows($result64) != 0) {

    $query5 = $conn->prepare("SELECT * FROM Prof_Info WHERE email = ?");
    $query5->bind_param('s', $course_instructor_email);
    $query5->execute();
    $res5 = $query5->get_result();
    $user5 = $res5->fetch_assoc();
    $fac = $user5['faculty'];
    $dep = $user5['department'];

    $sql13 = $conn->prepare("INSERT INTO Professor (professor, faculty, department, course) VALUES (?, ?, ?, ?)");
    $sql13->bind_param('ssss', $course_instructor_email, $fac, $dep, $course_number);
    $sql13->execute();
}


$conn->close();
}

if ($result) {
    echo '<p class="text-success" >Course successfully removed!</p>';
} else {
    echo '<p class="text-danger" >Course could not be removed...</p>';
}
?>

