<?php
$servername = 'localhost'; // Change accordingly
$username = 'root'; // Change accordingly
$password = ''; // Change accordingly
$db = 'xampp_starter'; // Change accordingly

$entered = 'entered';
// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$course = $_POST['course'];
$term = $_POST['term'];
$year = $_POST['year'];

// if (strcmp($student_id, '') == 0) {
//     echo '<p>' . $entered . '</p>';
// }

// if (strcmp($ta_email, '') != 0 and strcmp($student_id, '') != 0) {
$sql = $conn->prepare(
    'SELECT DISTINCT email,student_id,ta_name FROM TA WHERE course=? AND term=? AND years=?'
);
$sql->bind_param('sss', $course, $term, $year);
$sql->execute();
$result = $sql->get_result();

if (mysqli_num_rows($result) == 0) {
    echo '<p style="display:flex; 
                    justify-content:center;
                        align-item:center;
                        margin-top: 20px;
                        color: rgb(167, 37, 48);
                        font-weight: bold;
                        font-size: 18px;">' .
        $NotFound .
        '</p>';
    die();
}

// $sql2 = $conn->prepare(
//     'SELECT FORMAT(AVG(TA_Ratings.rating),2) as ta_rating_average FROM TA_Ratings WHERE TA_Ratings.ta_email = (SELECT DISTINCT ta_email FROM TA WHERE ta.student_id = ? AND ta.email = ?)'
// );
// $sql2->bind_param('ss', $student_id, $ta_email);
// $sql2->execute();

// $ta_averges = $sql2->get_result();

// $sql3 = $conn->prepare(
//     'SELECT COUNT(course) as total_courses FROM `TA` WHERE email = ? and student_id = ?;'
// );

// $sql3->bind_param('ss', $ta_email, $student_id);
// $sql3->execute();
// $num_crs = $sql3->get_result();
echo '<div class="row" style="overflow-x:auto;">
<table>';
echo '<tr>
<th class="red-label">Email</th>
<th class="red-label">Student ID</th>
<th class="red-label">Name</th>
<th class="red-label">Total Courses TA\'d</th>
<th class="red-label">Average Feedback</th>
</tr>';

while ($ta = $result->fetch_assoc()) {
    $sql2 = $conn->prepare(
        'SELECT FORMAT(AVG(TA_Ratings.rating),2) as ta_rating_average FROM TA_Ratings WHERE TA_Ratings.ta_email = (SELECT DISTINCT email FROM TA WHERE ta.student_id = ? AND ta.email = ?)'
    );
    $sql2->bind_param('ss', $ta['student_id'], $ta['email']);
    $sql2->execute();
    $ta_averges = $sql2->get_result();
    $average = $ta_averges->fetch_assoc();

    $ta_average_feedback = $average['ta_rating_average'];
    if ($ta_average_feedback == null) {
        $ta_average_feedback = 'N/A';
    }

    $sql3 = $conn->prepare(
        'SELECT COUNT(course) as total_courses FROM `TA` WHERE student_id = ? and email = ?;'
    );

    $sql3->bind_param('ss', $ta['student_id'], $ta['email']);
    $sql3->execute();
    $num_crs = $sql3->get_result();
    $total_courses = $num_crs->fetch_assoc();
    echo '<tr>
    <td>' .
        $ta['email'] .
        '</td>
    <td>' .
        $ta['student_id'] .
        '</td>
    <td>' .
        $ta['ta_name'] .
        '</td>
        <td>' .
        $total_courses['total_courses'] .
        '</td>
        <td>' .
        $ta_average_feedback .
        '</td>
        </tr>';
}

echo '</table></div>';

// echo '<p>' . $average['ta_rating_average'] . '</p>';

// echo '<p>' . $ta['email'] . '</p>';

// First we need to get the TA Credentials
// We can have to two tables
// A summarized report with their First Name, Last Name, email, Rating Average, Course

// We then need the
$conn->close();
?>
