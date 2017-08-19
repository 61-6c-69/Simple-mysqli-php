<?php
//config
define('HOST','LOCALHOST');
define('USER','ROOT');
define('PASS','DB-PASS');
define('DB','TEST_DB');

require 'mysqli.php';

$db=new DBM();

//select-insert-update-delete... 
$db->QUERY('SELECT * FROM USERS WHERE ID=?',array('i',10));

$num=$db->NUM_ROWS();
$fet=$db->FETCH_ARRAY();
$db->CLEAN_FETCH_ARRAY();
$w_fet=$db->W_FETCH_ARRAY(array('username','password'));

for($i=0;$i<=count($w_fet)-1;$i++){ 
  echo $w_fet[$i]['username'];
}

?>
