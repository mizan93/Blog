<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php 
if (Session::get('userRole')!=0) {
 echo "<script>window.location = 'index.php';</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $username = $format->validation($_POST['username']);
                $password = $format->validation(md5($_POST['password']));
                $role = $format->validation($_POST['role']);
                $email = $format->validation($_POST['email']);
               

                $username1 = mysqli_real_escape_string($db->link, $username);
                $password1 = mysqli_real_escape_string($db->link, $password);
                $role1 = mysqli_real_escape_string($db->link, $role);
                $email1 = mysqli_real_escape_string($db->link, $email);
                if ($username1 == '' || $password1 =='' || $role1 =='' || $email== '') {
                    echo '<span class="error">Field Must not be empty!</span>';
                }
                    else{
                    $userlquery = "SELECT * FROM user_tbl  WHERE username='$username' LIMIT 1";
                    $usercheck = $db->select($userlquery);
                    if ($usercheck) {
                        echo '<span class="error">username already exist !</span>';
                    }
                   
              
                else{
               $mailquery="SELECT * FROM user_tbl  WHERE email='$email' LIMIT 1";
               $mailcheck=$db->select($mailquery);
               if ($mailcheck) {
                    echo '<span class="error">Email already exist !</span>';

               }
                
                else {
                    $sql = "INSERT INTO user_tbl (username,password,role,email) VALUES ('$username1','$password1','$role1','$email1') ";
                    $insert_data = $db->insert($sql);
                    if ($insert_data) {
                        echo '<span class="success">User created succesfully!</span><a href=userlist.php>Go to Userlist</a>';
                    } else {
                        echo '<span class="error">User not created !</span>';
                    }
                } }
            }
        }
            ?>
            <form action="adduser.php" method="post">
                <table class="form">
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text" name="username" placeholder="Enter UserName..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Email..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>User Role</td>
                        <td>
                            <select id="select" name="role">
                                <option >Select User Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php' ?>