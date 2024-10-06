<?php 
session_start();
include 'partials/_dbconnect.php';
$rid = $_SESSION['r_id'];
if (!isset($_SESSION['vendorloggedin']) || $_SESSION['vendorloggedin'] != true) {
    header("location: vendor_login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderid = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $sql = "UPDATE `orders` SET `order_status` = '$order_status' WHERE `order_id` = '$orderid'";
    $result = mysqli_query($conn, $sql);
}

// Fetch search keyword and category filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';

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
        .logout{
            margin-left: calc(100% - 20%);
            margin-top: -4%;
        }
    </style>
</head>

<body>
<header class="text-white text-center py-4" style="background: rgb(142,240,226);
background: linear-gradient(90deg, rgba(142,240,226,0.7511379551820728) 0%, rgba(234,241,50,1) 34%, rgba(210,10,227,0.8407738095238095) 100%);">
        <h1>Alimento  <div class="logout"><input  type='submit' class="btn btn-danger" value='LOGOUT'></div></a></h1>
        
    </header>
<br>
<div class="holder">
    <h1>Pending Order</h1>
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
        $sql = "SELECT * FROM orders WHERE r_id = '$rid'AND order_status != 'Delivered' ";
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
    <h1>Menu Information | 
        <a href='add_menu.php'><input type='submit' class="btn  " style="background:#068572;  color:white" value='ADD TO MENU'></a>  
        <a href='edit_menu.php'><input type='submit' class="btn  " style="background:#e77c30; color:white" value='EDIT MENU'></a> 
    </h1>

    <!-- Search and Filter Form -->
    <form method="GET" action="home.php" class="mb-3">
        <input type="text" name="search" placeholder="Search by item name" value="<?php echo htmlspecialchars($search); ?>">
        <select name="category">
            <option value="">All Categories</option>
            <option value="Veg" <?php echo ($category_filter === 'Veg') ? 'selected' : ''; ?>>Veg</option>
            <option value="Non-Veg" <?php echo ($category_filter === 'Non-Veg') ? 'selected' : ''; ?>>Non-Veg</option>
        </select>
        <button type="submit" class="btn btn-secondary">Search/Filter</button>
    </form>

    <table>
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Item Price</th>
            <th>Item Category</th>
        </tr>

        <?php
        // Modify SQL query to support search and filter
        $sql = "SELECT * FROM `menu` WHERE `r_id` = '$rid'";
        
        // If search or filter is applied, add conditions
        if ($search || $category_filter) {
            $sql .= " AND (`m_name` LIKE '%$search%' OR `m_type` LIKE '%$search%')";
            if ($category_filter) {
                $sql .= " AND `m_type` = '$category_filter'";
            }
        }

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['m_id'] . "</td>";
                echo "<td>" . $row['m_name'] . "</td>";
                echo "<td>" . $row['m_price'] . "</td>";
                echo "<td>" . $row['m_type'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No items found</td></tr>";
        }
        ?>
    </table>
</div>
</body>

</html>
