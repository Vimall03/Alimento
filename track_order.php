<?php
session_start();
include 'partials/_dbconnect.php';
$uid = $_SESSION['user_id'];
$feedback = false;

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $r_id = $_POST['r_id'];
    $order_id = $_POST['order_id'];
    $rating = $_POST['rating'];

    $sql = "UPDATE `orders` SET `rating` = '$rating' WHERE `r_id` = '$r_id' AND `order_id` = '$order_id'";
    $result = mysqli_query($conn , $sql);

    $sql = "SELECT * FROM `orders` WHERE `r_id` = '$r_id' AND `rating` != '0'";
    $result = mysqli_query($conn , $sql);
    $num = mysqli_num_rows($result);

    $sql = "SELECT SUM(rating) AS 'sum_value' FROM `orders` WHERE `r_id` = '$r_id' AND `rating` != '0'";
    $result = mysqli_query($conn , $sql);
    $row = mysqli_fetch_assoc($result);
    $sum = $row['sum_value'];

    $new_rating = $sum/$num;

    $sql = "UPDATE `restaurant` SET `r_rating` = '$new_rating' WHERE `r_id` = '$r_id'";
    $result = mysqli_query($conn , $sql);


    
}
?>

<!DOCTYPE html>
<html>

<head>


    <style>
        .star-rating {
            font-size: 24px;
        }

        .star-option {
            display: none;
        }

        .star-label {
            cursor: pointer;
        }

        .star-label:hover,
        .star-label:hover~.star-label {
            color: #ffc107;
            /* Change the color on hover */
        }
    </style>

    <title>Order Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Order Information</h1>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Order</th>
            <th>Timing</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Update Order</th>
            <th>Feedback</th>

        </tr>

        <!-- Replace this section with PHP code to fetch data and loop through rows -->
        <?php
        // Replace this with your database connection code

        // Replace this with your SQL query to retrieve data from the database
        $sql = "SELECT * FROM `orders` WHERE `user_id` = '$uid' ";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['order_id'] . "</td>";
                echo "<td>" . $row['order'] . "</td>";
                echo "<td>" . $row['dt'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['order_status'] . "</td>";
                $status = $row['order_status'];
                $rate = $row['rating'];
                if ($status == 'Delivered' && $rate == 0) {
                    echo "<th>";
                    echo "<form action='track_order.php' method='post'>";
                    echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                    echo "<input type='hidden' name='r_id' value='" . $row['r_id'] . "'>";
                    echo "<select name='rating'>";
                    echo "<option value='1' " . ($row['order_status'] === '1' ? 'selected' : '') . ">1 &#9733 </option>";
                    echo "<option value='2' " . ($row['order_status'] === '2' ? 'selected' : '') . ">2 &#9733</option>";
                    echo "<option value='3' " . ($row['order_status'] === '3' ? 'selected' : '') . ">3 &#9733</option>";
                    echo "<option value='4' " . ($row['order_status'] === '4' ? 'selected' : '') . ">4 &#9733</option>";
                    echo "<option value='5' " . ($row['order_status'] === '5' ? 'selected' : '') . ">5 &#9733</option>";
                    echo "</select>";
                    echo "<input type='submit' value='rate'>";
                    echo "</form>";
                    echo "</th>";
                } else if ($status == 'Delivered' && $rate != 0) {
                    echo '<th> Feedback recieved </th>';
                } else if ($status != 'Delivered') {
                    echo '<th></th>';
                }
            }
        } else {
            echo "<tr><td colspan='8'>No Orders yet</td></tr>";
        }

        ?>
        <script>
            const select = document.getElementById('rating');
            select.addEventListener('change', (event) => {
                const selectedValue = event.target.value;
                alert(`You rated this item ${selectedValue} stars.`);
            });
        </script>
        <!-- End of PHP section -->
    </table>
</body>

</html>