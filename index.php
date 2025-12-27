<?php
require_once "db.php";

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Students List</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<h1>Students List</h1>

<div class="top-bar">
    <a href="create.php" class="add-btn">+ Add New Student</a>
</div>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Edit / Delete</th>
    </tr>

<?php
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['course']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Are you sure you want to delete this user?');">
               Delete
            </a>
        </td>
    </tr>
<?php
    }
} else {
    echo "<tr><td colspan='5'>No data found</td></tr>";
}
?>

</table>

</body>
</html>
