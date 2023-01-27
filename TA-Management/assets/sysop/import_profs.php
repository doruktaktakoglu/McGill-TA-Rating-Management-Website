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

        if (count($items) != 4){
            echo '<p class="text-danger"> Please include all fields! </p>';
            $conn->close();
            die();
        }
        // define all fields
        $instructor_email = $items[0];
        $faculty = $items[1];
        $department = $items[2];
        $course_number = $items[3];

        if ( // check whether any of the required fields are null
            empty($instructor_email) ||
            empty($faculty) ||
            empty($department) ||
            empty($course_number)
        ) {// display error messages
            echo '<p class="text-danger"> Please fill out all fields! </p>';
            $conn->close();
            die();
        }

        $sql7 = $conn->prepare("SELECT * FROM User_UserType WHERE userId = ? AND userTypeId = ?");
        $sql7->bind_param('ss', $course_instructor_email, $prof_number);
        $sql7->execute();
        $result7 = $sql7->get_result();
        if ((mysqli_num_rows($result7) == 0) and (! empty($course_instructor_email))) {
            echo '<p class="text-danger"> No such professor exists with the given email.</p>';
            $conn->close();
            die();
        }


        // check whether such professor already exists in the database
        $sql1 = $conn->prepare("SELECT * FROM Professor WHERE professor = ? AND faculty = ? AND department = ? AND course = ?");
        $sql1->bind_param('ssss', $instructor_email, $faculty, $department, $course_number);
        $sql1->execute();
        $result1 = $sql1->get_result();

        if ((mysqli_num_rows($result1) != 0)) { // raise an error message
            echo '<p class="text-danger"> Professor already exists! Please Try again!</p>';
            $conn->close();
            die();
        }
        else {
            // check whether there is such course
            $query = $conn->prepare("SELECT * FROM Course WHERE courseNumber = ? ");
            $query->bind_param('s', $course_number);
            $query->execute();
            $res = $query->get_result();
            $thecourse = $res->fetch_assoc();

            if (! $thecourse) { // if there is no such course print an error message
                echo '<p class="text-danger"> There is no such course in the given term and year!</p>';
                $conn->close();
                die();
            }
            else {
                
        
                if (! $thecourse['courseInstructor']){
                    $course_name = $thecourse['courseName'];
                    $course_description = $thecourse['courseDesc'];
        
                    $sql62 = $conn->prepare("UPDATE Course SET courseInstructor = ? WHERE courseName = ? AND courseDesc = ? AND term = ? AND year = ? AND courseNumber = ?");
                    $sql62->bind_param('ssssss',$instructor_email, $course_name, $course_description, $term, $year, $course_number);
                    $result62 = $sql62->execute();
            
                    //add the professor to the database
                    $sql = $conn->prepare("INSERT INTO Professor (professor, faculty, department, course) VALUES (?, ?, ?, ?)");
                    $sql->bind_param('ssss', $instructor_email, $faculty, $department, $course_number);
                    $result = $sql->execute();
                }
                else {
                    echo '<p class="text-danger" >The course has an assigned professor...</p>';
                    $conn->close();
                    die();
                }
            }
        }
    }
}

$conn->close();
?>