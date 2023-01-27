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
$course_number = $_POST['courseNumber'];
$course_name = $_POST['courseName'];
$course_description = $_POST['courseDescription'];
$course_term = $_POST['term'];
$course_year = $_POST['year'];
$course_instructor_email = $_POST['instrEmail'];
$prof_number = 2;

if ( // check for any null values
    empty($course_number) ||
    empty($course_name) ||
    empty($course_description) ||
    empty($course_term) ||
    empty($course_year) //||
    //empty($course_instructor_email)
) {
    // if thre are any null values, raise an error
    echo '<p class="text-danger"> Please fill out all fields! </p>';
    $conn->close();
    die();
}


// check whether the course we would like to add already exists
$sql = $conn->prepare("SELECT * FROM Course WHERE courseNumber = ? AND term = ? AND year = ?");
$sql->bind_param('sss', $course_number, $course_term, $course_year);
$sql->execute();
$result = $sql->get_result();
$course = $result->fetch_assoc();

// if course exists, raise the error message
if ($course) {
    echo '<p class="text-danger">The course already exists.</p>';
    $conn->close();
    die();
} else {
    // check whether the professor exists
    $sql7 = $conn->prepare("SELECT * FROM User_UserType WHERE userId = ? AND userTypeId = ?");
    $sql7->bind_param('ss', $course_instructor_email, $prof_number);
    $sql7->execute();
    $result7 = $sql7->get_result();

    

    if ((mysqli_num_rows($result7) == 0) and (! empty($course_instructor_email))) {
        echo '<p class="text-danger"> No such professor exists with the given email.</p>';
        $conn->close();
        die();
    } else {
    // insert the course
    


    if ($course_instructor_email){
        $sql = $conn->prepare("INSERT INTO Course (courseName, courseDesc, term, year, courseNumber, courseInstructor) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param('ssssss', $course_name, $course_description, $course_term, $course_year, $course_number, $course_instructor_email);
        $result = $sql->execute();


        $query = $conn->prepare("SELECT * FROM Prof_Info WHERE email = ?");
        $query->bind_param('s', $course_instructor_email);
        $query->execute();
        $res = $query->get_result();
        $user = $res->fetch_assoc();
        $fac = $user['faculty'];
        $dep = $user['department'];

    $sql1 = $conn->prepare("INSERT INTO Professor (professor, faculty, department, course) VALUES (?, ?, ?, ?)");
    $sql1->bind_param('ssss', $course_instructor_email, $fac, $dep, $course_number);
    $sql1->execute();
    }
    else {
        $sql = $conn->prepare("INSERT INTO Course (courseName, courseDesc, term, year, courseNumber) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param('sssss', $course_name, $course_description, $course_term, $course_year, $course_number);
        $result = $sql->execute();
    }
    
    $conn->close();
}
}
// succes/failure messages
if ($result) {
    echo '<p class="text-success" >Course created successfully!</p>';
} else {
    echo '<p class="text-danger" >Course creation failed...</p>';
} 
?>