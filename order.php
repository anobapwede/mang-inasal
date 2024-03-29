<?php include('partials-front/menu.php');
?>

<?php
//check wether food is set or not
if (isset($_GET['food_id'])) {
    //get the food id and details of the selected food
    $food_id = $_GET['food_id'];
    //get the details of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //count the rows
    $count = mysqli_num_rows($res);
    //check wether the data is available or not
    if ($count == 1) {
        //we have data
        //get the data from database
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
        $description = $row['description'];

    } else {
        //foods not available
        //redirect to homepage
        header('location:' . SITEURL);
    }
} else {
    //redirect to homepage
    header('location:' . SITEURL);
}
?>
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    // Check whether the image is available or not
                    if ($image_name == "") {
                        // Image not available
                        echo "<div class='error'>Image Not Available</div>";
                    } else {
                        // Image available
                        ?>
                        <img src="<?php echo SITEURL; ?>food/<?php echo $image_name ?>" class="img-responsive img-curve">
                        <?php
                    }

                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3>
                        <?php echo $title; ?>
                    </h3>
                    <p class="food-price">
                        <?php echo $price; ?>
                    </p>

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full_name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>
                <input type="hidden" name="food" value="<?php echo $title; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        //check wether submit button is click or not
        if (isset($_POST['submit'])) {
            //get all the details from form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty; //total = price x qty
            $order_date = date("Y-m-d h:sa"); //order date
            $status = "ordered"; //ordered, on delivery, delivered, cancelled
            $customer_name = $_POST['full_name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            //save order in database
            //create sql to save data
        

            // ...
        
            $sql2 = "INSERT INTO `tbl_order` SET
                `food`='$food',
                `price`='$price',
                `qty`=$qty,
                `total`='$total',
                `order_date`='$order_date',  -- Add single quotes around $order_date
                `status`='$status',
                `customer_name`='$customer_name',
                `customer_contact`='$customer_contact',
                `customer_email`='$customer_email',
                `customer_address`='$customer_address'
            ";


            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            // check for query execution errors
            if ($res2==true) {
                // query executed and order saved
                $_SESSION['order'] = "<div class='success text-center'>Food Order Successfully.</div>";
                header('location:' . SITEURL);
            } else {
                // failed to save order
                $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food:</div>";
                header('location:' . SITEURL);
            }
        }
        ?>

    </div>
</section>

<?php include('partials-front/footer.php'); ?>