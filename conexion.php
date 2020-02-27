<?php 
    $host = "ec2-3-213-192-58.compute-1.amazonaws.com";
    $port = "5432";
    $dbname = "d62v390lqlrsn8";
    $user = "ihhieqvwqxhpov";
    $password = "3f34f2dde2ce1431743aa5e45760e95e8880eb552b86d9263b934acb8b8a92d2"; 
    $connection_string = "host={$host} port={$port} dbname={$dbname} user= 
              {$user} password={$password} ";
    $dbconn = pg_connect($connection_string);   
  
if($dbconn){
    echo "Connected established". pg_host($dbconn); 
}else{
    echo "Somethng went wrong.";
}
