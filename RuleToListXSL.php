<?php

ini_set('memory_limit', '-1');
set_time_limit(0);
$time_start = microtime(true);
sleep(1);


shell_exec('find /home/ec2-user/Trimark/Inputs/temp_config/RuleToListXSL/ -name "*.csv" -print0 | xargs -0 rm');

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
			$xsl_doc->load('/home/ec2-user/Trimark/Inputs/XSL/RuleToList.xsl');

			// Proc
			$proc = new XSLTProcessor();
			$proc->setParameter('', 'VendorID', $vendor);
		    $proc->setParameter('', 'ModelID', $str2);
			$proc->importStylesheet($xsl_doc);
			ob_start();
			$proc->transformToURI($xml_doc, '/home/ec2-user/Trimark/Inputs/temp_config/RuleToListXSL/'.$str2.'.csv');
			$outputString = ob_get_flush();
	  }  
}

// RuleToList
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/RuleToListXSL/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleToList.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleToList.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/RuleToList.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');



$time_end = microtime(true);
$execution_time = ($time_end - $time_start)/60;
echo "Total Execution Time: " .$execution_time." Mins" . "\n";
?>