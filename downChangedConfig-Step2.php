<?php

	$time_start = microtime(true);
    sleep(1);

$dir = '/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2';

$contents = scandir($dir);
//print_r($contents);

for ($i = 2; $i < count($contents);$i++){
	  $vendor = $contents[$i];
	  
	  $dir2 = '/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/'.$vendor.'/';
	  $contents2 = scandir($dir2);
	  echo "This is dir2: " .$dir2."\n";
	  //print_r($contents2);
	  
	  for ($i = 2; $i < count($contents2);$i++){
		  $product = $contents2[$i];
		  echo "This is Product List: " .$product."\n";
/* 		  $str2 = str_replace(".xml","",$vendor);
		  $xml = $dir.'/'.$vendor.'/'.$product;
          $old = '<?xml version="1.0" encoding="utf-16"?>';
          $new = '<?xml version="1.0" encoding="utf-8"?>';
          //read the entire string
          $str = file_get_contents($xml);
            
          //replace something in the file string
          $str = str_replace("$old", "$new", $str);
            
          //write the entire string
          file_put_contents($xml, $str);
		  
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListProperties/ListP'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleToList/RuleToList'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleConditions/RuleCond'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/'.$vendor.'/'.$product.' -p=VendorID:'.$vendor.' -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListSelections/ListSel'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
  */
	  }
	  
	  
}

/* //ListSelections
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/ListSelections/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/ListSelMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/ListSelMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/ListSelections.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


//ListProperties
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/ListProperties/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/ListProperties.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

//RuleToList
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleToListMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleToListMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/RuleToList.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


//RuleConditions
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/RuleConditions/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleCondMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleConditions_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleCondMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/RuleConditions.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
 */

     $time_end = microtime(true);
	$execution_time = ($time_end - $time_start)/60;
echo "Total Execution Time: " .$execution_time." Mins" . "\n";


?>