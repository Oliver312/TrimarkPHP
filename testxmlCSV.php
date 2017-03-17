<?php

	$time_start = microtime(true);
    sleep(1);

$dir = '/home/ec2-user/Trimark/Inputs/ConfigExtract';

$contents = scandir($dir);
//print_r($contents);

for ($i = 2; $i < count($contents);$i++){
	  $file = $contents[$i];
	  
	  $dir2 = '/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$file.'/';
	  $contents2 = scandir($dir2);
	  print_r($contents2);
	  
	  for ($i = 2; $i < count($contents2);$i++){
		  $file2 = $contents2[$i];
		  
		//print_r($file2);

	  }
	  
	  
}

echo "\n". "finished i think\n";

     $time_end = microtime(true);
	$execution_time = ($time_end - $time_start)/60;
echo "Total Execution Time: " .$execution_time." Mins" . "\n";


?>