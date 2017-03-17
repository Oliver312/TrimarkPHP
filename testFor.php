<?php

//$dir      = '/home/ec2-user/Trimark/Inputs/Prod/Extract';
//$contents = scandir($dir);
//print_r($contents);

/* for ($i = 2; $i < count($contents);$i++){
echo "File: " . $contents[$i] . "\n";
>> /home/ec2-user/linuxlog.txt
} */

//$file = '00062f72-8ec9-de11-8d01-001ec95274b6.zip.json';
//shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/JDE-Step1.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/Prod/Extract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_jde/AQ_Temp.txt > /home/ec2-user/linuxlog.txt 2>&1');
  
/* $dir = '/home/ec2-user/Trimark/Inputs/Prod';
$contents = scandir($dir);
print_r($contents);

if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      //echo "filename: " . $file . "\n";
	  //echo $file[0];
	  shell_exec('unzip /home/ec2-user/Trimark/Inputs/Prod/'.$file.' -d /home/ec2-user/Trimark/Inputs/Prod/Extract');
	  shell_exec('mv /home/ec2-user/Trimark/Inputs/Prod/Extract/prod.json /home/ec2-user/Trimark/Inputs/Prod/Extract/'.$file.'.json');

    }
    closedir($dh);
  }
} */
	date_default_timezone_set('America/Chicago');
	$time_start = microtime(true);
    sleep(1);
    $time_end = microtime(true);
	$execution_time = ($time_end - $time_start)/60;
	
	$myDate = date('Ymd');
	echo $myDate . "\n";
    echo 'Total Execution Time: ' .$execution_time.' Mins' . '\n';
    // Process Time: 1.0000340938568
  
  
?>