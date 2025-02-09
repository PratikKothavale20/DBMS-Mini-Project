<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
             if(isset($_SESSION['upload']))
             {
                 echo $_SESSION['upload'];
                 unset($_SESSION['upload']);
             }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Title of the Food">
                </td>   
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">

                    <?php
                        // create php code to display categories from db
                        // 1. create sql query to get all active categories from db
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        
                        // execute query
                        $res = mysqli_query($conn,$sql);

                        // count rows to check whether we have category or no 
                        $count = mysqli_num_rows($res);

                        // check if count is greater than 0, we have categories 
                        // else we dont have categories
                        if($count>0)
                        {
                            // we have categories
                            while($row=mysqli_fetch_assoc($res)){
                                // get the details of categories
                                $id = $row['id'];
                                $title = $row['title'];
                                
                                ?>
                                    <option value="<?php echo $id; ?> "><?php echo $title;?></option>
                                <?php

                            }
                        }
                        else{
                            // we dont have categories
                            ?>
                                <option value="0">No Category Found.</option>
                            <?php
                        }

                        // 2. display on dropdown
                    ?>
                        
                    </select>
                </td>
            </tr>

            <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No                  
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No                  
                    </td>
                </tr>

                <tr>
                    <td colspan="7">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
        </table>

        </form>

        <?php
            // check button is clidcked or not
            if(isset($_POST['submit']))
            {
                // add food in database
                // echo "clicked";

                // 1. get data from form
                $title = $_POST['title'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // check radion btn for featured and active are checked or not
                // for featured
                if(isset($_POST['featured']))
                {
                    // get value from form
                    $featured = $_POST['featured'];
                }
                else{
                    // set deafault value
                    $featured = "No";
                }

                // for active
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                // 2. upload image if selected
                // check select image is clicked or not and upload image only if image selected
                if(isset($_FILES['image']['name']))
                {
                    // get details of selected image 
                    $image_name = $_FILES['image']['name'];

                    // check image is selected or not and upload image only if selected  
                    if($image_name != "")
                    {

                        // image is selected
                        //A. rename the image
                        // get the extension of our image(jpg,png,gif) e.g.- "food1.jpg"
                        $ext = end(explode('.',$image_name));

                        
                        $image_name = "Food_Name_".rand(000,999).'.'.$ext; //e.g.- Food_Name_567.jpg

                        // B. upload the image
                        // get source path(current location of image)
                        $src = $_FILES['image']['tmp_name'];

                        // destination path(image to be uploaded)
                        $dst = "../images/food/".$image_name;

                        // and last upload the food image
                        $upload = move_uploaded_file($src,$dst);

                        // check whether the image is uploaded or not 
                        // and if the image is not uploaded then we will stop process and redirect with error msg
                        if($upload==false)
                        {
                            // failed to upload image
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.<?div>";
                            // redirect to add category page
                            header('location:'.SITEURL.'admin/add-food.php');
                            // stop the process
                            die();
                        }
                    }
                }
                else{
                    // dont upload image and set image_name value as blank
                    $image_name = "";
                }

                // 3. insert into DB
                // create sql query to insert category into database
                $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'";

                // 3. execute the query and save in database
                $res2 = mysqli_query($conn,$sql2);

                // 4. redirect with msg to manage food page
                // check whether the query executed or not and data added or not
                if($res2==true)
                {
                    // query executed and add food
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    // falied to add food
                    $_SESSION['add'] = "<div class='error'>failed to Add Food.</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-food.php');
                }  
            }
        ?>

    </div>
</div>



<?php include('partials/footer.php'); ?>