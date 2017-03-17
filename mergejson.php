<?php
ini_set('memory_limit', '-1');
set_time_limit(0);

/* //ORIGINAL CODE**************
$perlick = file_get_contents('/home/ec2-user/Trimark/Inputs/ProdMerge/2.json');
$vollrath = file_get_contents('/home/ec2-user/Trimark/Inputs/Config/testxml/vollrath.json');
$mini = file_get_contents('/home/ec2-user/Trimark/Inputs/ProdMerge/1.json');

$array1 = json_decode($mini,true);
$array2 = json_decode($perlick,true);

$final = array_merge($array1,$array2);
$jsonData = json_encode($final);
file_put_contents('/home/ec2-user/Trimark/Inputs/ProdMerge/merge.json', $jsonData,FILE_APPEND); */

$dir = '/home/ec2-user/Trimark/Inputs/ProdMerge/PerlickVollrath';
$contents = scandir($dir);
//print_r($contents);
//$contents[2];

//$baseFile = file_get_contents('/home/ec2-user/Trimark/Inputs/Prod/Extract/100'.$contents[2]);
$empty = file_get_contents('/home/ec2-user/Trimark/Inputs/ProdMerge/empty2.json');

if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){

		$jsonFiles = file_get_contents('/home/ec2-user/Trimark/Inputs/ProdMerge/PerlickVollrath/'.$file);

		$array1 = json_decode($empty,true);
		$array2 = json_decode($jsonFiles,true);

		$final = array_merge($array1,$array2);
		$jsonData = json_encode($final);
		file_put_contents('/home/ec2-user/Trimark/Inputs/ProdMerge/empty2.json', $jsonData,FILE_APPEND);
    }
    closedir($dh);
  }
}
/* $files = array();
for($i = 0, $i < 5 && $i < count($contents); $i++) {
    $fn = $dir . $items[$i];
    if(is_file($fn)) {
        $files[] = $fn;

    }
} */




?>