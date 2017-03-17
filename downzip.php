<?php

 //Dakota Server Login Info
 $ftp_server = "50.22.53.24";
 $ftp_user = "trimark";
 $ftp_pass = "WQnZ2r8dBt8nfPrNMoqQP3T8";
 
  //Files Involved in transfer ($local_file = Dakota Server Directory) & ($trimark_file = FTP Server Directory)
 //$local_file = "/home/ec2-user/Trimark/Inputs/Prod/xyz.zip";
 $trimark_file = "*.zip";
 
 //Change Dakota Directory
 chdir('/home/ec2-user/Trimark/Inputs/Prod');
 echo "Dakota Directory has changed to: " . getcwd() . "\n";
 
 // set up a connection or die
 $conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 

 // Logs into FTP Server
 if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    echo "Connection Successful! - Connected as $ftp_user@$ftp_server\n";
 } else {
    echo "Couldn't connect as $ftp_user\n";
 }
 
 ftp_pasv($conn_id,true);
 
// Change the directory to somedir
if (ftp_chdir($conn_id, "/2017-01-03/prod/")) {
    echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
} else { 
    echo "Couldn't change directory\n";
}


$contents = ftp_nlist($conn_id, ".");
//print_r($contents);
foreach ($contents as $value) { 
$result = 
//$folder = '8a6882a4-be0d-dd11-a23a-00304834a8c9';
ftp_get($conn_id, "/home/ec2-user/Trimark/Inputs/Prod/".$value ,$value, FTP_BINARY); 
}

$dir = '/home/ec2-user/Trimark/Inputs/Prod';
$contents = scandir($dir);
//print_r($contents);

if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      //echo "filename: " . $file . "\n";
	  //echo $file[0];
	  shell_exec('unzip /home/ec2-user/Trimark/Inputs/Prod/'.$file.' -d /home/ec2-user/Trimark/Inputs/ProdExtract');
	  shell_exec('cp /home/ec2-user/Trimark/Inputs/ProdExtract/prod.json /home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.'.json');

    }
    closedir($dh);
  }
}

?>