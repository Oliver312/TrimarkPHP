<?php
ini_set('memory_limit', '-1');
set_time_limit(0);


$time_start = microtime(true);
sleep(1);
//Dakota Server Login Info
$ftp_server = "50.22.53.24";
$ftp_user   = "trimark";
$ftp_pass   = "WQnZ2r8dBt8nfPrNMoqQP3T8";


//JDE Server Login Info
$ftp_server_jde = "199.19.209.92";
$ftp_user_jde   = "devaqdatastore";
$ftp_pass_jde   = "CTT3nsaRT*";


//Connects to SFTP Location
$connectionJDE = ssh2_connect($ftp_server_jde);
if (ssh2_auth_password($connectionJDE, $ftp_user_jde, $ftp_pass_jde)) {
    echo "Connection Successful! - Connected as $ftp_user_jde@$ftp_server_jde\n";
} else {
    echo "Couldn't connect as $ftp_user_jde\n";
}
;

$sftp_jde = ssh2_sftp($connectionJDE);
//Transfers $file_jde from Dakota Server($file) to SFTP Location($stream)

/* //Retrieves Media file name with extension_loaded
foreach (glob("/home/ec2-user/Trimark/Media/*") as $mediaFoldername) {
    $mediaFolder = pathinfo($mediaFoldername, PATHINFO_BASENAME);
    //print_r($mediaFolder . "\n");
	foreach(glob("/home/ec2-user/Trimark/Media/$mediaFolder/*") as $mediaFile){
		print_r($mediaFile."\n");
	} 
} */

if (ssh2_scp_send($connectionJDE,"/home/ec2-user/Trimark/Media/00062f72-8ec9-de11-8d01-001ec95274b6/005fbedc-793d-4d1b-a21f-5b57b02eda70.png", "/devaqdatastore-AQJDEItems/media/",0644)) {
    echo "Success! - File transferred from $ftp_server to $ftp_server_jde\n";
} else {
    echo "Could not write file from $ftp_server to $ftp_server_jde\n";
};

/* //Retrieves Media file name with extension_loaded
foreach (glob("/home/ec2-user/Trimark/Media/*") as $mediaFoldername) {
    $mediaFolder = pathinfo($mediaFoldername, PATHINFO_BASENAME);
    //print_r($mediaFolder . "\n");
	foreach(glob("/home/ec2-user/Trimark/Media/00062f72-8ec9-de11-8d01-001ec95274b6/*") as $mediaFile){
		//print_r($mediaFile."\n");
if (ssh2_scp_send($connectionJDE,"/home/ec2-user/Trimark/Media/00062f72-8ec9-de11-8d01-001ec95274b6/005fbedc-793d-4d1b-a21f-5b57b02eda70.png", "/devaqdatastore-AQJDEItems/media/",0644)) {
    echo "Success! - File transferred from $ftp_server to $ftp_server_jde\n";
} else {
    echo "Could not write file from $ftp_server to $ftp_server_jde\n";
};
	} 
}
 */


/* $stream_media = fopen("ssh2.sftp://$sftp_jde/devaqdatastore-AQJDEItems/media/$mediaFile", 'w');
$file_media   = file_get_contents("/home/ec2-user/Trimark/Media/$mediaFile");
if (fwrite($stream_media, $file_media)) {
    echo "Success! - File transferred from $ftp_server to $ftp_server_jde\n";
} else {
    echo "Could not write file from $ftp_server to $ftp_server_jde\n";
};
 */
/* fclose($stream_jde);
if (ssh2_exec($connectionJDE, 'exit')) {
    echo "Disconnected from: $ftp_user_jde@$ftp_server_jde\n";
} else {
    echo "Couldn't disconnect from $ftp_user_jde\n";
}
;
//End of Connection */

$time_end       = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: " . $execution_time . " Mins" . "\n";
// Process Time: 1.0000340938568


?>