<?php

$time_start = microtime(true);
sleep(1);

//Dakota Server Login Info
$ftp_server = "50.22.53.24";
$ftp_user   = "trimark";
$ftp_pass   = "WQnZ2r8dBt8nfPrNMoqQP3T8";

//Files Involved in transfer ($local_file = Dakota Server Directory) & ($trimark_file = FTP Server Directory)
//$local_file = "/home/ec2-user/Trimark/Inputs/Config/abc.zip";
$trimark_file = "*.zip";

//Change Dakota Directory
chdir('/home/ec2-user/Trimark/Media');
echo "Dakota Directory has changed to: " . getcwd() . "\n";

// set up a connection or die
$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server");

// Logs into FTP Server
if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    echo "Connection Successful! - Connected as $ftp_user@$ftp_server\n";
} else {
    echo "Couldn't connect as $ftp_user\n";
}

ftp_pasv($conn_id, true);

// Change the directory to "media/"
if (ftp_chdir($conn_id, "media/")) {
    echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
} else {
    echo "Couldn't change directory\n";
}


$contents = ftp_nlist($conn_id, ".");
//print_r($contents);

//print_r($output);


$contents = ftp_nlist($conn_id, ".");
$output = array_slice($contents,447,528);
print_r($output);
foreach ($output as $manID) {
	//First-Changes Directory to "Media/ManufacturerID"
    if (ftp_chdir($conn_id, $manID . "/")) {
        echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
		shell_exec('sudo mkdir /home/ec2-user/Trimark/Media/'.$manID);
		$images = ftp_nlist($conn_id, ".");
		//print_r($images);
		foreach ($images as $imageFile) { 
			ftp_get($conn_id, "/home/ec2-user/Trimark/Media/".$manID."/".$imageFile ,$imageFile, FTP_BINARY); 
		}
		//Second-Changes Directory to Root directory
        if (ftp_chdir($conn_id, "~")) {
            echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
			//Third-Changes Directory back to "Media/"
            if (ftp_chdir($conn_id, "media/")) {
                echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
            } else {
                echo "Couldn't change directory back to Media \n";
            }
        } else {
            echo "Couldn't change directory back to root \n";
        }
        
    } else {
        echo "Couldn't change directory to Manufacturer ID \n";
    }
}


$time_end       = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: " . $execution_time . " Mins" . "\n";
// Process Time: 1.0000340938568

?>