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


if(isset($_FILES['file'])){
    $file_content = file($_FILES['file']['tmp_name']);
    foreach($file_content as $row) {
        $items = explode(",", trim($row));
        if (count($items) != 6){
            echo '<p class="text-danger"> Please include all fields! </p>';
            $conn->close();
            die();
        }
        // define all fields
        $course_number = $items[4];
        $course_name = $items[0];
        $course_description = $items[1];
        $course_term = $items[2];
        $course_year = $items[3];
        $course_instructor_email = $items[5];
        $prof_number = 2;



        if ( // check whether any of the required fields are null
            empty($course_number) ||
            empty($course_name) ||
            empty($course_description) ||
            empty($course_term) ||
            empty($course_year) //||
            //empty($course_instructor_email)
        ) { // display error messages
            echo '<p class="text-danger"> Please fill out all fields! </p>';
            $conn->close();
            die();
        }

        // check whether the course exists
        $sql41 = $conn->prepare("SELECT * FROM Course WHERE courseNumber = ? AND term = ? AND year = ? AND courseInstructor = ?");
        $sql41->bind_param('ssss', $course_number, $course_term, $course_year, $course_instructor_email);
        $sql41->execute();
        $result41 = $sql41->get_result();
        $course41 = $result41->fetch_assoc();

        if ($course41) {
            echo '<p class="text-danger">The course already exists.</p>';
            $conn->close();
            die();
        }

        else {
            // check whether the instructor is a user that has the prof role
            $sql7 = $conn->prepare("SELECT * FROM User_UserType WHERE userId = ? AND userTypeId = ?");
            $sql7->bind_param('ss', $course_instructor_email, $prof_number);
            $sql7->execute();
            $result7 = $sql7->get_result();
            if ((mysqli_num_rows($result7) == 0) and (! empty($course_instructor_email))) {
                echo '<p class="text-danger"> No such professor exists with the given email.</p>';
                $conn->close();
                die();
            } else {
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
            }
        }
        $conn->close();

        if ($result) {
            echo '<p class="text-success" >Course created successfully!</p>';
        } else {
            echo '<p class="text-danger">Course creation failed...</p>';
        } 
    }
}
?>