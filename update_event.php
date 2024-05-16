<?php
require('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST['event_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['location']) && isset($_POST['date'])) {
        $event_id = $_POST['event_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $date = $_POST['date'];

        // Check if a new image file is uploaded
        if ($_FILES['image']['name']) {
            $image = $_FILES['image']['name'];
            $temp_image = $_FILES['image']['tmp_name'];
            $upload_dir = "uploads/"; // Directory where images will be uploaded

            // Move uploaded file to the specified directory
            move_uploaded_file($temp_image, $upload_dir.$image);

            // Update event details including the image file
            $stmt = $conn->prepare("UPDATE events SET name=?, description=?, location=?, date=?, image=? WHERE id=?");
            $stmt->bind_param("sssssi", $name, $description, $location, $date, $image, $event_id);
        } else {
            // Update event details without changing the image
            $stmt = $conn->prepare("UPDATE events SET name=?, description=?, location=?, date=? WHERE id=?");
            $stmt->bind_param("ssssi", $name, $description, $location, $date, $event_id);
        }

        // Execute the update statement
        if ($stmt->execute()) {
            // Redirect back to events page after successful update
            header("Location: view-event.php");
            exit();
        } else {
            echo "Error updating event: " . $stmt->error;
        }
    } else {
        echo "All fields are required";
    }
}

$conn->close();
?>
