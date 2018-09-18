<?php
define('ROOT_PATH',str_repeat("../",substr_count($_SERVER['SCRIPT_NAME'],'/')-1));
require_once 'dbclass.inc.php';
require_once 'pdodb.class.php';

class config{
  public static $db_servers = array(
    'master' => array( 
    'host'   => 'localhost',
    'driver' => 'mysql',
                
    "sadaf_user" => 'user1',
    "sadaf_pass" => 'user1',
    "sadaf_db"   => 'sadaf') 
);
  public static $display_error = true;
  public static $root_path = ROOT_PATH;
  public static $start_page = 'sadaf/login.php';

}

?>
