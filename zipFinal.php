<?php

$CSVcontents = scandir('/home/ec2-user/Trimark/Output/FinalCSV');

for ($i = 2; $i < count($CSVcontents); $i++) {
    $file = $CSVcontents[$i];
	$fileName = str_replace(".csv", "", $file);
	shell_exec('sudo zip -j /home/ec2-user/Trimark/Output/ZippedFinal/'.$fileName.'.zip /home/ec2-user/Trimark/Output/FinalCSV/'.$file);

}

$XML_CSV = scandir('/home/ec2-user/Trimark/Output/FinalChangedCSV');

for ($i = 2; $i < count($XML_CSV); $i++) {
    $file2 = $XML_CSV[$i];
	$fileName2 = str_replace(".csv", "", $file2);
	shell_exec('sudo zip -j /home/ec2-user/Trimark/Output/ZippedFinal/'.$fileName2.'.zip /home/ec2-user/Trimark/Output/FinalCSV/'.$file2);

}

?>