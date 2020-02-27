<?php 
$dbconn = pg_connect(getenv("postgres://ihhieqvwqxhpov:3f34f2dde2ce1431743aa5e45760e95e8880eb552b86d9263b934acb8b8a92d2 @ ec2-3-213-192-58.compute-1.amazonaws.com : 5432 / d62v390lqlrs
")); 
  
if($dbconn){
    echo "Connected established". pg_host($dbconn); 
}else{
    echo "Somethng went wrong.";
}

?>
 
