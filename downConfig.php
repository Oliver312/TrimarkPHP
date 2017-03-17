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
chdir('/home/ec2-user/Trimark/Inputs/Config');
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

// Change the directory to "config/"
if (ftp_chdir($conn_id, "/2017-01-03/config/")) {
    echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
} else {
    echo "Couldn't change directory\n";
}



$contents = ftp_nlist($conn_id, ".");
$output = array_slice($contents,83);

foreach ($output as $manID) {
	//First-Changes Directory to "config/ManufacturerID"
    if (ftp_chdir($conn_id, $manID . "/")) {
        //echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
		shell_exec('sudo mkdir /home/ec2-user/Trimark/Inputs/Config/'.$manID);
		shell_exec('sudo mkdir /home/ec2-user/Trimark/Inputs/ConfigExtract/'.$manID);
		$products = ftp_nlist($conn_id, ".");
		//print_r($products);
		foreach ($products as $configFile) { 
			ftp_get($conn_id, "/home/ec2-user/Trimark/Inputs/Config/".$manID."/".$configFile ,$configFile, FTP_BINARY);
			$ConfigFileName = str_replace(".zip","",$configFile);
			//print_r($ConfigFileName."\n");
			//shell_exec('sudo rm /home/ec2-user/Trimark/Inputs/Config/'.$manID.'/index.json');
			shell_exec('sudo unzip /home/ec2-user/Trimark/Inputs/Config/'.$manID.'/'.$configFile.' -d /home/ec2-user/Trimark/Inputs/ConfigExtract/'.$manID);
			shell_exec('sudo mv /home/ec2-user/Trimark/Inputs/ConfigExtract/'.$manID.'/config.xml /home/ec2-user/Trimark/Inputs/ConfigExtract/'.$manID.'/'.$ConfigFileName.'.xml');
		}
		//Second-Changes Directory to Root directory
        if (ftp_chdir($conn_id, "~")) {
            //echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
			//Third-Changes Directory back to "config/"
            if (ftp_chdir($conn_id, "/2017-01-03/config/")) {
                //echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
            } else {
               // echo "Couldn't change directory back to config \n";
            }
        } else {
           // echo "Couldn't change directory back to root \n";
        }
        
    } else {
        //echo "Couldn't change directory to Manufacturer ID \n";
    }
}

$time_end       = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: " . $execution_time . " Mins" . "\n";
// Process Time: 1.0000340938568

?>