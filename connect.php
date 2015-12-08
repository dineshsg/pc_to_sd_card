<?php
// connect to FTP server
$ftp_server = "192.168.1.184";
//echo ftp_connect($ftp_server);die;
$port='20';
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");

// login
$ftp_username = 'shotformats';
$ftp_userpass = 'sf123';
if (@ftp_login($ftp_conn, $ftp_username, $ftp_userpass))
  {
  //echo "Connection established.";
  }
else
  {
  echo "Couldn't establish a connection.";
  }

//ftp_close($ftp_conn);
?> 
