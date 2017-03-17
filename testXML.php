<?php

$dir = '/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract';

/* $contents = scandir($dir);



for ($i = 2; $i < count($contents); $i++) {
    $file = $contents[$i];
	
	$str2 = str_replace(".xml","",$file);
/*     //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/JDE-Step1.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Prod/Extract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_jde/AQ_Temp'.$i.'.txt > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/JDE-Step2.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_jde/AQ_Temp'.$i.'.txt -p=OutputFileName:/home/ec2-user/Trimark/Output/JDE/txtFiles/'.$i.'Auto_Quotes_Extract.txt > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ModelData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Prod/Extract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/ModelDataCSV/ModelData'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    $xml  = $dir . '/' . $file;
    $old  = '<?xml version="1.0" encoding="utf-16"?>';
    $new  = '<?xml version="1.0" encoding="utf-8"?>';
    //read the entire string
    $str  = file_get_contents($xml);
    
    //replace something in the file string
    $str = str_replace("$old", "$new", $str);
    
    //write the entire string
    file_put_contents($xml, $str); */
    //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file.' -p=VendorID:986082a4-be0d-dd11-a23a-00304834a8c9 -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/PerMerged'.$i.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/' . $file . ' -p=VendorID:986082a4-be0d-dd11-a23a-00304834a8c9 -p=ModelID:' . $str2 . ' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleToList/PerMerged' . $i . '.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    
//} */

shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Perlick/TempConfig/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Perlick/PerlickRuleToList.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/Vollrath/TempConfig/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/Vollrath/VollrathRuleToList.csv');
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/UpdateInter/TempConfig/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateRuleToList.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Inputs/UpdateInter/UpdateRuleToList.csv /home/ec2-user/Trimark/Inputs/Vollrath/VollrathRuleToList.csv /home/ec2-user/Trimark/Inputs/Perlick/PerlickRuleToList.csv> /home/ec2-user/Trimark/Inputs/ConfigMerged/RuleToList-RAW.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/RuleToList-RAW.csv -p=OutputFileName:/home/ec2-user/Trimark/Inputs/ConfigMerged/RuleToList.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

?>