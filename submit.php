<?php
$servername = "localhost";
$username = "root";
$password = "vasa@2004";
$dbname = "journal_submissions";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $journal = $_FILES['journal']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["journal"]["name"]);

    if (move_uploaded_file($_FILES["journal"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO submissions (name, designation, department, state, district, title, description, journal)
        VALUES ('$name', '$designation', '$department', '$state', '$district', '$title', '$description', '$journal')";

        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "error";
    }
}

$conn->close();
?>
