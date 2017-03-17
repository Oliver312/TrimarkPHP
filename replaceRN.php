<?php

ini_set('memory_limit', '-1');
set_time_limit(0);

$file='/home/ec2-user/Trimark/Inputs/ProdMerge/7ManufacturersMerged.json';
$json = file_get_contents($file);
$arr =json_decode($json);
$old = '\r\n';
$new = '';

//replace something in the file string - this is a VERY simple example
$json=str_replace("$old","$new",$json);

//write the entire string
file_put_contents($file,$json);

$json2 = file_get_contents($file);
$arr2 = json_decode($json2);
$old2 = '\n';

//replace something in the file string - this is a VERY simple example
$json2=str_replace("$old2","$new",$json2);
//write the entire string
file_put_contents($file,$json2);



/* $json = json_decode($json, true);
foreach ($json as $key => $value) {
    if (in_array('MetroMax', $value)) {
        unset($json[$key]);
    }
}
$json = json_encode($json); */


//read the entire string
//$str=file_get_contents($xml);


?>