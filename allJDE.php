<?php

ini_set('memory_limit', '-1');
set_time_limit(0);


date_default_timezone_set('America/Chicago');
$myDate = date('Ymd');

$time_start = microtime(true);
sleep(1);

//shell_exec('sudo rm -r /home/ec2-user/Trimark/Inputs/temp_jde/*');

$dir = '/home/ec2-user/Trimark/Inputs/ProdExtract';

$contents = scandir($dir);

for ($i = 2; $i < count($contents); $i++) {
	$file = $contents[$i];
	$fileName = str_replace(".zip.json", "", $file);
	
	
 	$json = file_get_contents('/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file);
	$arr = json_decode($json);
	$old = '\r\n';
	$new = '';

	//replace something in the file string - this is a VERY simple example
	$json = str_replace(["\r\n", "\r", "\n"], "$new", $json);
	//write the entire string
//1
	file_put_contents('/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file, $json);

/* 	$json2 = file_get_contents('/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file);
	$arr2 = json_decode($json2);
	$old2 = '\n';
	//replace something in the file string - this is a VERY simple example
	$json2 = str_replace("$old2", "$new", $json2);
	//write the entire string
//2
	file_put_contents('/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file, $json2);

	$json3 = file_get_contents('/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file);
	$arr3 = json_decode($json3);
	$old3 = '\r';
	//replace something in the file string - this is a VERY simple example
	$json3 = str_replace("$old3", "$new", $json3);
	//write the entire string
//3
	file_put_contents('/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file, $json3);
	
	$json4 = file_get_contents('/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file);
	$arr4 = json_decode($json4);
	$old4 = '\t';
	//replace something in the file string - this is a VERY simple example
	$json4 = str_replace("$old4", "$new", $json4);
	//write the entire string
//4
	file_put_contents('/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file, $json4); */
	
	//echo "This is File: " . $file . "\n";
	
	
	shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/JDE-Step1-12-20.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_jde/AQ_Temp'.$i.'.txt > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/JDE-Step2-12-20.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_jde/AQ_Temp'.$i.'.txt -p=OutputFileName:/home/ec2-user/Trimark/Output/JDE/txtFiles/'.$i.'Auto_Quotes_Extract.txt > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

	}

shell_exec('sudo find /home/ec2-user/Trimark/Output/JDE/txtFiles/ -name "*.txt" -exec cat "{}" ";" > /home/ec2-user/Trimark/Output/JDE/Auto_Quotes_Extract_'.$myDate.'.txt');

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: ".$execution_time." Mins"."\n";

?>
