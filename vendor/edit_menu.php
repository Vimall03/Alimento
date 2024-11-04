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

    $sql = "UPDATE `menu` SET `m_name` = '$m_name', 
            `m_price` = '$m_price', `m_type` = '$m_type' WHERE `m_id` = '$m_id'";
    $result = mysqli_query($conn, $sql);
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
    <br>

    <div class="menu-container flex justify-between items-center my-2">
        <h1>
            Menu Information
        </h1>
        <div class="btn-container">
            <a href='add_menu.php'><button class="btn border-none py-[10px] px-5 text-white rounded-md cursor-pointer hover:text-black" style="background-color: #008080;">ADD</button></a>  
            <a href='home.php'><button class="btn border-none py-[10px] px-5 text-white rounded-md cursor-pointer hover:text-black" style="background-color: #FF8C00;">BACK</button></a> 
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
                if($row['m_type'] == "Veg"){
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

    <h1 class="py-4">Edit Menu </h1>
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
        $sql = "SELECT * FROM `menu` WHERE `r_id` = '$rid'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_id'] . "</td>";
                echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_name'] . "</td>";
                //echo "<td>" . $row['item_description'] . "</td>";
                echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_price'] . "</td>";
                echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_type'] . "</td>";

                // Adding a form to update the item
                echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>";
                echo "<div class='button-container flex gap-[10px] justify-center'>";
                echo "<button class='update bg-transparent border-none h-8 w-8 hover:cursor-pointer' onclick=\"toggleUpdateForm('" . $row['m_id'] . "')\"><img class='h-[90%]' src='https://img.icons8.com/?size=100&id=6697&format=png&color=000000'></button>";

                echo "<div id='updateForm" . $row['m_id'] . "' class='update-form absolute mt-[10px] p-[10px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#f9f9f9] border border-[#ddd] rounded-md' style='display: none;'>";
                echo "<button class='close absolute bg-transparent top-[10px] right-[10px] text-red-500 border-none hover:cursor-pointer' onclick=\"toggleUpdateForm('" . $row['m_id'] . "')\">X</button>";
                echo "<form action='edit_menu.php' method='post'>";
                echo "<input type='hidden' name='m_id' value='" . $row['m_id'] . "'>";
                echo "Name: <input type='text' class='w-full p-2 my-1 border border-[#ccc] rounded-md box-border'  name='m_name' value='" . $row['m_name'] . "'><br>";
                echo "Price: <input type='number' class='w-full p-2 my-1 border border-[#ccc] rounded-md box-border'  name='m_price' value='" . $row['m_price'] . "'><br>";
                echo "Category: <select name='m_type' class='w-full p-2 my-1 border border-[#ccc] rounded-md box-border' >";
                echo "<option value='Veg' " . ($row['m_type'] === 'Veg' ? 'selected' : '') . ">Veg</option>";
                echo "<option value='Non-Veg' " . ($row['m_type'] === 'Non-Veg' ? 'selected' : '') . ">Non-Veg</option>";
                echo "</select><br>";
                echo "<input type='submit' class='py-2 px-4 text-white border-none rounded-md cursor-pointer hover:bg-[#218838]' value='Update'>";
                echo "</form>";
                echo "</div>";

                echo "<form action='delete_menu.php' class='deleteForm flex justify-center items-center' method= 'post'>";
                echo "<input type='hidden' name='delete_item' value='" . $row['m_id'] . "'><br>";
                echo "<button type='submit' class='delete bg-transparent border-none h-8 w-8 hover:cursor-pointer'> <img class='h-[90%]' src='https://img.icons8.com/?size=100&id=1oFCDPb4GGqp&format=png&color=000000'> </button>";
                echo "</form>";
                echo "</div>";
                echo "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='p-3 border-b-[1px] border-[#ddd] text-center'>No items in the menu yet</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <script>
        function toggleUpdateForm(id) {
            var form = document.getElementById('updateForm' + id);
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
    <script src="../menu.js"></script>
</body>
</html>
