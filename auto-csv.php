<?php
/*
* This PHP Script does the following:
* Logs into Client FTP, downloads zip, extracts content, 
* executes mapforce mappings, zips content, uploads to SFTP server.
* Date: 2016/11/1                                       
* Author: Oliver.S                                       
* Change Log:                                             
* Version: 1.1                                            
* Dakota Systems, Inc.
*/
 
 //Dakota Server Login Info
 $ftp_server = "50.22.53.24";
 $ftp_user = "trimark";
 $ftp_pass = "WQnZ2r8dBt8nfPrNMoqQP3T8";
 //CPQ Server Login Info
 $ftp_server_cpq = "ftp3.bigmachines.com";
 $ftp_user_cpq = "devtrimark";
 $ftp_pass_cpq = "devtrim8171";
 $zip_file = "Map_CSV.zip";
 //JDE Server Login Info
 $ftp_server_jde = "199.19.209.92";
 $ftp_user_jde = "devaqdatastore";
 $ftp_pass_jde = "CTT3nsaRT*";
 
 //Files Involved in transfer ($local_file = Dakota Server Directory) & ($trimark_file = FTP Server Directory)
 $local_file = "/home/ec2-user/Trimark/Inputs/Vollrath/8a6882a4-be0d-dd11-a23a-00304834a8c9.zip";
 $trimark_file = "8a6882a4-be0d-dd11-a23a-00304834a8c9.zip";
 
 //Change Dakota Directory
 chdir('/home/ec2-user/Trimark/Inputs');
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
if (ftp_chdir($conn_id, "prod")) {
    echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
} else { 
    echo "Couldn't change directory\n";
}
	
/*
//Directory List
//Get contents of the current directory
$contents = ftp_nlist($conn_id, ".");
echo "Directory Contents: \n";
// output $contents
var_dump($contents);
*/


// Downloads $trimark_file and saves to $local_file
if (ftp_get($conn_id, $local_file, $trimark_file, FTP_BINARY)) {
    echo "Successfully written to $local_file\n";
} else {
    echo "There was a problem\n";
}

ftp_close($conn_id);
echo "Disconnected from: " . $ftp_server . "\n";

//Change Dakota Directory Back To Normal
chdir("/home/ec2-user/");
 
// current directory
echo "Current Dakota Server Directory: " . getcwd() . "\n";

//Extracts contents of zip file to location
$zip = zip_open("/home/ec2-user/Trimark/Inputs/Vollrath/8a6882a4-be0d-dd11-a23a-00304834a8c9.zip");
if ($zip) {
while ($zip_entry = zip_read($zip)) {
$fp = fopen("/home/ec2-user/Trimark/Inputs/Vollrath/".zip_entry_name($zip_entry), "w");
if (zip_entry_open($zip, $zip_entry, "r")) {
$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
fwrite($fp,"$buf");
zip_entry_close($zip_entry);
fclose($fp);
}
}
zip_close($zip);
}

//Executes Linux commands
//http://stackoverflow.com/questions/16932113/passing-variables-to-shell-exec
shell_exec('sudo /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Prod_no_space.mfx');
shell_exec('sudo /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/JDE-Step1.mfx');
shell_exec('sudo /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/JDE-Step2.mfx');
shell_exec('sudo mv /home/ec2-user/Auto_Quotes_Extract_*.txt /home/ec2-user/Trimark/Output/JDE');
shell_exec('sudo rm /home/ec2-user/Trimark/Inputs/temp_jde/*');
shell_exec('sudo /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ModelData_Map.mfx');
shell_exec('sudo /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/AddlItemData_Map.mfx');

