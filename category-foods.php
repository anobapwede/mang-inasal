<?php include('partials-front/menu.php');
?>

<?php
//check wether id is passed or not
if (isset($_GET['category_id'])) {
    //category id is set and get the id
    $category_id = $_GET['category_id'];
    //get the category title based on category id
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    //execute the query 
    $res = mysqli_query($conn, $sql);
    //get the value from database
    $row = mysqli_fetch_assoc($res);
    //get the title
    $category_title = $row['title'];
} else {
    //category not pass
    //redirect to home page
    header('location:' . SITEURL);
}
?>

<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"
                <?php echo $category_title; ?>"
            </a></h2>
    </div>
</section>


<section class="food-menu">
    <div class="container">
        <h2 class="text-center" style="color: white;">Food Menu</h2>
        <?php
        //create sql query to get foods based on selected category
        $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
        //execute the query
        $res2 = mysqli_query($conn, $sql2);
        //count the rows
        $count2 = mysqli_num_rows($res2);
        //check wether food is available or not
        if ($count2 > 0) {
            //food is available
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
                ?>
                
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                         // Check whether the image is available or not
                         if ($image_name == "") {
                            // Image not available
                            echo "<div class='error'>Image Not Available</div>";
                        } else {
                            // Image available
                            ?>
                            <img src="<?php echo SITEURL; ?>food/<?php echo $image_name ?>" class="img-responsive">
                            <?php
                        }
                        ?>
                        
                    </div>

                    <div class="food-menu-desc">
                            <h4><?php echo $title ?></h4>
                            <p class="food-price"><?php echo $price ?></p>
                            <p class="food-detail"><?php echo $description ?></p>
                            <br>
                            <a href="<?php echo SITEURL?>order.php?food_id=<?php echo$id ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
            }
        } else {
            //food not available
            echo "<div class='error'>Food Not Available</div>";
        }

        ?>


        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>