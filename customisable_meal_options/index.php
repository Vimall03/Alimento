<?php
include 'includes/db.php'; // Include database connection

$query = "SELECT * FROM meals";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alimento - Customize Your Meal</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Meals</h1>
        <div class="row">
            <?php while ($meal = mysqli_fetch_assoc($result)) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $meal['name']; ?></h5>
                            <p class="card-text"><?php echo $meal['description']; ?></p>
                            <p class="card-text">Price: $<?php echo $meal['base_price']; ?></p>
                            <a href="customize_meal.php?meal_id=<?php echo $meal['id']; ?>" class="btn btn-primary">Customize Meal</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
