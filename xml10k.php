<?php

ini_set('memory_limit', '-1');
set_time_limit(0);
$time_start = microtime(true);
sleep(1);

$dir = '/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD';
$contents = scandir($dir);
$output = array_slice($contents,0,10002);

for ($i = 2; $i < count($output);$i++){
	  $vendor = $output[$i];
	  //echo "The vendors: " . $vendor ."\n";
	  
	  $dir2 = '/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/'.$vendor.'/';
	  $contents2 = scandir($dir2);

	  for ($a = 2; $a < count($contents2);$a++){
		  $product = $contents2[$a];
		  $str2 = str_replace(".xml","",$product);
		  		  
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListProperties10k/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

	  }  
}

// ListProperties
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/ListProperties10k/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPMerged10k.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPMerged10k.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/ListProperties10k.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');



$time_end = microtime(true);
$execution_time = ($time_end - $time_start)/60;
echo "Total Execution Time: " .$execution_time." Mins" . "\n";
?>