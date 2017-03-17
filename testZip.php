<?php
$CSVcontents = scandir('/home/ec2-user/Trimark/Output/FinalCSV');

for ($i = 2; $i < count($CSVcontents); $i++) {
    $file = $CSVcontents[$i];
	$fileName = str_replace(".csv", "", $file);
	shell_exec('sudo zip -j /home/ec2-user/Trimark/Output/ZippedFinal/'.$fileName.'.zip /home/ec2-user/Trimark/Output/FinalCSV/'.$file);

}

?>