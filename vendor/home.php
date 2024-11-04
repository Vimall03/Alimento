<?php
session_start();
include 'partials/_dbconnect.php';
$rid = $_SESSION['r_id'];
if (!isset($_SESSION['vendorloggedin']) || $_SESSION['vendorloggedin'] != true) {
    header("location: vendor_login.php");
    exit;
}
// echo ($_SESSION['vendorloggedin'] == 1);
$login_status = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderid = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $sql = "UPDATE `orders` SET `order_status` = '$order_status' WHERE `order_id` = '$orderid'";
    $result = mysqli_query($conn, $sql);
}
if (isset($_SESSION['vendorloggedin']) && $_SESSION['vendorloggedin'] == true) {
    $login_status = true;
}
// Fetch search keyword and category filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Order Information</title>

  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
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
          echo '<a href="vendor_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>';
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

    <div class="holder p-5">
        <h1>Pending Order</h1>
        <table class="order-table w-full border-collapse">
            <thead>
                <tr>
                    <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Order ID</th>
                    <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Order</th>
                    <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Name</th>
                    <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Amount</th>
                    <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Phone</th>
                    <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Address</th>
                    <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Update Order</th>
                    <th class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>Order Status</th>
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
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['order_id'] . "</td>";
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['order'] . "</td>";
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['name'] . "</td>";
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['amount'] . "</td>";
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['phone'] . "</td>";
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['address'] . "</td>";

                    // Adding a dropdown to update the order status
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>";
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
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold'>" . $row['order_status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='p-3 border-b-[1px] border-[#ddd] text-center'>No Orders yet</td></tr>";
            }


            ?>
            <!-- End of PHP section -->
        </table>

        <br>
        <br>
        <div class="menu-container flex justify-between">
            <h1>
                Menu Information
            </h1>
            <div class="">
                <a href='add_menu.php'><button class="btn py-[10px] px-5 border-none text-white hover:text-black rounded-md cursor-pointer" style="background-color: #008080;">Add to Menu</button></a>
                <a href='edit_menu.php'><button class=" py-[10px] px-5 border-none text-white hover:text-black rounded-md cursor-pointer" style="background-color: #FF8C00;">Edit Menu</button></a>
            </div>
        </div>

        <!-- Search and Filter Form -->
        <form method="GET" action="home.php" class="mb-5 filters flex gap-[10px]">
            <input type="text" name="search" placeholder="Search by item name" class="p-2 w-[200px] border border-[#ccc] rounded-md"
                value="<?php echo htmlspecialchars($search); ?>">
            <select name="category" class="py-2 px-3 border border-[#ccc] bg-[#777] rounded-md text-white cursor-pointer">
                <option value="">All Categories</option>
                <option value="Veg" <?php echo ($category_filter === 'Veg') ? 'selected' : ''; ?>>Veg</option>
                <option value="Non-Veg" <?php echo ($category_filter === 'Non-Veg') ? 'selected' : ''; ?>>Non-Veg</option>
            </select>
            <button type="submit" class=" py-[10px] px-5 border-none text-white hover:text-black rounded-md cursor-pointer">Search / Filter</button>
        </form>

        <table class="order-table w-full border-collapse">
            <tr>
                <th class="p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold">Item ID</th>
                <th class="p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold">Item Name</th>
                <th class="p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold">Item Price</th>
                <th class="p-3 border-b-[1px] border-[#ddd] text-center bg-[#f5f5f5] font-bold">Item Category</th>
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
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_id'] . "</td>";
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_name'] . "</td>";
                    echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'>" . $row['m_price'] . "</td>";
                    if ($row['m_type'] == "Veg") {
                        echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'> <span class='veg py-1 px-3 bg-green-500 text-white rounded-md'>" . $row['m_type'] . "</span></td>";
                    } else {
                        echo "<td class='p-3 border-b-[1px] border-[#ddd] text-center'> <span class='nonveg py-1 px-3 bg-red-500 text-white rounded-md'>" . $row['m_type'] . "</span></td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='p-3 border-b-[1px] border-[#ddd] text-center'>No items found</td></tr>";
            }
            ?>
        </table>
    </div>
    <script src="../menu.js"></script>
</body>

</html>