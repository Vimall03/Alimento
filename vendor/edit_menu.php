<?php
session_start();
include 'partials/_dbconnect.php';
$rid = $_SESSION['r_id'];

// Check if the user is logged in or redirect to the login page
if (!isset($_SESSION['vendorloggedin']) || $_SESSION['vendorloggedin'] != true) {
    header("location: user_login.php");
    exit;
}

// Update the menu item if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $m_id = $_POST['m_id'];
    $m_name = $_POST['m_name'];
    //$m_description = $_POST['item_description'];
    $m_price = $_POST['m_price'];
    $m_type = $_POST['m_type'];

    $sql = "UPDATE `menu` SET `m_name` = '$m_name', 
            `m_price` = '$m_price', `m_type` = '$m_type' WHERE `m_id` = '$m_id'";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
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

<h1>Menu Information | <a href='add_menu.php'><input  type='submit' value='ADD'></a> <a class="m-4" href='home.php'><input type='submit' value='BACK'></a> </h1>


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
    





    <h1>EDIT Menu </h1>
    <table>
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <!-- <th>Item Description</th> -->
            <th>Item Price</th>
            <th>Item Category</th>
            <th>Update Item</th>
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

                // Adding a form to update the item
                echo "<td>";
                echo "<form action='edit_menu.php' method='post'>";
                echo "<input type='hidden' name='m_id' value='" . $row['m_id'] . "'>";
                echo "Name: <input type='text' name='m_name' value='" . $row['m_name'] . "'><br>";
                //echo "Description: <input type='text' name='item_description' value='" . $row['item_description'] . "'><br>";
                echo "Price: <input type='number' name='m_price' value='" . $row['m_price'] . "'><br>";
                echo "Category: <input type='text' name='m_type' value='" . $row['m_type'] . "'><br>";

                echo "Category: <select name='m_type'>";
                echo "<option value='Veg' " . ($row['order_status'] === 'Veg' ? 'selected' : '') . ">Veg</option>";
                echo "<option value='Non-Veg' " . ($row['order_status'] === 'Non-Veg' ? 'selected' : '') . ">Non-Veg</option>";
                echo "</select>";

                echo "<input type='submit' value='Update'>";
                echo "</form>";
                echo "<form action='delete_menu.php' method= 'post'>";
                echo "<input type='hidden' name='delete_item' value='" . $row['m_id'] . "'><br>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No items in the menu yet</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
