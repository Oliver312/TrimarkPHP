<?php

$time_start = microtime(true);
sleep(1);
date_default_timezone_set('America/Chicago');
$todaysDate = date('Ymd');

//shell_exec('mkdir /home/ec2-user/Trimark/Inputs/Index_Files/Vendor/BackupJson/'.$todaysDate);
//shell_exec('mkdir /home/ec2-user/Trimark/Inputs/Index_Files/Vendor/RecentJson/'.$todaysDate);
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/CompareDiffHashes.mfx -p=TodaysFile:/home/ec2-user/Trimark/Inputs/Index_Files/Vendor/RecentJson/20170207/20170207-new.json -p=OldFile:/home/ec2-user/Trimark/Inputs/Index_Files/Vendor/BackupJson/20170207/20170207-old.json -p=OutputFileName:/home/ec2-user/Trimark/Inputs/HashChanges/VendorFiles.txt >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
 
$text= "/home/ec2-user/Trimark/Inputs/HashChanges/VendorFiles.txt";
$lines = array();
$fp = fopen($text,'r');
while (!feof($fp))
{
	$line=fgets($fp);
	
	$line=trim($line);
	
	$lines[]=$line;
	$file = str_replace(".zip.json","",$line);
	
	shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/AddlItemData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/AddlItemDataCSV/'.$file.'.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
/*     shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/CasePricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/CasePricingCSV/CasePricing'.$file.'.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Certification_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/CertificationsCSV/Certifications'.$file.'.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Electrical_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/ElectricalCSV/Electrical'.$file.'.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Flyers_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/FlyersCSV/Flyers'.$file.'.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/FOB_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/FOBCSV/FOB'.$file.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/GasSteam_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/GasSteamCSV/GasSteam'.$file.'.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/HVAC_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/HVACCSV/HVAC'.$file.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ModelData_Map2.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/ModelDataCSV/ModelData'.$file.'.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Plumbing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/PlumbingCSV/Plumbing'.$file.'.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/QtyPricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Output/HashChanges/VendorLevel/QtyPricingCSV/QtyPricing'.$file.'.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
 */
	
}
fclose($fp);

$time_end       = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: " . $execution_time . " Mins" . "\n";




?>