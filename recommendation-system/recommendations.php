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

// Get recommendations using new optimized methods
$restaurantRecommendations = $recommendationSystem->getOptimizedRestaurantRecommendations($userId);
$dishRecommendations = $recommendationSystem->getOptimizedDishRecommendations($userId);

// Add interaction tracking
if (isset($_POST['track_interaction'])) {
    $itemId = $_POST['item_id'];
    $itemType = $_POST['item_type'];
    $interactionType = $_POST['interaction_type'];
    $recommendationSystem->trackInteraction($userId, $itemId, $itemType, $interactionType);
}

// Rest of the file remains the same...
?>

<!-- In the HTML section, add JavaScript for real-time interaction tracking -->
<script>
function trackInteraction(itemId, itemType, interactionType) {
    fetch('recommendations.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `track_interaction=1&item_id=${itemId}&item_type=${itemType}&interaction_type=${interactionType}`
    });
}

// Add event listeners to recommendation items
document.querySelectorAll('.recommended-item').forEach(item => {
    item.addEventListener('click', function() {
        const itemId = this.dataset.itemId;
        const itemType = this.dataset.itemType;
        trackInteraction(itemId, itemType, 'click');
    });
});
</script>