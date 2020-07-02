<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Page</h2>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = ($_POST['name']);
            $body = ($_POST['body']);
            $userid = ($_POST['userid']);
            $name = mysqli_real_escape_string($db->link,  $name);
            $body = mysqli_real_escape_string($db->link, $body);
            $userid = mysqli_real_escape_string($db->link, $userid);


            if (
                $name == "" || $body == ""
            ) {
                echo '<span class="error">Field must not  be empty !</span>';
            } else {
                $sql = "INSERT INTO page (name,body) 
                VALUES('$name','$body')";
                $inserted_rows = $db->insert($sql);
                if ($inserted_rows) {
                    echo "<span class='success'>Page created Successfully.
     </span>";
                } else {
                    echo "<span class='error'>Page Not created !</span>";
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="post">
                <table class="form">

                    <tr>
                        <td>
                            <label>name</label>
                        </td>
                        <td>
                            <input name="name" type="text" placeholder="Enter Post Title..." class="medium" />
                            <input name="userid" type="hidden" value="<?php echo Session::get('pageuser'); ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>body</label>
                        </td>
                        <td>
                            <textarea name="body" class="tinymce"></textarea>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php' ?>