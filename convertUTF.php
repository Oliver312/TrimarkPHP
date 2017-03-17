<?php
$xml = '/home/ec2-user/Trimark/Inputs/Config/testxml/merged16.xml';
$old = '<?xml version="1.0" encoding="utf-16"?>';
$new = '<?xml version="1.0" encoding="utf-8"?>';

$oldMessage = "";

$deletedFormat = "";

//read the entire string
$str=file_get_contents($xml);

//replace something in the file string - this is a VERY simple example
$str=str_replace("$old", "$new",$str);

//write the entire string
file_put_contents($xml, $str);


?>