//Creates a .zip folder, created in "$zip->open". $zip->addFile represents all files in the .zip file
$zip = new ZipArchive();
$zip->open('/home/ec2-user/Trimark/Output/Perlick/Map_CSV.zip', ZipArchive::CREATE);
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/AddlItemData.csv','AddlItemData.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/CasePricing.csv','CasePricing.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/Certification.csv','Certification.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/Doclinks.csv','Doclinks.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/Electrical.csv','/Electrical.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/Flyers.csv','Flyers.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/FOB.csv','FOB.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/GasSteam.csv','GasSteam.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/HVAC.csv','HVAC.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/ListProperties.csv','ListProperties.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/ModelData.csv','ModelData.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/ModelProps.csv','ModelProps.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/Plumbing.csv','Plumbing.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/QtyPricing.csv','QtyPricing.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/RuleConditions.csv','RuleConditions.csv');
$zip->addFile('/home/ec2-user/Trimark/Output/Perlick/RuleToList.csv','RuleToList.csv');
/*Troubleshooting ZipArchive
For help on status code: http://www.php.net/manual/en/zip.constants.php
echo "Numfiles: " . $zip->numFiles . "\n";
echo "Status: " . $zip->status . "\n";
*/
$zip->close();

//Retrieves JDE Text file name with extension_loaded
foreach (glob("/home/ec2-user/Trimark/Output/JDE/Auto_Quotes_Extract_*.txt") as $JDE_filename) {}
$JDE_File = pathinfo($JDE_filename,PATHINFO_BASENAME);

//Connects to SFTP Location
$connectionJDE = ssh2_connect($ftp_server_jde);
if (ssh2_auth_password($connectionJDE, $ftp_user_jde, $ftp_pass_jde)){
	echo "Connection Successful! - Connected as $ftp_user_jde@$ftp_server_jde\n";
 } else {
    echo "Couldn't connect as $ftp_user_jde\n";
 };
 
$sftp_jde = ssh2_sftp($connectionJDE);
//Transfers $file_jde from Dakota Server($file) to SFTP Location($stream)
$stream_jde = fopen("ssh2.sftp://$sftp_jde/AQdatastore-AQJDEInbound/$JDE_File", 'w');
$file_jde = file_get_contents("/home/ec2-user/Trimark/Output/JDE/$JDE_File");
if (fwrite($stream_jde,$file_jde)){
	echo "Success! - File transferred from $ftp_server to $ftp_server_jde\n";
} else {
	echo "Could not write file from $ftp_server to $ftp_server_jde\n";
};

fclose($stream_jde);
if (ssh2_exec($connectionJDE, 'exit')){
	echo "Disconnected from: $ftp_user_jde@$ftp_server_jde\n";
 } else {
    echo "Couldn't disconnect from $ftp_user_jde\n";
 };
//End of Connection to JDE

//Connects to SFTP Location
$connection = ssh2_connect($ftp_server_cpq);
if (ssh2_auth_password($connection, $ftp_user_cpq, $ftp_pass_cpq)){
	echo "Connection Successful! - Connected as $ftp_user_cpq@$ftp_server_cpq\n";
 } else {
    echo "Couldn't connect as $ftp_user_cpq\n";
 };
 
$sftp = ssh2_sftp($connection);
//Transfers $zip_file from Dakota Server($file) to SFTP Location($stream)
$stream = fopen("ssh2.sftp://$sftp/upload_zip/automated/$zip_file", 'w');
$file = file_get_contents("/home/ec2-user/Trimark/Output/Perlick/".$zip_file);
if (fwrite($stream,$file)){
	echo "Success! - File $zip_file transferred from $ftp_server to $ftp_server_cpq\n";
} else {
	echo "Could not write file from $ftp_server to $ftp_server_cpq\n";
};

fclose($stream);
if (ssh2_exec($connection, 'exit')){
	echo "Disconnected from: $ftp_user_cpq@$ftp_server_cpq\n";
 } else {
    echo "Couldn't disconnect from $ftp_user_cpq\n";
 };
 //End of Connection


//Linux way of Zipping up all .csv files
//shell_exec('find /home/ec2-user/Trimark/Output/Perlick -type f -name "*.csv" | zip -j csv_files.zip -@)

?>