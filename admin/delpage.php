<?php include '../lib/session.php';
Session::checkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php
$db = new Database();
?>
<?php
if (!isset($_GET['delt_id']) || $_GET['delt_id'] == null) {
    echo "<script>window.location = 'index.php';</script>";
} else {
    $delid = $_GET['delt_id'];

    $delsql = "DELETE FROM page WHERE id='$delid'";
    $deldata = $db->delete($delsql);
    if ($deldata) {
        echo "<script>alert('Data deleted successfully.')</script>";
        header('location:index.php');
    } else {
        echo "<script>alert('Data not deleted .')</script>";

        header('location:index.php');
    }
}
?>