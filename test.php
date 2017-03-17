<?php

 /*Returns a sorted list of keys from two arrays

    public static function get_keys( &$a, &$b )
    {
        $keys = array();
        foreach( $a as $k => $v ) $keys[$k] = 1;
        foreach( $b as $k => $v ) $keys[$k] = 1;
        ksort( $keys );
        return array_keys( $keys );
    } // get_keys*/
/*
$json_path = '/home/ec2-user/Trimark/Inputs/Index_Files/BackupJson/index.json';
$json_data = file_get_contents($json_path);

$json_path2 = '/home/ec2-user/Trimark/Inputs/Index_Files/RecentJson/index.json';
$json_data2 = file_get_contents($json_path2);

$a = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($json_data, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);
	
$b = new RecursiveIteratorIterator(
new RecursiveArrayIterator(json_decode($json_data2, TRUE)),
RecursiveIteratorIterator::SELF_FIRST);

$keys = array();
foreach ($a as $k => $val) $keys[$k];
foreach ($b as $k => $val) $keys[$k];
//Prints out every value in the Json file.
{
    if(is_array($val)) {
        echo "$k:\n";
    } else {
        echo "$k => $val\n";
    }
}

$result = array_diff($json_data,$json_data2);
print_r($result);*/

$json_path = '/home/ec2-user/Trimark/Inputs/Index_Files/BackupJson/index2.json';
$json_data = file_get_contents($json_path);
$json_backup = json_decode($json_data, true);


$json_path2 = '/home/ec2-user/Trimark/Inputs/Index_Files/RecentJson/index2.json';
$json_data2 = file_get_contents($json_path2);
$json_recent = json_decode($json_data2, true);

//$lines = file('/home/ec2-user/Trimark/Inputs/Index_Files/BackupJson/index.json');
//print_r($lines);

//$Array2 = json_decode($json_data2,true);
//print_r($Array2);

$result = array_diff($json_backup,$json_recent);
//print_r($result);
var_dump($json_backup);
?>