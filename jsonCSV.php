<?php

$time_start = microtime(true);
sleep(1);


$contents = scandir('/home/ec2-user/Trimark/Inputs/ProdExtract');

//Removes previous CSV Files for Concat
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/AddlItemDataCSV/ -name "*.csv" -print0 | xargs -0 rm');
//shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/CasePricingCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/CertificationCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/ElectricalCSV/ -name "*.csv" -print0 | xargs -0 rm');
//shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/FlyersCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/FOBCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/GasSteamCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/HVACCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/ModelDataCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/PlumbingCSV/ -name "*.csv" -print0 | xargs -0 rm');
//shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/QtyPricingCSV/ -name "*.csv" -print0 | xargs -0 rm');

for ($i = 2; $i < count($contents); $i++) {
    $file = $contents[$i];
    
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/AddlItemData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/AddlItemDataCSV/AddlItemData' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/CasePricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/CasePricingCSV/CasePricing' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Certification_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/CertificationCSV/Certifications' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Electrical_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/ElectricalCSV/Electrical' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Flyers_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/FlyersCSV/Flyers' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/FOB_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/FOBCSV/FOB' . $i . '.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/GasSteam_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/GasSteamCSV/GasSteam' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/HVAC_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/HVACCSV/HVAC' . $i . '.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ModelData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/ModelDataCSV/ModelData' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Plumbing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/PlumbingCSV/Plumbing' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
   //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/QtyPricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/QtyPricingCSV/QtyPricing' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


}



//Concats all the CSV files
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/AddlItemDataCSV/AddlItemData*.csv > /home/ec2-user/Trimark/Output/Merged/AddlItemData.csv');
//shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/CasePricingCSV/CasePricing*.csv > /home/ec2-user/Trimark/Output/Merged/CasePricing.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/CertificationCSV/Certifications*.csv > /home/ec2-user/Trimark/Output/Merged/Certifications.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/ElectricalCSV/Electrical*.csv > /home/ec2-user/Trimark/Output/Merged/Electrical.csv');
//shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/FlyersCSV/Flyers*.csv > /home/ec2-user/Trimark/Output/Merged/Flyers.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/FOBCSV/FOB*.csv > /home/ec2-user/Trimark/Output/Merged/FOB.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/GasSteamCSV/GasSteam*.csv > /home/ec2-user/Trimark/Output/Merged/GasSteam.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/HVACCSV/HVAC*.csv > /home/ec2-user/Trimark/Output/Merged/HVAC.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/ModelDataCSV/ModelData*.csv > /home/ec2-user/Trimark/Output/Merged/ModelData.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/PlumbingCSV/Plumbing*.csv > /home/ec2-user/Trimark/Output/Merged/Plumbing.csv');
//shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/QtyPricingCSV/QtyPricing*.csv > /home/ec2-user/Trimark/Output/Merged/QtyPricing.csv');




shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeAddlItemData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/AddlItemData.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/AddlItemData.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
//shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeCasePricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/CasePricing.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/CasePricing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeCertification_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/Certifications.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/Certifications.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeElectrical_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/Electrical.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/Electrical.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
//shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeFlyers_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/Flyers.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/Flyers.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeFOB_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/FOB.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/FOB.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeGasSteam_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/GasSteam.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/GasSteam.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeHVAC_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/HVAC.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/HVAC.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeModelData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/ModelData.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/ModelData.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergePlumbing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/Plumbing.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/Plumbing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
//shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeQtyPricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/QtyPricing.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/QtyPricing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');




$time_end       = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: " . $execution_time . " Mins" . "\n";

?>