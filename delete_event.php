<?php
require('config.php');

if(isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Delete event from the database
    $sql = "DELETE FROM events WHERE id='$event_id'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to events page after successful deletion
        header("Location:view-event.php");
        exit();
    } else {
        echo "Error deleting event: " . $conn->error;
    }
} else {
    echo "Event ID not provided";
}

$conn->close();
?>
