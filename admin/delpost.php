<?php include '../lib/session.php';
Session::checkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/format.php'; ?>
<?php
$db = new Database();
?>
<?php
if (!isset($_GET['del_id']) || $_GET['del_id']==null) {
 echo "<script>window.location = 'postlist.php';</script>";
}else{
    $delid = $_GET['del_id'];
  
    $getallpost = "SELECT * FROM post_tbl WHERE id='$delid'";
    $getdata = $db->select($getallpost);
    if ($getdata) {
        while($delimage=$getdata->fetch_assoc()){
            $dellink=$delimage['image'];
            unlink($dellink);
        }
    }
    $delsql="DELETE FROM post_tbl WHERE id='$delid'";
    $deldata=$db->delete($delsql);
    if ($deldata) {
        echo "<script>alert('Data deleted successfully.')</script>";
          header('location:postlist.php');
    }else{
         echo "<script>alert('Data not deleted .')</script>";

        header('location:postlist.php');    
    }
}
?>