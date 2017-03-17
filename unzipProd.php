<?php

	$time_start = microtime(true);
    sleep(1);
	
	$dir = '/home/ec2-user/Trimark/Inputs/Prod';
	$contents = scandir($dir);
	//print_r($contents);
	$output = array_slice($contents,2);

	foreach ($output as $file){
      //echo "filename: " . $file . "\n";
	  //echo $file[0];
	  $ConfigFileName = str_replace(".zip","",$file);
	  shell_exec('unzip /home/ec2-user/Trimark/Inputs/Prod/'.$file.' -d /home/ec2-user/Trimark/Inputs/ProdExtract');
	  shell_exec('mv /home/ec2-user/Trimark/Inputs/ProdExtract/prod.json /home/ec2-user/Trimark/Inputs/ProdExtract/'.$file.'.json');
    }

	

	$time_end       = microtime(true);
	$execution_time = ($time_end - $time_start) / 60;
	echo "Total Execution Time: " . $execution_time . " Mins" . "\n";
	// Process Time: 1.0000340938568
?>