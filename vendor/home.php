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
        body{
            max-width: 1140px;
            margin: auto;
        }
        .header{
            display: flex;
            justify-content: space-between;
            height: 10vh;
            margin: 10px 0;
            border-bottom: 2px solid maroon;
        }
        .header img{
            height: 100%;
        }
        .logout{
            height: 100%;
            display: flex;
            align-items: center;
        }
        .holder{
            padding: 20px;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-table th,
        .order-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .order-table th {
        background-color: #f5f5f5;
        font-weight: bold;
        }

        .menu-container{
            display: flex;
            justify-content: space-between;
        }
        .btn{
            padding: 10px 20px;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover{
            color: black;
        }
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filters input[type="text"] {
            padding: 8px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .filters select,
        .filters button {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #777;
            color: white;
            cursor: pointer;
        }
        .veg{
            padding: 4px 12px;
            background: green;
            color: white;
            border-radius: 6px;
        }
        .nonveg{
            padding: 4px 12px;
            background: red;
            color: white;
            border-radius: 6px;
        }
    </style>
</head>

<body>
<div class="header">
    <img src="../images/logo/logo.png" alt="">
    
    <form action="vendor_logout.php" class="logout"><input  type='submit' class="btn btn-danger" value='LOGOUT'></form>
</div>
<br>

<div class="holder">
    <h1>Pending Order</h1>
    <table class="order-table">
    <thead>
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
    </thead>

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
    <div class="menu-container">
        <h1>
            Menu Information
        </h1>
        <div class="">
            <a href='add_menu.php'><button class="btn" style="background-color: #008080;">Add to Menu</button></a>  
            <a href='edit_menu.php'><button class="btn" style="background-color: #FF8C00;">Edit Menu</button></a> 
        </div>
    </div>

    <!-- Search and Filter Form -->
    <form method="GET" action="home.php" class="mb-3 filters">
        <input type="text" name="search" placeholder="Search by item name" value="<?php echo htmlspecialchars($search); ?>">
        <select name="category">
            <option value="">All Categories</option>
            <option value="Veg" <?php echo ($category_filter === 'Veg') ? 'selected' : ''; ?>>Veg</option>
            <option value="Non-Veg" <?php echo ($category_filter === 'Non-Veg') ? 'selected' : ''; ?>>Non-Veg</option>
        </select>
        <button type="submit" class="btn btn-secondary">Search / Filter</button>
    </form>

    <table class="order-table">
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
                if($row['m_type'] == "Veg"){
                    echo "<td> <span class='veg'>" . $row['m_type'] . "</span></td>";
                } else {
                    echo "<td> <span class='nonveg'>" . $row['m_type'] . "</span></td>";
                }
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
