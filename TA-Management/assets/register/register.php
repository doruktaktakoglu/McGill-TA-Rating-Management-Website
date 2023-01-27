<?php
//creating connection
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

//getting data from the form
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$username = $_POST['username'];
$studentId = $_POST['studentId'];
$password = $_POST['password'];
$password_hashed = password_hash($password, PASSWORD_DEFAULT);
$t = $_POST['type'];
$types = explode(',', $t);
if (isset($_POST['course'])) {
    $c = $_POST['course'];
    $course = explode(',', $c);
    $arrayLength = count($course);
}
$userLength = count($types);
$userTypes = [];
$i = 0;
$j = 0;

//checking if all fields entered
if (
    empty($fname) ||
    empty($lname) ||
    empty($email) ||
    empty($password) ||
    empty($username)
) {
    echo '<text style="color: #FF0000;">Please fill in all fields.</text>';
    return;
}

function deleteUser()
{
    global $conn, $email;
    $sql = $conn->prepare('DELETE FROM User_UserType WHERE userId = ?');
    $sql->bind_param('s', $email);
    $sql->execute();

    $sql = $conn->prepare('DELETE FROM User WHERE email = ?');
    $sql->bind_param('s', $email);
    $sql->execute();
}

//check if email already exists
$sql = $conn->prepare('SELECT * FROM User WHERE email = ?');
$sql->bind_param('s', $email);
$sql->execute();
$result = $sql->get_result();
$user = $result->fetch_assoc();

if ($user) {
    echo '<text style="color: #FF0000;">Email already exists.</text>';
    die();
}

//add to users table
$sql = $conn->prepare(
    'INSERT INTO User (firstName, lastName, email, password, studentId, username) VALUES (?, ?, ?, ?, ?, ?)'
);
$sql->bind_param(
    'ssssss',
    $fname,
    $lname,
    $email,
    $password_hashed,
    $studentId,
    $username
);
$sql->execute();
$sql->close();

$userTypeId = '0';

//

$sql2 = $conn->prepare('SELECT * FROM USER_ACCESS WHERE email = ?');
$sql2->bind_param('s', $email);
$sql2->execute();
$result2 = $sql2->get_result();
$checkUser = [];
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $checkUser[$i] = $row['userTypeId'];
        $i++;
    }
}

//add to user type table - can be multiple types
while ($j < $userLength) {
    $sql2 = $conn->prepare('SELECT * FROM USER_ACCESS WHERE email = ?');
    $sql2->bind_param('s', $email);
    $sql2->execute();
    $result2 = $sql2->get_result();
    $type = $types[$j];
    $sql5 = $conn->prepare(
        'SELECT COUNT(`userTypeId`) FROM USER_ACCESS WHERE email = ?'
    );
    $sql5->bind_param('s', $email);
    $sql5->execute();
    $result5 = $sql5->get_result();
    if ($result5->fetch_assoc()['COUNT(`userTypeId`)'] == 0) {
        if (strcmp($type, 'Student') == 0) {
            $userTypeId = 1;
            $studentId = $_POST['studentId'];
        } else {
            echo '<text class="text-danger">User does not have access to this system.</text>';
            deleteUser();
            die();
            return;
        }
    }

    if (strcmp($type, 'Student') == 0) {
        $userTypeId = 1;
        $studentId = $_POST['studentId'];
    } elseif (strcmp($type, 'Professor') == 0) {
        if (in_array('2', $checkUser)) {
            $userTypeId = 2;
        } else {
            echo '<text class="text-danger">Not a Professor.</text>';
            deleteUser();
            die();
            return;
        }
    } elseif (strcmp($type, 'TA') == 0) {
        if (in_array('3', $checkUser)) {
            $userTypeId = 3;
            $studentId = $_POST['studentId'];
        } else {
            echo '<text class="text-danger"> Not a TA.</text>';
            deleteUser();
            die();
            return;
        }
    } elseif (strcmp($type, 'TA Administrator') == 0) {
        if (in_array('4', $checkUser)) {
            $userTypeId = 4;
        } else {
            echo '<text class="text-danger">Not a TA Admin.</text>';
            deleteUser();
            die();
            return;
        }
    } elseif (strcmp($type, 'System Operator') == 0) {
        if (in_array('5', $checkUser)) {
            $userTypeId = 5;
        } else {
            echo '<text class="text-danger">Not a System Operator.</text>';
            deleteUser();
            die();
            return;
        }
    } else {
        echo 'Error: User type not found.';
        deleteUser();
        return;
    }

    $sql2->close();
    $sql2 = $conn->prepare(
        'INSERT INTO User_UserType (userId, userTypeId) VALUES (?, ?)'
    );

    $sql2->bind_param('ss', $email, $userTypeId);
    $sql2->execute();
    $userTypes[] = $userTypeId;
    $j++;
}
$sql2->close();

if ($userTypeId == '0') {
    echo '<text class="text-danger">User does not have access to this system.</text>';
    deleteUser();
    die();
    return;
}
// if student, add to student_course table for registered courses

if (in_array(1, $userTypes)) {
    while ($i < $arrayLength) {
        $courseId = $course[$i];
        $sql3 = $conn->prepare(
            'INSERT INTO Student_Course (studentId, courseId) VALUES (?, ?)'
        );
        $sql3->bind_param('ss', $email, $courseId);
        $sql3->execute();
        $i++;
    }
    $conn->close();
}

// if success, redirect to dashboard
session_start();
$_SESSION['email'] = $email;
echo "<script>window.location.replace('../dashboard/dashboard.html'); </script>";
?>