<?php

$time_start = microtime(true);
sleep(1);


$contents = scandir('/home/ec2-user/Trimark/Inputs/ProdExtract');

shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/ModelDataCSV/ -name "*.csv" -print0 | xargs -0 rm');

for ($i = 2; $i < count($contents); $i++) {
    $file = $contents[$i];
    
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ModelData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/ModelDataCSV/ModelData' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


}



shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/ModelDataCSV/*.csv > /home/ec2-user/Trimark/Output/Merged/ModelData.csv');




shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeModelData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/ModelData.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/ModelData.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');




$time_end       = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: " . $execution_time . " Mins" . "\n";

?>