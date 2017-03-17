<?php

$directory = "/home/ec2-user/Trimark/Inputs/temp_config/TESTListProperties/";
$filecount = 0;
$files = glob($directory . "*");
if ($files){
 $filecount = count($files);
}
echo "There were $filecount files";

 
$dir = '/home/ec2-user/Trimark/Inputs/ConfigExtract';
$contents = scandir($dir);

//shell_exec('cd /home/ec2-user/Trimark/Inputs/ConfigExtract'); 
//shell_exec('find `find /home/ec2-user/Trimark/Inputs/temp_config/TESTListProperties -mindepth 1 -maxdepth 1 -type d -print` -type f -print | wc -l');
 

/* for ($i = 2; $i < count($contents);$i++){
	  $vendor = $contents[$i];
	  $vendorCount = count($contents);
	  
	  $dir2 = '/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/';
	  $contents2 = scandir($dir2);
	  //print_r($contents2);
	  
	  for ($a = 2; $a < count($contents2);$a++){
		  $product = $contents2[$a];
		  $productCount = count($contents2);
		  
		  //$str2 = str_replace(".xml","",$product);
		  
		  
	      //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/TESTListProperties/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleToList/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleConditions/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/TESTListSelections/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
 
	  }
	  
	  
}

echo "This is the Vendor Count: " . $vendorCount."\n";
echo "This is the Product Count: " . $productCount."\n";
 */
?>