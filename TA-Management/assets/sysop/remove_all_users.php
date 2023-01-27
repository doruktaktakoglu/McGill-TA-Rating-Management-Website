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

// define all fields to add to the database
$email = $_POST['email'];

if (
    empty($email)
) {
    echo '<p class="text-danger"> Please fill out all fields! </p>';
    $conn->close();
    die();
}

//if (mysqli_num_rows($result7) == 0) { // if no such user exists, display the error message
//    echo '<p class="text-danger" >No such user exists.</p>';
//    $conn->close();
//    die();
//}
//else {
//    $sql = $conn->prepare( // delete the user from the User_UserType table
//        'DELETE FROM User_UserType WHERE userId = ? ');
//    $sql->bind_param('s', $email);
    
 //   $result = $sql->execute();

    // check whether the user is in the database
$sql7 = $conn->prepare('SELECT * FROM User_UserType WHERE userId = ?');
$sql7->bind_param('s', $email);
$sql7->execute();
$result7 = $sql7->get_result();

if (mysqli_num_rows($result7) == 0) { // if no such user exists, display the error message
    echo '<p class="text-danger" >No such user exists.</p>';
    $conn->close();
    die();
}
else {
    $sql = $conn->prepare( // delete the user from the User_UserType table
        'DELETE FROM User_UserType WHERE userId = ?'
    );
    $sql->bind_param('s', $email);
    
    $result = $sql->execute();

    $sqlprof = $conn->prepare("DELETE FROM Professor WHERE professor = ?");
    $sqlprof->bind_param('s', $email);
    $sqlprof->execute();

    $sqlsavecourse = $conn->prepare("SELECT * FROM Course WHERE courseInstructor = ?");
    $sqlsavecourse->bind_param('s', $email);
    $sqlsavecourse->execute();
    $sqlsavedcourse = $sqlsavecourse->get_result();

    while($course = $sqlsavedcourse->fetch_assoc()){

        $sqlstudentcourse = $conn->prepare("DELETE FROM Student_Course WHERE courseId = ?");
        $sqlstudentcourse->bind_param('s', $course['courseNumber']);
        $sqlstudentcourse->execute();

        $sqlofficehours = $conn->prepare("DELETE FROM OfficeHours WHERE course = ?");
        $sqlofficehours->bind_param('s', $course['courseNumber']);
        $sqlofficehours->execute();

        $sqlmessage = $conn->prepare("DELETE FROM message WHERE course = ?");
        $sqlmessage->bind_param('s', $course['courseNumber']);
        $sqlmessage->execute();
    }
    
    $sqlcourse = $conn->prepare("DELETE FROM Course WHERE courseInstructor = ?");
    $sqlcourse->bind_param('s', $email);
    $sqlcourse->execute();

     // delete from student table
     $removestudent = $conn->prepare("DELETE FROM Student_Course WHERE studentId = ?");
     $removestudent->bind_param('s', $email);
     $removestudent->execute();
 
     // delete from TA tables
     $removefromTA = $conn->prepare("DELETE FROM TA WHERE email = ?");
     $removefromTA->bind_param('s', $email);
     $removefromTA->execute();
 
     $removefromOH = $conn->prepare("DELETE FROM OfficeHours WHERE email = ?");
     $removefromOH->bind_param('s', $email);
     $removefromOH->execute();

        // if after the removal, user has no remaining roles remove the user from the users table
$sql2 = $conn->prepare(
    'SELECT userId FROM User_UserType WHERE userId = ? AND userTypeId = ? '
);
$sql2->bind_param('ss', $email, $user2['idx']);
$sql2->execute();
$result3 = $sql2->get_result();
$user3 = $result3->fetch_assoc();


if (is_null($user3)) {
    $sql4 = $conn->prepare('DELETE FROM User WHERE email = ?');
    $sql4->bind_param('s', $email);
    $sql4->execute();
}

}

//$null = NULL;
//echo $null;

//$sqlsavecourse = $conn->prepare("SELECT * FROM Course WHERE courseInstructor = ?");
//$sqlsavecourse->bind_param('s', $email);
//$sqlsavecourse->execute();
//$sqlsavedcourse = $sqlsavecourse->get_result();
//$courses = $sqlsavedcourse->fetch_assoc();



//$namestoadd = $courses['courseName'];
//$descriptionstoadd = $courses['courseDesc'];
//$termstoadd = $courses['term'];
//$yearstoadd = $courses['year'];
//$numberstoadd = $courses['courseNumber'];

//$count = mysqli_num_rows($sqlsavedcourse);

//echo $count;
//echo $namestoadd;
//echo $descriptionstoadd;
//echo $termstoadd;
//echo $yearstoadd;
//echo $numberstoadd;
$conn->close();
die();
// success error messages
if ($result) {
    echo '<p class="text-success" >User removed successfully!</p>';
} else {
    echo '<p class="text-danger" >User removal failed...</p>';
}
?>
