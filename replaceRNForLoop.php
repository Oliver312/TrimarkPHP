<?php

ini_set('memory_limit', '-1');
set_time_limit(0);


$time_start = microtime(true);
sleep(1);

$dir = '/home/ec2-user/Trimark/Inputs/SampleProd';

$contents = scandir($dir);

for ($i = 2; $i < count($contents); $i++) {
	$file = $contents[$i];
 	$json = file_get_contents('/home/ec2-user/Trimark/Inputs/SampleProd/'.$file);
	$arr = json_decode($json);
	$old = '\v';
	$new = '';

	//replace something in the file string - this is a VERY simple example
	$json = str_replace("$old", "$new", $json);

	//write the entire string
	file_put_contents('/home/ec2-user/Trimark/Inputs/SampleProd/'.$file, $json);

	$json2 = file_get_contents('/home/ec2-user/Trimark/Inputs/SampleProd/'.$file);
	$arr2 = json_decode($json2);
	$old2 = '\n';

	//replace something in the file string - this is a VERY simple example
	$json2 = str_replace("$old2", "$new", $json2);
	//write the entire string
	file_put_contents('/home/ec2-user/Trimark/Inputs/SampleProd/'.$file, $json2);
	
		//write the entire string
	file_put_contents('/home/ec2-user/Trimark/Inputs/SampleProd/'.$file, $json);

	$json3 = file_get_contents('/home/ec2-user/Trimark/Inputs/SampleProd/'.$file);
	$arr3 = json_decode($json3);
	$old3 = '\r';

	//replace something in the file string - this is a VERY simple example
	$json3 = str_replace("$old3", "$new", $json3);
	//write the entire string
	file_put_contents('/home/ec2-user/Trimark/Inputs/SampleProd/'.$file, $json3);
	
	$json4 = file_get_contents('/home/ec2-user/Trimark/Inputs/SampleProd/'.$file);
	$arr4 = json_decode($json4);
	$old4 = '\t';

	//replace something in the file string - this is a VERY simple example
	$json4 = str_replace("$old4", "$new", $json4);
	//write the entire string
	file_put_contents('/home/ec2-user/Trimark/Inputs/SampleProd/'.$file, $json4);
}

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: ".$execution_time." Mins"."\n";
	
?>