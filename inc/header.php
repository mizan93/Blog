<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helpers/format.php'; ?>
<?php
$db = new Database();
$format = new Format();

?>
<?php
//set headers to NOT cache a page
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// Date in the past
//or, if you DO want a file to cache, use:
header("Cache-Control: max-age=2592000");
//30days (60sec * 60min * 24hours * 30days)
?>
<!DOCTYPE html>
<html>

<head>
      <?php include 'scripts/meta.php'; ?>
      <?php include 'scripts/css.php'; ?>
   <?php include 'scripts/js.php'; ?>
    
</head>

<body>
    <div class="headersection templete clear">
        <?php
        $sql = "SELECT * FROM  title_slogan WHERE id='1'";
        $data = $db->select($sql);
        if ($data) {
            while ($result = $data->fetch_assoc()) {

        ?>
                <a href="#">

                    <div class="logo">
                        <img src="admin/<?php echo $result['logo']; ?>" alt="Logo" />
                        <h2><?php echo $result['title']; ?></h2>
                        <p><?php echo $result['slogan']; ?></p>
                    </div>
                </a>
        <?php }
        } ?>
        <div class="social clear">
            <?php
            $sql = "SELECT * FROM  social_tbl WHERE id='1'";
            $data = $db->select($sql);
            if ($data) {
                while ($result = $data->fetch_assoc()) {

            ?>
                    <div class="icon clear">

                        <a href="<?php echo $result['fb'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="<?php echo $result['tw'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href<?php echo $result['ln'] ?> target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href<?php echo $result['gp'] ?> target="_blank"><i class="fa fa-google-plus"></i></a>
                    </div>
            <?php }
            } ?>
            <div class="searchbtn clear">
                <form action="search.php" method="get">
                    <input type="text" name="search" placeholder="Search keyword..." />
                    <input type="submit" name="submit" value="Search" />
                </form>
            </div>
        </div>
    </div>
    <div class="navsection templete">

        <ul>
            <?php
            $path = $_SERVER['SCRIPT_FILENAME'];
            $current_page = basename($path, '.php');

            ?>
            <li><a <?php if ($current_page == 'indext') {
                        echo 'id="active"';
                    } ?> href="Home.php">Home</a></li>
            <?php
            $query = "SELECT * FROM page";
            $pages = $db->select($query);
            if ($pages) {

                while ($result = $pages->fetch_assoc()) {

            ?>
                    <li><a <?php
                            if (isset($_GET['page_id']) && $_GET['page_id'] == $result['id']) {
                                echo 'id="active"';
                            }
                            ?> href="pages.php?page_id=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
            <?php }
            } ?>
            <li><a <?php if ($current_page == 'contact') {
                        echo 'id="active"';
                    } ?> href="contact.php">Contact</a></li>
        </ul>
    </div>