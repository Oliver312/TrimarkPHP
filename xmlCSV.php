<?php

ini_set('memory_limit', '-1');
set_time_limit(0);
$time_start = microtime(true);
sleep(1);

shell_exec('find /home/ec2-user/Trimark/Inputs/temp_config/ListProperties/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Inputs/temp_config/ListSelections/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Inputs/temp_config/RuleConditions/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Inputs/temp_config/RuleToList/ -name "*.csv" -print0 | xargs -0 rm');	
	
$dir = '/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD';

$contents = scandir($dir);
//print_r($contents);

for ($i = 2; $i < count($contents);$i++){
	  $vendor = $contents[$i];
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListProperties150/'.$str2.'.csv ; /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleToList150/'.$str2.'.csv ; /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleConditions150/'.$str2.'.csv ; /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListSelections150/'.$str2.'.csv');
	  
	  $dir2 = '/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/'.$vendor.'/';
	  $contents2 = scandir($dir2);
	  //print_r($contents2);
	  
	    
	  
	  for ($a = 2; $a < count($contents2);$a++){
		  $product = $contents2[$a];
		  
		  $str2 = str_replace(".xml","",$product);
		  
		  
/* 	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListProperties150/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleToList150/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleConditions150/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListSelections150/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
  */
  
  	  shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListProperties/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1 ; /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleToList/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1 ; /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleConditions/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1 ; /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListSelections/'.$str2.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  
  
 
	  }
	  
	  
}

// ListProperties
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/ListProperties/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/ListProperties.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

// ListSelections
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/ListSelections/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/ListSelMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/ListSelMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/ListSelections.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

//RuleConditions
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/RuleConditions/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleCondMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleConditions_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleCondMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/RuleConditions.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

//RuleToList
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleToListMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleToListMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/RuleToList.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

$time_end = microtime(true);
$execution_time = ($time_end - $time_start)/60;
echo "Total Execution Time: " .$execution_time." Mins" . "\n";


?>