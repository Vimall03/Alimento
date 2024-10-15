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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <style>
        body{
            max-width: 1140px;
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
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
        .logout{
            height: 100%;
            display: flex;
            align-items: center;
        }

        .order-table th {
            background-color: #f5f5f5;
            font-weight: bold;
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
        .menu-container{
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        .dataInput{
            padding: 6px;
            border-radius: 8px;
            border: none;
            outline: none;
            
        }
        .dataInput:active, .dataInput:focus{
            border: none;
        }
        .add-item{
            background-color: blue;
            color: white;
            border-radius: 6px;
            outline: none;
            border: none;
            padding: 2px 5px;
        }
        .btn{
            padding: 10px 20px;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="../images/logo/logo.png" alt="">
        
        <form action="vendor_logout.php" class="logout"><input  type='submit' class="btn btn-danger" value='LOGOUT'></form>
    </div>
    <br>

    <div class="menu-container">
        <h1>
            Menu Information
        </h1>
        <div class="btn-container">
            <a href='edit_menu.php'><button class="btn" style="background-color: #008080;">EDIT</button></a>  
            <a href='home.php'><button class="btn" style="background-color: #FF8C00;">BACK</button></a> 
        </div>
    </div>

    <table class="order-table">
        <thead>
            <th>Item ID</th>
            <th>Item Name</th>
            <!-- <th>Item Description</th> -->
            <th>Item Price</th>
            <th>Item Category</th>
        </thead>

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
                if($row['m_type'] == "Veg"){
                    echo "<td> <span class='veg'>" . $row['m_type'] . "</span></td>";
                } else {
                    echo "<td> <span class='nonveg'>" . $row['m_type'] . "</span></td>";
                }
            }
        } else {
            echo "<tr><td colspan='6'>ADD items in the menu to display here</td></tr>";
        }

    
        ?>
    </table>
    
    <h1>Add to Menu </h1>
    <table class="order-table">
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
                echo "<td><input class='dataInput' required type='text' placeholder='Name of item' name='m_name' value=''><br></td>";
                //echo "<td>" . $row['it</td>";
                echo "<td><input class='dataInput' required type='number' placeholder='Price' name='m_price' value=''><br></td>";
                

                echo "<td>Category: <select name='m_type'>";
                echo "<option value='Veg' " . ($row['order_status'] === 'Veg' ? 'selected' : '') . ">Veg</option>";
                echo "<option value='Non-Veg' " . ($row['order_status'] === 'Non-Veg' ? 'selected' : '') . ">Non-Veg</option>";
                echo "</select>";

                echo "<td><input class='add-item' required type='submit' value='Add'></td>";
                echo "</form>";
                echo "</tr>";
        $conn->close();
        ?>



    </table>
</body>

</html>