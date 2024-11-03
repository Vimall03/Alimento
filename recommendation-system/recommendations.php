<?php


session_start();
include 'partials/_dbconnect.php';
include 'includes/recommendation_system.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$recommendationSystem = new RecommendationSystem($conn);

// Get recommendations
$restaurantRecommendations = $recommendationSystem->getRestaurantRecommendations($userId);
$dishRecommendations = $recommendationSystem->getDishRecommendations($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalized Recommendations</title>
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <!-- Restaurant Recommendations -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Recommended Restaurants</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php foreach ($restaurantRecommendations as $restaurant): ?>
                    <div class="bg-white rounded-lg shadow-md p-4 recommended-item" data-item-id="<?php echo $restaurant['r_id']; ?>" data-item-type="restaurant">
                        <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($restaurant['r_name']); ?></h3>
                        <p class="text-gray-600"><?php echo htmlspecialchars($restaurant['r_cuisine']); ?></p>
                        <p class="text-yellow-500">Rating: <?php echo number_format($restaurant['r_rating'], 1); ?></p>
                        <a href="menu.php?id=<?php echo $restaurant['r_id']; ?>" 
                           class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                            View Menu
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Dish Recommendations -->
        <section>
            <h2 class="text-2xl font-bold mb-4">Recommended Dishes</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php foreach ($dishRecommendations as $dish): ?>
                    <div class="bg-white rounded-lg shadow-md p-4 recommended-item" data-item-id="<?php echo $dish['m_id']; ?>" data-item-type="dish">
                        <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($dish['m_name']); ?></h3>
                        <p class="text-gray-600">From: <?php echo htmlspecialchars($dish['r_name']); ?></p>
                        <p class="text-gray-500"><?php echo htmlspecialchars($dish['m_category']); ?></p>
                        <p class="text-green-600">₹<?php echo number_format($dish['m_price'], 2); ?></p>
                    </div>
                <?php endforeach; ?>
            </div