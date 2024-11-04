<?php
session_start();
include 'partials/_dbconnect.php';
$rid = $_SESSION['r_id'];

// Check if the user is logged in or redirect to the login page
if (!isset($_SESSION['vendorloggedin']) || $_SESSION['vendorloggedin'] != true) {
  $login_status = false;
  header("location: vendor_login.php");
  exit;
}else{
  $login_status = true;

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
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $login_status = true;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Menu Information</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"> -->
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap icons  -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <!-- <link rel="stylesheet" href="main.css"> -->
    <link rel="stylesheet" href="../output.css">
</head>

<body class="max-w-[1140px] m-auto">
    <nav
        class="hidden  lg:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
        <a href="index.php"><img src="../images/logo/logo.webp" alt="logo" class="w-36"></a>
        <div class="flex sm:gap-1 md:gap-2">
           
        </div>
        <div class="flex">

            <div class="mx-3">

                <?php if ($login_status == true) {
                    echo '<a href="vendor_logout.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
                } else {
                    echo '<a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>';
                } ?>
            </div>

    </nav>

    <!-- nav for small device  -->
    <div class="flex items-center justify-between max-w-7xl mx-auto font-poppins bg-white py-3 px-5 lg:hidden">
        <a href="index.php"><img src="../images/logo/logo.webp" alt="logo" class="w-36 "></a>
        <i class="bi bi-list menu select-none text-3xl"></i>
    </div>
    <div class="bg-gray-200 w-full top-5 font-poppins overflow-hidden px-5 py-3 hidden lg:hidden mb-5" id="nav-items">
        <div class="flex flex-col gap-4">
            <a href="#"
                class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Restaurants</a>
            <a href="new_track_order.php"
                class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Orders</a>
            <a href="#"
                class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Contact</a>
            <?php if ($login_status == true) {
                echo '<a href="profile.php" class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Account</a>';
            } ?>
            <div>
                <h2 class="text-base text-gray-400 mt-3">User actions</h2>
                <div class="h-[1px] bg-gray-300 w-full"></div>
            </div>
            <?php if ($login_status == true) {
                echo '<a href="vendor_logout.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
            } else {
                echo '<a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>';
            }
            ?>
        </div>
    </div>

    <div class="menu-container py-2 flex justify-between items-center">
        <h1>
            Menu Information
        </h1>
        <div class="btn-container">
            <a href='edit_menu.php'><button class="btn py-[10px] px-5 border-none text-white rounded-md cursor-pointer hover:text-black" style="background-color: #008080;">EDIT</button></a>
            <a href='home.php'><button class="btn py-[10px] px-5 border-none text-white rounded-md cursor-pointer hover:text-black" style="background-color: #FF8C00;">BACK</button></a>
        </div>
    </div>

    <table class="order-table w-full border-collapse">
        <thead>
            <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Item ID</th>
            <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Item Name</th>
            <!-- <th>Item Description</th> -->
            <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Item Price</th>
            <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Item Category</th>
        </thead>

        <?php
        // Retrieve data from the menu table
        $sql = "SELECT * FROM `menu` WHERE `r_id` = '$rid'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_id'] . "</td>";
                echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_name'] . "</td>";
                //echo "<td>" . $row['item_description'] . "</td>";
                echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_price'] . "</td>";
                if ($row['m_type'] == "Veg") {
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'> <span class='veg py-1 px-3 bg-green-500 text-white rounded-md'>" . $row['m_type'] . "</span></td>";
                } else {
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'> <span class='nonveg py-1 px-3 bg-red-500 text-white rounded-md'>" . $row['m_type'] . "</span></td>";
                }
            }
        } else {
            echo "<tr><td colspan='6' class='p-3 border-b-[1px] border-[#ddd] text-center'>ADD items in the menu to display here</td></tr>";
        }


        ?>
    </table>

    <h1 class="py-4">Add to Menu </h1>
    <table class="order-table w-full border-collapse">
        <tr>
            <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Item ID</th>
            <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Item Name</th>
            <!-- <th>Item Description</th> -->
            <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Item Price</th>
            <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Item Category</th>
            <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Update Item</th>
        </tr>

        <?php
        // Retrieve data from the menu table
        
        echo "<tr>";
        echo "<form action='add_menu.php' method='post'>";
        echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'><input required type='hidden' name='m_id' value=''> </td>";
        echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'><input class='dataInput p-[6px] rounded-lg border-none outline-none active:border-none focus:border-none' required type='text' placeholder='Name of item' name='m_name' value=''><br></td>";
        //echo "<td>" . $row['it</td>";
        echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'><input class='dataInput p-[6px] rounded-lg border-none outline-none active:border-none focus:border-none' required type='number' placeholder='Price' name='m_price' value=''><br></td>";


        echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>Category: <select name='m_type'>";
        echo "<option value='Veg' " . ($row['order_status'] === 'Veg' ? 'selected' : '') . ">Veg</option>";
        echo "<option value='Non-Veg' " . ($row['order_status'] === 'Non-Veg' ? 'selected' : '') . ">Non-Veg</option>";
        echo "</select>";

        echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'><input class='add-item bg-blue-500 text-white rounded-md outline-none border-none py-[2px] px-[5px]' required type='submit' value='Add'></td>";
        echo "</form>";
        echo "</tr>";
        $conn->close();
        ?>
    </table>
    <script src="../menu.js"></script>
</body>

</html>