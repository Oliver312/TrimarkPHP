<?php

	$time_start = microtime(true);
    sleep(1);

$dir = '/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract';

$contents = scandir($dir);
//print_r($contents);

for ($i = 2; $i < count($contents);$i++){
	  $file = $contents[$i];
	  
	  $dir2 = '/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.'/';
	  $contents2 = scandir($dir2);
	  //print_r($contents2);
	  
	  for ($i = 2; $i < count($contents2);$i++){
		  $file2 = $contents2[$i];
		  
		  $str2 = str_replace(".xml","",$file2);
		  $xml = $dir.'/'.$file.'/'.$file2;
          $old = '<?xml version="1.0" encoding="utf-16"?>';
          $new = '<?xml version="1.0" encoding="utf-8"?>';
          //read the entire string
          $str = file_get_contents($xml);
            
          //replace something in the file string
          $str = str_replace("$old", "$new", $str);
            
          //write the entire string
          file_put_contents($xml, $str);
		  
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.'/'.$file2.' -p=VendorID:'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/ListProperties/ListP'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.'/'.$file2.' -p=VendorID:'.$file.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleToList/RuleToList'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.'/'.$file2.' -p=VendorID:'.$file.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleConditions/RuleCond'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.'/'.$file2.' -p=VendorID:'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/ListSelections/ListSel'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
 
	  }
	  
	  
}

//ListSelections
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Perlick/TempConfig/ListSelections/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Perlick/Merged/ListSelMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/Merged/ListSelMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/Output/ListSelections.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


//ListProperties
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Perlick/TempConfig/ListProperties/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Perlick/Merged/ListPMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/Merged/ListPMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/Output/ListProperties.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

//RuleToList
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Perlick/Merged/RuleToListMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/Merged/RuleToListMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/Output/RuleToList.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


//RuleConditions
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleConditions/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Perlick/Merged/RuleCondMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleConditions_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/Merged/RuleCondMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/Output/RuleConditions.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


$time_end = microtime(true);
$execution_time = ($time_end - $time_start)/60;
echo "Total Execution Time: " .$execution_time." Mins" . "\n";


?>