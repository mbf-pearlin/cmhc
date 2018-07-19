<?php
global $_POST;
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0].'wp-load.php';

$cookie_name = "cook_pol";
$cookie_value = "1";
setcookie('cook_pol', 'no', time() + (86400 * 30), "/"); // 86400 = 1 day
    
if($_COOKIE['cook_pol']=='no') {
     echo 2;
} else {
     echo 1;
}

?>