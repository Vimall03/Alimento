<?php
include 'includes/db.php'; // Include database connection

$meal_id = $_GET['meal_id'];
$query = "SELECT * FROM meals WHERE id = $meal_id";
$meal_result = mysqli_query($conn, $query);
$meal = mysqli_fetch_assoc($meal_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Meal</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Customize Your Meal: <?php echo $meal['name']; ?></h1>
        <form action="process_order.php" method="POST">
            <input type="hidden" name="meal_id" value="<?php echo $meal['id']; ?>">
            <div class="form-group">
                <label for="preferences">Select Your Preferences:</label>
                <select name="preferences[]" class="form-control" multiple>
                    <option value="Vegan">Vegan</option>
                    <option value="Gluten-Free">Gluten-Free</option>
                    <option value="Low-Carb">Low-Carb</option>
                </select>
            </div>
            <div class="form-group">
                <label for="custom_ingredients">Custom Ingredients:</label>
                <input type="text" class="form-control" name="custom_ingredients" placeholder="Add custom ingredients">
            </div>
            <button type="submit" class="btn btn-success">Submit Order</button>
        </form>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
