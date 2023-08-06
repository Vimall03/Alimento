<?php
session_start();
include 'partials/_dbconnect.php';
$rid = $_SESSION['r_id'];
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: vendor_login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderid = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $sql = "UPDATE `orders` SET `order_status` = '$order_status' WHERE `order_id` = '$orderid'";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="vendor_styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <title>Order Information</title>
    <style>
        .holder{
            padding: 20px;
        }
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
<header class="bg-dark text-white text-center py-4">
        <h1>Alimento</h1>
    </header>
<br>
    <div class="holder">
    <h1>Pending Order | <a href='vendor_logout.php'><input type='submit' class="btn btn-danger" value='LOGOUT'></a></h1>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Order</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Update Order</th>
            <th>Order Status</th>
        </tr>

        <!-- Replace this section with PHP code to fetch data and loop through rows -->
        <?php
        // Replace this with your database connection code

        // Replace this with your SQL query to retrieve data from the database
        $sql = "SELECT * FROM `orders` WHERE `r_id` = '$rid'AND `order_status` != 'Delivered' ";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['order_id'] . "</td>";
                echo "<td>" . $row['order'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";

                // Adding a dropdown to update the order status
                echo "<td>";
                echo "<form action='home.php' method='post'>";
                echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                echo "<select name='order_status'>";
                echo "<option value='Preparing' " . ($row['order_status'] === 'Preparing' ? 'selected' : '') . ">Preparing</option>";
                echo "<option value='On the way' " . ($row['order_status'] === 'On the way' ? 'selected' : '') . ">On the way</option>";
                echo "<option value='Delivered' " . ($row['order_status'] === 'Delivered' ? 'selected' : '') . ">Delivered</option>";
                echo "</select>";
                echo "<input type='submit' value='Update'>";
                echo "</form>";
                echo "</td>";

                // Adding the update order button
                echo "<td>" . $row['order_status'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No Orders yet</td></tr>";
        }


        ?>
        <!-- End of PHP section -->
    </table>

<br>
<br>
    <h1>Menu Information | <a href='add_menu.php'><input type='submit' class="btn btn-success" value='ADD TO MENU'></a>  <a href='edit_menu.php'><input type='submit' class=" btn btn-primary" value='EDIT MENU'></a> </h1>

    <table>
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <!-- <th>Item Description</th> -->
            <th>Item Price</th>
            <th>Item Category</th>
        </tr>

        <?php
        // Retrieve data from the menu table
        $sql = "SELECT * FROM `menu` WHERE `r_id` = '$rid'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['m_id'] . "</td>";
                echo "<td>" . $row['m_name'] . "</td>";
                //echo "<td>" . $row['item_description'] . "</td>";
                echo "<td>" . $row['m_price'] . "</td>";
                echo "<td>" . $row['m_type'] . "</td>";
            }
        } else {
            echo "<tr><td colspan='6'>ADD items in the menu to display here</td></tr>";
        }


        ?>
    </table>
    </div>
</body>

</html>