<?php
include "db.php";

$name = $email = $course = "";
$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name   = trim($_POST['name']);
    $email  = trim($_POST['email']);
    $course = trim($_POST['course']);

    
    if (empty($name)) {
        $error['name'] = "Name is required";
    } elseif (!preg_match('/^[A-Za-z ]+$/', $name)) {
        $error['name'] = "Name should contain only letters";
    }

    
    if (empty($email)) {
        $error['email'] = "Email is required";
    } elseif (!preg_match("/@.+\.com$/", $email)) {
        $error['email'] = "Email format is incorrect";
    }

    if (empty($course)) {
        $error['course'] = "Course is required";
    }

    if (empty($error)) {
        mysqli_query(
            $conn,
            "INSERT INTO students (name, email, course)
             VALUES ('$name', '$email', '$course')"

        );
        if (empty($error)) {
    $query = "INSERT INTO students (name, email, course)
              VALUES ('$name', '$email', '$course')";

    if (mysqli_query($conn, $query)) {
        echo "<p style='color:green;'>Student added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error adding student</p>";
    }
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add Student</h2>

<form method="POST">

    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo $name; ?>"><br>
    <div><?php echo $error['name'] ?? ""; ?></div><br>

    <label>Email:</label><br>
    <input type="text" name="email" value="<?php echo $email; ?>"><br>
    <div><?php echo $error['email'] ?? ""; ?></div><br>

    <label>Course:</label><br>
    <input type="text" name="course" value="<?php echo $course; ?>"><br>
    <div><?php echo $error['course'] ?? ""; ?></div><br>

    <button type="submit">Submit</button>

</form>

</body>
</html>
