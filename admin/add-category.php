<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!-- Add category form starts -->
         <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
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
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">
                    </td>
                </tr>
            </table>
         </form>
        <!-- Add category form ends -->

        <?php
            //check whether the  submit btn is clicked or not
            if(isset($_POST['submit']))
            {
                // echo "clicked";

                // 1. get the value from category form 
                $title = $_POST['title'];

                // for radio input, we need to check btn is selected or not
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

                // check whether the image is selected or not and set the value for image name accordingly
                // print_r($_FILES['image']);

                // die(); //break the code here

                if(isset($_FILES['image']['name']))
                {
                    // upload the image 
                    // to upload image we need image name,source path and destination path
                    $image_name = $_FILES['image']['name'];

                    // upload image only if selected  
                    if($image_name != "")
                    {

                    
                        // auto rename our image
                        // get the extension of our image(jpg,png,gif) e.g.- "food1.jpg"
                        $ext = end(explode('.',$image_name));

                        // rename the image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext; //e.g.- Food_Category_567.jpg


                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        // check whether the image is uploaded or not 
                        // and if the image is not uploaded then we will stop process and redirect with error msg
                        if($upload==false)
                        {
                            // set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.<?div>";
                            // redirect to add category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            // stop the process
                            die();
                        }
                    }
                }
                else{
                    // dont upload image and set image_name value as blank
                    $image_name = "";
                }

                // 2. create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'";

                // 3. execute the query and save in database
                $res = mysqli_query($conn,$sql);

                // 4. check whether the query executed or not and data added or not
                if($res==true)
                {
                    // query executed and add category
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    // falied to add category
                    $_SESSION['add'] = "<div class='error'>failed to Add Category.</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>
