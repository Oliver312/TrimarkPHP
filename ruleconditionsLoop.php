<?php
	$time_start = microtime(true);
    sleep(1);

$dir = '/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract';
$vollrath = '/home/ec2-user/Trimark/Inputs/Vollrath/ActualExtract';
$update = '/home/ec2-user/Trimark/Inputs/UpdateInter/ActualExtract';

$contents = scandir($dir);
$updatecontents = scandir($update);
$vollcontents = scandir($vollrath);
//print_r($contents);

//Normal 11 CSVs
/* shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/AddlItemData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/AddlItemData.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/CasePricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/CasePricing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Certification_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/Certification.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Electrical_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/Electrical.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Flyers_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/Flyers.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/FOB_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/FOB.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/GasSteam_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/GasSteam.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/HVAC_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/HVAC.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ModelData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/ModelData.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Plumbing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/Plumbing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/QtyPricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdMerge/VollrathPerlickUpdate.json -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/QtyPricing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1'); */

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
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.' -p=VendorID:986082a4-be0d-dd11-a23a-00304834a8c9 -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/ListProperties/PerMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.' -p=VendorID:986082a4-be0d-dd11-a23a-00304834a8c9 -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleToList/PerMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.' -p=VendorID:986082a4-be0d-dd11-a23a-00304834a8c9 -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleConditions/PerMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.' -p=VendorID:986082a4-be0d-dd11-a23a-00304834a8c9 -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/ListSelections/PerMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  
}

for ($i = 2; $i < count($vollcontents);$i++){
	  $file = $vollcontents[$i];
	  $str2 = str_replace(".xml","",$file);
	  $xml = $vollrath.'/'.$file;
            $old = '<?xml version="1.0" encoding="utf-16"?>';
            $new = '<?xml version="1.0" encoding="utf-8"?>';
            //read the entire string
            $str = file_get_contents($xml);
            
            //replace something in the file string
            $str = str_replace("$old", "$new", $str);
            
            //write the entire string
            file_put_contents($xml, $str);
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Vollrath/ActualExtract/'.$file.' -p=VendorID:8a6882a4-be0d-dd11-a23a-00304834a8c9 -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Vollrath/TempConfig/ListProperties/VollMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Vollrath/ActualExtract/'.$file.' -p=VendorID:8a6882a4-be0d-dd11-a23a-00304834a8c9 -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Vollrath/TempConfig/RuleToList/VollMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Vollrath/ActualExtract/'.$file.' -p=VendorID:8a6882a4-be0d-dd11-a23a-00304834a8c9 -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Vollrath/TempConfig/RuleConditions/VollMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Vollrath/ActualExtract/'.$file.' -p=VendorID:8a6882a4-be0d-dd11-a23a-00304834a8c9 -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Vollrath/TempConfig/ListSelections/VollMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

		}


for ($i = 2; $i < count($updatecontents);$i++){
	  $file = $updatecontents[$i];
	  $str2 = str_replace(".xml","",$file);
      $xml = $update.'/'.$file;
            $old = '<?xml version="1.0" encoding="utf-16"?>';
            $new = '<?xml version="1.0" encoding="utf-8"?>';
            //read the entire string
            $str = file_get_contents($xml);
            
            //replace something in the file string
            $str = str_replace("$old", "$new", $str);
            
            //write the entire string
            file_put_contents($xml, $str);
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/UpdateInter/ActualExtract/'.$file.' -p=VendorID:3df9dfa6-be0d-dd11-a23a-00304834a8c9 -p=OutputFileName:/home/ec2-user/Trimark/Inputs/UpdateInter/ListProperties/UpdateMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/UpdateInter/ActualExtract/'.$file.' -p=VendorID:3df9dfa6-be0d-dd11-a23a-00304834a8c9 -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/UpdateInter/TempConfig/RuleToList/UpdateMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/UpdateInter/ActualExtract/'.$file.' -p=VendorID:3df9dfa6-be0d-dd11-a23a-00304834a8c9 -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/UpdateInter/RuleConditions/UpdateMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/UpdateInter/ActualExtract/'.$file.' -p=VendorID:3df9dfa6-be0d-dd11-a23a-00304834a8c9 -p=ModelID:'.$str2.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/UpdateInter/ListSelections/UpdateMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	  }

	//ListProperties
/* shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Perlick/TempConfig/ListProperties/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Perlick/PerlickListP.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Vollrath/TempConfig/ListProperties/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Vollrath/VollrathListP.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/UpdateInter/TempConfig/ListProperties/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateListP.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateListP.csv /home/ec2-user/Trimark/Inputs/Vollrath/VollrathListP.csv /home/ec2-user/Trimark/Inputs/Perlick/PerlickListP.csv > /home/ec2-user/Trimark/Inputs/ConfigMerged/ListProperties-RAW.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/ListProperties-RAW.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/ListProperties.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
 */
	//RuleToList
/* shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Perlick/PerlickRuleToList.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Vollrath/TempConfig/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Vollrath/VollrathRuleToList.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/UpdateInter/TempConfig/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateRuleToList.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateRuleToList.csv /home/ec2-user/Trimark/Inputs/Vollrath/VollrathRuleToList.csv /home/ec2-user/Trimark/Inputs/Perlick/PerlickRuleToList.csv> /home/ec2-user/Trimark/Inputs/ConfigMerged/RuleToList-RAW.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/RuleToList-RAW.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/RuleToList.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
 */
 
	//RuleConditions **did on local machine
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleConditions/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Perlick/PerlickRuleC.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Vollrath/TempConfig/RuleConditions/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Vollrath/VollrathRuleC.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/UpdateInter/TempConfig/RuleConditions/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateRuleC.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateRuleC.csv /home/ec2-user/Trimark/Inputs/Vollrath/VollrathRuleC.csv /home/ec2-user/Trimark/Inputs/Perlick/PerlickRuleC.csv > /home/ec2-user/Trimark/Inputs/ConfigMerged/RuleConditions-RAW.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleConditions_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/RuleConditions-RAW.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/RuleConditions.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

 
	//ListSelections
/* shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Perlick/TempConfig/ListSelections/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Perlick/PerlickListSel.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Vollrath/TempConfig/ListSelections/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Vollrath/VollrathListSel.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/UpdateInter/TempConfig/ListSelections/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateListSel.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateListSel.csv /home/ec2-user/Trimark/Inputs/Vollrath/VollrathListSel.csv /home/ec2-user/Trimark/Inputs/Perlick/PerlickListSel.csv > /home/ec2-user/Trimark/Inputs/ConfigMerged/ListSelections-RAW.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/ListSelections-RAW.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/ListSelections.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
  */
 

     $time_end = microtime(true);
	$execution_time = ($time_end - $time_start)/60;
echo "Total Execution Time: " .$execution_time." Mins" . "\n";

?>