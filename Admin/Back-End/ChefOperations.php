<?php
include '../../Back-End/DBConnection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $name = $_POST['name'];
        $bio = $_POST['bio'];
        $specialty = $_POST['specialty'];
        $image_url = $_POST['image_url'];

        $query = "INSERT INTO Chefs (name, bio, specialty, image_url) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $name, $bio, $specialty, $image_url);

        if ($stmt->execute()) {
            $message = "New chef added successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
        header("Location: ../../Admin/View/Manage_Chef.php"); 
        exit();
    } elseif ($_POST['action'] == 'update') {
        $chef_id = $_POST['chef_id'];
        $name = $_POST['name'];
        $bio = $_POST['bio'];
        $specialty = $_POST['specialty'];
        $image_url = $_POST['image_url'];

        $query = "UPDATE Chefs SET name=?, bio=?, specialty=?, image_url=? WHERE chef_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $name, $bio, $specialty, $image_url, $chef_id);

        if ($stmt->execute()) {
            $message = "Chef updated successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
        header("Location: ../../Admin/View/Manage_Chef.php"); 
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $chef_id = $_GET['chef_id'];

    $query = "DELETE FROM Chefs WHERE chef_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $chef_id);

    if ($stmt->execute()) {
        echo "Chef deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit;
}

$query = "SELECT * FROM Chefs";
$result = $conn->query($query);

$chefs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chefs[] = $row;
    }
}
$conn->close();
?>