<?php

ini_set('memory_limit', '-1');
set_time_limit(0);
$time_start = microtime(true);
sleep(1);

$dir = '/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD';
$contents = scandir($dir);
$output = array_slice($contents,0,3);

for ($i = 2; $i < count($contents);$i++){
	  $vendor = $contents[$i];
	  //echo "The vendors: " . $vendor ."\n";
	  
	  $dir2 = '/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/'.$vendor.'/';
	  $contents2 = scandir($dir2);

	  for ($a = 2; $a < count($contents2);$a++){
		  $product = $contents2[$a];
		  $str2 = str_replace(".xml","",$product);
		  
		  
		  	// XML
			$xml_doc = new DOMDocument();
			$xml_doc->load('/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/'.$vendor.'/'.$product);

			// XSL
			$xsl_doc = new DOMDocument();
			$xsl_doc->load('/home/ec2-user/Trimark/Inputs/XSL/ListProperties.xsl');

			// Proc
			$proc = new XSLTProcessor();
			$proc->setParameter('', 'VendorID', $vendor);
		    $proc->setParameter('', 'ModelID', $str2);
			$proc->importStylesheet($xsl_doc);
			ob_start();
			$proc->transformToURI($xml_doc, 'php://output') > /home/ec2-user/Trimark/Inputs/temp_config/ListPropertiesXSL/$str2.csv;
			$outputString = ob_get_flush();
	  }  
}

// ListProperties
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/ListPropertiesXSL/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPropertiesXSL.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPropertiesXSL.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/ListPropertiesXSL.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');



$time_end = microtime(true);
$execution_time = ($time_end - $time_start)/60;
echo "Total Execution Time: " .$execution_time." Mins" . "\n";
?>