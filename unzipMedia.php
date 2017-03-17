<?php

ini_set('memory_limit', '-1');
set_time_limit(0);
$time_start = microtime(true);
sleep(1);


$dir = '/home/ec2-user/Trimark/MediaZip';

$contents = scandir($dir);
//print_r($contents);

for ($i = 2; $i < count($contents);$i++){
	    $vendor = $contents[$i];
		$vendorName = str_replace(".zip","",$vendor);
		
		//shell_exec('sudo mkdir /home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendorName);
		shell_exec('sudo unzip /home/ec2-user/Trimark/MediaZip/'.$vendor.' -d /home/ec2-user/Trimark/MediaExtract/');
		shell_exec('sudo rm /home/ec2-user/Trimark/MediaExtract/index.json');
		
		//echo "This is the config file: " . "/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/$vendorFileName/$fileName.xml" . "\n";
}

		// This starts the mappings
		// Converts all XML files into UTF-8 so the files are valid for mapping
/* 	  $dir2 = '/home/ec2-user/Trimark/Inputs/ConfigExtract/';
	  $contents2 = scandir($dir2);
	  for ($i = 2; $i < count($contents2);$i++){
		  $vendorFolder = $contents2[$i];
		  
		  $dir3 = '/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendorFolder;
		  $contents3 = scandir($dir3);
		  
		  //echo "This is the directory: " .$dir3."\n";
		  
	  	  for ($i = 2; $i < count($contents3);$i++){
			  $product = $contents3[$i];
			  
			  
		  $productName = str_replace(".xml","",$product);
		  $xml = $dir3.'/'.$product;
		  
		  //echo "This is the product directory: " . $xml . "\n";
		  
          $old = 'encoding="utf-16"?>';
          $new = 'encoding="utf-8"?>';
          //read the entire string
          $str = file_get_contents($xml);
            
          //replace something in the file string
          $str = str_replace("$old", "$new", $str);
            
          //write the entire string
          file_put_contents($xml, $str);
			  
		  }

	  } */

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: ".$execution_time." Mins"."\n";


?>