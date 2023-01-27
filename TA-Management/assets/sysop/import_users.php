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

function user_role_id_map($role){
    $user_roles = array(1 => "student", 2 => "professor", 3 => "ta", 4 => "admin", 5 => "sysop");
    $key = array_search($role, $user_roles);
    return($key);
}

// Missing a lot of error checks
if(isset($_FILES['file'])){
    $file_content = file($_FILES['file']['tmp_name']);
    foreach($file_content as $row) {
        $items = explode(",", trim($row));
        if (count($items) != 9){
            echo '<p class="text-danger"> Please include all fields! </p>';
            $conn->close();
            die();
        }
        // define all fields
        $first_name = $items[0];
        $last_name = $items[1];
        $email = $items[2];
        $password = $items[3];
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $account_types = explode('/', $items[4]);
        $account_types = array_map("user_role_id_map", $account_types);
        $studentId = $items[5];
        $user_name = $items[6];
        $faculty = $items[7];
        $department = $items[8];
        $prof_number = 2;

        if ( // check whether any of the required fields are null
            empty($first_name) ||
            empty($last_name) ||
            empty($email) ||
            empty($password) ||
            empty($user_name) ||
            (count($account_types) == 0)
        ) {// display error messages
            echo '<p class="text-danger"> Please fill out all fields! </p>';
            $conn->close();
            die();
        }

        $sql8 = $conn->prepare("SELECT * FROM User WHERE email = ?");
        $sql8->bind_param('s', $email);
        $sql8->execute();
        $result8 = $sql8->get_result();

        if (mysqli_num_rows($result8) != 0) { //change the condition
            echo '<p class="text-danger"> The user already exists.</p>';
            $conn->close();
            die();
        } 

        $sql = $conn->prepare("INSERT INTO User (firstName, lastName, email, password, studentId, username) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param('ssssss', $first_name, $last_name, $email, $hashed_pass, $studentId, $user_name);
        

        if (in_array($prof_number, $account_types)){
            if ((! empty($faculty)) AND (! empty($department))){
                $sql4 = $conn->prepare("INSERT INTO Prof_Info (email, faculty, department) VALUES (?, ?, ?)");
                $sql4->bind_param('sss', $email, $faculty, $department);
                $sql4->execute();
            }
            else {
                echo '<p class="text-danger"> Please fill out all fields! </p>';
                $conn->close();
                die();
            }
        }
        // add the user in each line
        if ($sql->execute()) {
            foreach ($account_types as $account_type) {

                $user_type_sql = $conn->prepare("INSERT INTO User_UserType (userId, userTypeId) VALUES (?, ?)");
                $user_type_sql->bind_param('si', $email, $account_type);
                $result = $user_type_sql->execute();
            }
        }
    }
}
$conn->close();
if ($result) {
    echo '<p class="text-success" >User(s) created successfully!</p>';
} else {
    echo '<p class="text-danger">User creation failed...</p>';
} 
?>
