<?php 
header('Content-type: text/css; charset: UTF-8');
header('Cache-Control: must-revalidate');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
$url = $_REQUEST['url']."/css/css3.htc";
$url = str_replace("//","/",$url);
?>
.yt-typo-button.style2.orange{ 
    -pie-background: linear-gradient(#EEFF99, #66EE33);
    behavior:url(<?php echo $url; ?>);
}