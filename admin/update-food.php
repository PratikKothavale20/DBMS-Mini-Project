<?php include('partials/menu.php');?>

<?php 
    // chek whether id is set or not
    if(isset($_GET['id']))
    {
        // get the id and all other details
        // echo "getting the  data";
        $id = $_GET['id'];

        // create sql query to get all details
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        // execute the query
        $res2 = mysqli_query($conn,$sql2);

        // count the rows to check whether id is valid or not
        $count = mysqli_num_rows($res2);

        // get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        if($count==1)
        {
            // get all data
            $title = $row2['title'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        }
        else
        {
            // redirect to manage food with session msg
            $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }
    else
    {
        // redirect to manage category
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                           if($current_image != "")
                           {
                                // display the image
                                ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>"  width="100px">
                                <?php
                           }
                           else
                           {
                                // display msg
                                echo "<div class='error'>Image not Available.</div>";
                           }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
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
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    // get the details of categories
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    
                                    ?>
                                        <option <?php if($current_category==$category_id){echo "selected";}?>  value="<?php echo $category_id;?> "><?php echo $category_title;?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                // we dont have categories
                                ?>
                                    <option value="0">No Category Found.</option>
                                <?php
                            }
                        ?>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>            
            
            </table>

        </form>
        <?php
            if(isset($_POST['submit']))
            {
                // echo "clicked";
                // 1. get all the values from the form 
                $id = $_POST['id'];
                $title = $_POST['title'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];


                // 2. upload image if selected 
                // check whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    // get image details
                    $image_name = $_FILES['image']['name'];

                    // check image is available or not
                    if($image_name != "")
                    {
                        // image available
                        //A. upload new image

                        // auto rename our image
                        // get the extension of our image(jpg,png,gif) e.g.- "food1.jpg"
                        $ext =  end(explode('.',$image_name));

                        // rename the image
                        $image_name = "Food_Name_".rand(000,999).'.'.$ext; //e.g.- Food_Name_567.jpg

                        // get source path and destination path
                        $src_path = $_FILES['image']['tmp_name'];

                        $dest_path = "../images/food/".$image_name;

                        // upload the image
                        $upload = move_uploaded_file($src_path,$dest_path);

                        // check whether the image is uploaded or not 
                        // and if the image is not uploaded then we will stop process and redirect with error msg
                        if($upload==false)
                        {
                            // set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image.<?div>";
                            // redirect to add category page
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();// stop the process
                        }
                        
                        // 3. remove image if new image is uploaded and current image exists
                        // B. remove current image if available
                        if($current_image != "")
                        {
                            // current image is available
                            // remove image 
                            $remove_path = "../images/food/".$current_image;
                        
                            $remove = unlink($remove_path);
    
                            // check image removed or not
                            // if failed to remove : display msg & stop the process
                            if($remove ==false)
                            {
                                // failed to remove image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to Remove current Image.</div>";
                                // redirect to manage food page
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die(); //stop the prpocess
                            }
                        }   
                    }
                    else
                    {
                        $image_name = $current_image;
                    }       
                }
                else
                {
                    $image_name = $current_image;
                }

                // 4. update food in database
                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id ";

                // execute the query
                $res3 = mysqli_query($conn,$sql3);

                // redirect to manage food page
                // check whether query executed or not
                if($res3==true)
                {
                    // food updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    // redirect
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    // failed to update food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    // redirect
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>