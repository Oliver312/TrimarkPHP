<?php

	$time_start = microtime(true);
    sleep(1);

$dir = '/home/ec2-user/Trimark/Inputs/ConfigExtract/81c4e7a0-be0d-dd11-a23a-00304834a8c9';

$contents = scandir($dir);
//print_r($contents);
$vendorID = "81c4e7a0-be0d-dd11-a23a-00304834a8c9";

for ($i = 2; $i < count($contents);$i++){
	  $file = $contents[$i];
	  
	  $str2 = str_replace(".xml","",$file);
	  $xml = $dir.'/'.$file;
      $old = '<?xml version="1.0" encoding="utf-16"?>';
      $new = '<?xml version="1.0" encoding="utf-8"?>';
      //read the entire string
      $str = file_get_contents($xml);
            
      //replace something in the file string
      $str = str_replace("$old", "$new", $str);
            
      //write the entire string
      file_put_contents($xml, $str);
		  
	  shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/81c4e7a0-be0d-dd11-a23a-00304834a8c9/'.$file.' -p=VendorID:'.$vendorID.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Big1/TempConfig/ListProperties/ListP'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/81c4e7a0-be0d-dd11-a23a-00304834a8c9/'.$file.' -p=VendorID:'.$vendorID.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Big1/TempConfig/RuleToList/RuleToList'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/81c4e7a0-be0d-dd11-a23a-00304834a8c9/'.$file.' -p=VendorID:'.$vendorID.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Big1/TempConfig/RuleConditions/RuleCond'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map2.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract/81c4e7a0-be0d-dd11-a23a-00304834a8c9/'.$file.' -p=VendorID:'.$vendorID.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Big1/TempConfig/ListSelections/ListSel'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
 
	  
	  
	  
}

//ListSelections
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Big1/TempConfig/ListSelections/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Big1/Merged/ListSelMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Big1/Merged/ListSelMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Big1/Output/ListSelections.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


//ListProperties
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Big1/TempConfig/ListProperties/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Big1/Merged/ListPMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Big1/Merged/ListPMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Big1/Output/ListProperties.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

//RuleToList
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Big1/TempConfig/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Big1/Merged/RuleToListMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Big1/Merged/RuleToListMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Big1/Output/RuleToList.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


//RuleConditions
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Big1/TempConfig/RuleConditions/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Big1/Merged/RuleCondMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleConditions_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Big1/Merged/RuleCondMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Big1/Output/RuleConditions.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


$time_end = microtime(true);
$execution_time = ($time_end - $time_start)/60;
echo "Total Execution Time: " .$execution_time." Mins" . "\n";


?>