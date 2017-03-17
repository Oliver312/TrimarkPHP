<?php

$time_start = microtime(true);
sleep(1);


$contents = scandir("/home/ec2-user/Trimark/Media");
$output = array_slice($contents,330,529);
//326 to 529 ORIGINAL
//print_r($output);
//print_r($contents);


foreach ($output as $mediaFolder) {
	$images = scandir("/home/ec2-user/Trimark/Media/$mediaFolder");
	foreach ($images as $imageFile){
		shell_exec('sudo cp /home/ec2-user/Trimark/Media/'.$mediaFolder.'/'.$imageFile.' /home/ec2-user/Trimark/ExtractedMedia');
		//print_r($imageFile);
	}
}

/*  $images = scandir('/home/ec2-user/Trimark/Media/9ccee7a0-be0d-dd11-a23a-00304834a8c9');
 	foreach ($images as $imageFile){
		shell_exec('sudo cp /home/ec2-user/Trimark/Media/9ccee7a0-be0d-dd11-a23a-00304834a8c9/'.$imageFile.' /home/ec2-user/Trimark/ExtractedMedia');
		//print_r($imageFile);
	}
	
  $images2 = scandir('/home/ec2-user/Trimark/Media/9ccee7a0-be0d-dd11-a23a-00304834a8c9');
 	foreach ($images2 as $imageFile){
		shell_exec('sudo cp /home/ec2-user/Trimark/Media/9ccee7a0-be0d-dd11-a23a-00304834a8c9/'.$imageFile.' /home/ec2-user/Trimark/ExtractedMedia');
		//print_r($imageFile);
	}
 
  $images3 = scandir('/home/ec2-user/Trimark/Media/9dfddfa6-be0d-dd11-a23a-00304834a8c9');
 	foreach ($images3 as $imageFile){
		shell_exec('sudo cp /home/ec2-user/Trimark/Media/9dfddfa6-be0d-dd11-a23a-00304834a8c9/'.$imageFile.' /home/ec2-user/Trimark/ExtractedMedia');
		//print_r($imageFile);
	}
 
  $images4 = scandir('/home/ec2-user/Trimark/Media/9ecce7a0-be0d-dd11-a23a-00304834a8c9');
 	foreach ($images4 as $imageFile){
		shell_exec('sudo cp /home/ec2-user/Trimark/Media/9ecce7a0-be0d-dd11-a23a-00304834a8c9/'.$imageFile.' /home/ec2-user/Trimark/ExtractedMedia');
		//print_r($imageFile);
	}
 
  */

$time_end       = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: " . $execution_time . " Mins" . "\n";
// Process Time: 1.0000340938568

?>
