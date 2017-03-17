<?php

$time_start = microtime(true);
sleep(1);


$contents = scandir('/home/ec2-user/Trimark/Inputs/SampleProd');

//Removes previous CSV Files for Concat
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/AddlItemDataCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/CasePricingCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/CertificationCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/ElectricalCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/FlyersCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/FOBCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/GasSteamCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/HVACCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/ModelDataCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/PlumbingCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/QtyPricingCSV/ -name "*.csv" -print0 | xargs -0 rm');


 
for ($i = 2; $i < count($contents); $i++) {
    $file = $contents[$i];
    
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/AddlItemData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/AddlItemDataCSV/AddlItemData' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/CasePricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/CasePricingCSV/CasePricing' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Certification_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/CertificationCSV/Certification' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Electrical_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/ElectricalCSV/Electrical' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Flyers_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/FlyersCSV/Flyers' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/FOB_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/FOBCSV/FOB' . $i . '.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/GasSteam_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/GasSteamCSV/GasSteam' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/HVAC_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/HVACCSV/HVAC' . $i . '.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ModelData_Map2.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/ModelDataCSV/ModelData' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Plumbing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/PlumbingCSV/Plumbing' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/QtyPricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/SampleProd/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/SampleCSV/AllCSV/QtyPricingCSV/QtyPricing' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


 
}



//Concats all the CSV files
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/AddlItemDataCSV/AddlItemData*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/AddlItemData.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/CasePricingCSV/CasePricing*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/CasePricing.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/CertificationCSV/Certification*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/Certifications.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/ElectricalCSV/Electrical*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/Electrical.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/FlyersCSV/Flyers*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/Flyers.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/FOBCSV/FOB*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/FOB.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/GasSteamCSV/GasSteam*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/GasSteam.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/HVACCSV/HVAC*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/HVAC.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/ModelDataCSV/ModelData*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/ModelData.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/PlumbingCSV/Plumbing*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/Plumbing.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/SampleCSV/AllCSV/QtyPricingCSV/QtyPricing*.csv > /home/ec2-user/Trimark/Output/SampleCSV/Merged/QtyPricing.csv');




shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeAddlItemData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/AddlItemData.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/AddlItemData.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeCasePricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/CasePricing.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/CasePricing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeCertification_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/Certifications.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/Certifications.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeElectrical_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/Electrical.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/Electrical.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeFlyers_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/Flyers.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/Flyers.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeFOB_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/FOB.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/FOB.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeGasSteam_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/GasSteam.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/GasSteam.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeHVAC_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/HVAC.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/HVAC.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeModelData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/ModelData.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/ModelData.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergePlumbing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/Plumbing.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/Plumbing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeQtyPricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/SampleCSV/Merged/QtyPricing.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/SampleFinal/QtyPricing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');





$time_end       = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: " . $execution_time . " Mins" . "\n";

?>