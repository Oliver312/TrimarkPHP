<?php

ini_set('memory_limit', '-1');
set_time_limit(0);
$time_start = microtime(true);
sleep(1);


/* $CSVcontents = scandir('/home/ec2-user/Trimark/Output/FinalCSV');

for ($i = 2; $i < count($CSVcontents); $i++) {
    $file = $CSVcontents[$i];
	$fileName = str_replace(".csv", "", $file);
	shell_exec('sudo zip -j /home/ec2-user/Trimark/Output/ZippedFinal/'.$fileName.'.zip /home/ec2-user/Trimark/Output/FinalCSV/'.$file);

} */

$dir = scandir("/home/ec2-user/Trimark/Inputs/ConfigExtract");

for ($i = 2; $i < count($dir); $i++){
	$vendor = $dir[$i];
	
	$dir2 = '/home/ec2-user/Trimark/Inputs/ConfigExtract/'.$vendor.'/';
	$contents2 = scandir($dir2);
	//print_r($contents2);
	  
	for ($i = 2; $i < count($contents2);$i++){
		  $product = $contents2[$i];
		  
		  $xml = "/home/ec2-user/Trimark/Inputs/ConfigExtract/$vendor/".$product;
		  
		  //echo "This is xml file: " .$xml."\n";
		  
          $old = '<?xml version="1.0" encoding="utf-16"?>';
          $new = '<?xml version="1.0" encoding="utf-8"?>';
          //read the entire string
          $str = file_get_contents($xml);
            
          //replace something in the file string
          $str = str_replace('<?xml version="1.0" encoding="utf-16"?>', '<?xml version="1.0" encoding="utf-8"?>', $str);
            
          //write the entire string
          file_put_contents("/home/ec2-user/Trimark/Inputs/ConfigExtract/$vendor/".$product, $str);
		  
		  
		  /* /home/ec2-user/Trimark/Inputs/ConfigExtract/109c7505-434b-df11-beff-001ec95274b6 */
	
}
}

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: ".$execution_time." Mins"."\n";


?>