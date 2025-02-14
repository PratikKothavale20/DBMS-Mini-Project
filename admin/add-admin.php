<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br/><br/>

        <?php
            if(isset($_SESSION['add']))//checking whether the session is set or not
            {
                echo $_SESSION['add']; //display session msg if set
                unset($_SESSION['add']); //removesession msg
            }
        ?>
        

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your  Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your  Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>




<?php include('partials/footer.php');?>


<?php 
    // process the value from form and save it in database
    // check whether the button is clicked or not
    if(isset($_POST['submit']))
    {
        // button clicked
        // echo "Button Clicked";


        //1. get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption with md5

        //2. SQl query to save data into database 
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

            // echo $sql;

            
            //3.executing query and saving data into database
             $res = mysqli_query($conn, $sql) or die(mysqli_error()); 

             //4. check whether the (query is executed) data is inserted or not and appropriate msg
             if($res==TRUE)
             {
                //DATA INSERTED
                // echo "DATA INSERTED";
                // create a session variable to display msg
                $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
                //redirect page to manage admin
                header("location:".SITEURL.'admin/manage-admin.php');
             }
             else
             {
                //date not inserted
                // echo "failed to insert";
                 // create a session variable to display msg
                 $_SESSION['add'] = "<div class= 'error'>Failed to Add Admin. Try Again Later.</div>";
                 //redirect page to add admin
                 header("location:".SITEURL.'admin/add-admin.php');
             }
    }
    
?>