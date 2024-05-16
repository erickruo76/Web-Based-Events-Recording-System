<?php
require('config.php');
include 'user-nav.php';
?>

<style>
    .container{
        margin-bottom: 30px;
    }
    .card {
        height: 500px;
         /* Set the height of the card */
        border-radius: 5px; 
        /* Add rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        /* Add shadow */
        transition: box-shadow 0.3s ease; 
        /* Add transition effect */
        margin-bottom: 30px;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Change shadow on hover */
        
    }
    .btn-primary{
        bottom: 10px;
        transform: translateX(100%);
        margin-top: 12px;;
        background-color: #1C1D3C;

    }
       
</style>

<div class="container">
    <?php
    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="row">';
        while($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-4 col-md-6 mt-5">';
            echo '<div class="card h-100">';
            
            // Check if image path exists
            if(!empty($row['image'])) {
                // Concatenate base URL with image path
                $image_url = "uploads/" . $row['image'];
            } else {
                // If image path is empty, display a placeholder image or a message
                $image_url = "path_to_placeholder_image.jpg"; // Replace with path to your placeholder image
            }
            
            echo '<img src="' . $image_url . '" class="card-img-top" style="object-fit: cover; height: 150px;" alt="' . $row['name'] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['name'] . '</h5>';
            echo '<p class="card-text">' . substr($row['description'], 0, 100) . '...</p>';
            echo '<a href="user-readmore.php?id=' . $row['id'] . '" class="btn btn-primary ">Read More</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No events found";
    }
    $conn->close();
    ?>
</div>

<?php
include 'footer.php';
?>
