<?php
ini_set('memory_limit', '-1');
set_time_limit(0);

date_default_timezone_set('America/Chicago');

//Dakota Server Login Info
$ftp_server = "50.22.53.24";
$ftp_user   = "trimark";
$ftp_pass   = "WQnZ2r8dBt8nfPrNMoqQP3T8";

 //JDE Server Login Info
 $ftp_server_jde = "199.19.209.92";
 $ftp_user_jde = "devaqdatastore";
 $ftp_pass_jde = "CTT3nsaRT*";
 
 $todaysDate = date('Ymd');

 //Retrieves JDE Text file name with extension_loaded
//foreach (glob("/home/ec2-user/Trimark/Output/JDE/Auto_Quotes_Extract_$todaysDate.txt") as $JDE_filename) {}
//$JDE_filename = "/home/ec2-user/Trimark/Output/JDE/Auto_Quotes_Extract_$todaysDate.txt";
//$JDE_File = pathinfo($JDE_filename,PATHINFO_BASENAME);
$JDE_filename = "/home/ec2-user/Trimark/Output/JDE/Auto_Quotes_Extract_20170119.txt";
$JDE_File = "Auto_Quotes_Extract_20170119.txt";
 
//Connects to SFTP Location
$connectionJDE = ssh2_connect($ftp_server_jde,22);
if (ssh2_auth_password($connectionJDE, $ftp_user_jde, $ftp_pass_jde)){
	echo "Connection Successful! - Connected as $ftp_user_jde@$ftp_server_jde\n";
 } else {
    echo "Couldn't connect as $ftp_user_jde\n";
 };
 
$sftp_jde = ssh2_sftp($connectionJDE);
echo "SFTP JDE VARIABLE: " . $sftp_jde;
echo "\n CONNECTION JDE VARIABLE: " . $connectionJDE;
//Transfers $file_jde from Dakota Server($file) to SFTP Location($stream)
/* $stream_jde = fopen("ssh2.sftp://$sftp_jde/devaqdatastore-AQJDEItems/Old files/$JDE_File", 'w');
$file_jde = fopen("/home/ec2-user/Trimark/Output/JDE/$JDE_File");
 */


if (ssh2_exec($connectionJDE, 'exit')){
	echo "Disconnected from: $ftp_user_jde@$ftp_server_jde\n";
 } else {
    echo "Couldn't disconnect from $ftp_user_jde\n";
 };
//End of Connection

?>