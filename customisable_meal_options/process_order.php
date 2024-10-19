<?php
include 'includes/db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meal_id = $_POST['meal_id'];
    $preferences = implode(", ", $_POST['preferences']);
    $custom_ingredients = $_POST['custom_ingredients'];

    // Process the order here (save to the database, send confirmation, etc.)
    // For example, save to a new table called orders

    $query = "INSERT INTO orders (meal_id, preferences, custom_ingredients) VALUES ('$meal_id', '$preferences', '$custom_ingredients')";
    mysqli_query($conn, $query);

    // Redirect to a confirmation page or show success message
    echo "Order submitted successfully!";
}
?>
