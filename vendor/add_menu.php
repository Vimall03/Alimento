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
    $sql = "INSERT INTO `menu` (`r_id`, `m_name`, `m_price`, `m_type`) 
                    VALUES ('$rid', '$m_name', '$m_price', '$m_type');";
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
<h1>Menu Information | <a href='edit_menu.php'><input type='submit' value='EDIT'></a></h1>

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
    
    <h1>Add to Menu </h1>
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
        
                echo "<tr>";
                echo "<form action='add_menu.php' method='post'>";
                echo "<td><input required type='hidden' name='m_id' value=''> </td>";
                echo "<td>Name: <input required type='text' name='m_name' value=''><br></td>";
                //echo "<td>" . $row['it</td>";
                echo "<td>Price: <input required type='number' name='m_price' value=''><br></td>";
                

                echo "<td>Category: <select name='m_type'>";
                echo "<option value='Veg' " . ($row['order_status'] === 'Veg' ? 'selected' : '') . ">Veg</option>";
                echo "<option value='Non-Veg' " . ($row['order_status'] === 'Non-Veg' ? 'selected' : '') . ">Non-Veg</option>";
                echo "</select>";

                echo "<td><input required type='submit' value='Update'></td>";
                echo "</form>";
                echo "</tr>";
        $conn->close();
        ?>



    </table>
</body>

</html>