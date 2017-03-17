<?php

$dir = '/home/ec2-user/Trimark/Inputs/ConfigZipped';
$dir2 = '/home/ec2-user/Trimark/Inputs/Config';

$contents = scandir($dir);
$contents2 = scandir($dir2);

$output = array_slice($contents,2);
$output2 = array_slice($contents2,2);

//shell_exec('sudo mv /home/ec2-user/Trimark/Inputs/Config /home/ec2-user/Trimark/YesterdayInput/Config');
//shell_exec('sudo mv /home/ec2-user/Trimark/Inputs/ConfigExtract /home/ec2-user/Trimark/YesterdayInput/ConfigExtract');
//shell_exec('sudo mkdir /home/ec2-user/Trimark/Inputs/ConfigExtract');
//shell_exec('sudo mkdir /home/ec2-user/Trimark/Inputs/Config');

foreach ($output as $file){
    //echo "filename: " . $file . "\n";
	//echo $file[0];
	$ConfigFileName = str_replace(".zip","",$file);
	//shell_exec('sudo mkdir /home/ec2-user/Trimark/Inputs/Config/'.$ConfigFileName);
	shell_exec('sudo mkdir /home/ec2-user/Trimark/Inputs/ConfigExtract/'.$ConfigFileName);
	//shell_exec('sudo unzip /home/ec2-user/Trimark/Inputs/ConfigZipped/'.$file.' -d /home/ec2-user/Trimark/Inputs/Config/'.$ConfigFileName);

    }
	
foreach ($output2 as $vendorID){
	$dir3 = '/home/ec2-user/Trimark/Inputs/Config/'.$vendorID;
	$contents3 = scandir($dir3);
	$output3 = array_slice($contents3,2);
	
	shell_exec('sudo mv /home/ec2-user/Trimark/Inputs/Config/'.$vendorID.'/index.json /home/ec2-user/Trimark/Inputs/ConfigIndex/'.$vendorID.'.json');
		
	
	foreach ($output3 as $productID){
		$ConfigFileName = str_replace(".zip","",$productID);
		shell_exec('sudo unzip /home/ec2-user/Trimark/Inputs/Config/'.$vendorID.'/'.$productID.' -d /home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendorID);
		shell_exec('sudo mv /home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendorID.'/config.xml /home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendorID.'/'.$ConfigFileName.'.xml');
	
	}

    }

?>