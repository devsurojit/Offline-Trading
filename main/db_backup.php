<?php
ob_start();
session_start();
require_once('Include/header.php');
require_once('Include/slider.php');
require_once('Include/topbar.php');
require_once('../config.php');
if(isset($_SESSION['user_id'])){
    include_once('Mysqldump.php');
    $sql = "Select Path_Name From mst_config;";
    $result = $conn->query($sql);
    $data = mysqli_fetch_assoc($result);
    $path = $data['Path_Name'];

    $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host='.$sname.';dbname='.$db_name.'', ''. $unmae .'', ''. $password .'');

    $dump->start($path.'\sysco_trade_'.date("Y-m-d").'.sql');
?>


<?php
require_once('Include/footer.php');
?>
<script>
simple_alert('success','Backup Create Successfully..','success');
window.href ="dashboard";
</script>
<?php
}
else{
    header('location:../login');
}
?>