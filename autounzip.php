<?php



/*
$dir = '/home/ec2-user/Trimark/Inputs/Config/e3f5dfa6-be0d-dd11-a23a-00304834a8c9';
$contents = scandir($dir);
print_r($contents);

foreach ($contents as $value) { 
shell_exec('unzip '.$value.' -d /home/ec2-user/Trimark/Inputs/Config/ABC');
shell_exec('mv /home/ec2-user/Trimark/Inputs/Config/ABC/config.xml /home/ec2-user/Trimark/Inputs/Config/ABC/'.$value.'.xml');
echo ($value);
}

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      //echo "filename:" . $file . "\n";
	  shell_exec('unzip '.$file.' -d /home/ec2-user/Trimark/Inputs/Config/ABC');
	  shell_exec('mv /home/ec2-user/Trimark/Inputs/Config/ABC/config.xml /home/ec2-user/Trimark/Inputs/Config/ABC/'.$file.'.xml');

    }
    closedir($dh);
  }
}
*/

//$dir = '/home/ec2-user/Trimark/Inputs/Config/e3f5dfa6-be0d-dd11-a23a-00304834a8c9';
//$contents = scandir($dir);
//print_r($contents);
/*foreach ($contents as $value) { 
shell_exec('unzip '.$value.' -d /home/ec2-user/Trimark/Inputs/Config/ABC');
shell_exec('mv /home/ec2-user/Trimark/Inputs/Config/ABC/config.xml /home/ec2-user/Trimark/Inputs/Config/ABC/'.$value.'.xml');
echo ($value);
}*/

// Open a directory, and read its contents
/*if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      //echo "filename: " . $file . "\n";
	  //echo $file[0];
	  shell_exec('unzip /home/ec2-user/Trimark/Inputs/Config/e3f5dfa6-be0d-dd11-a23a-00304834a8c9/'.$file.' -d /home/ec2-user/Trimark/Inputs/Config/SICO');
	  shell_exec('mv /home/ec2-user/Trimark/Inputs/Config/SICO/config.xml /home/ec2-user/Trimark/Inputs/Config/SICO/'.$file.'.xml');

    }
    closedir($dh);
  }
} */

//shell_exec('rm /home/ec2-user/Trimark/Inputs/Prod/index.json');
$dir = '/home/ec2-user/Trimark/Inputs/SICO/AllConfig/e3f5dfa6-be0d-dd11-a23a-00304834a8c9';
$contents = scandir($dir);
//print_r($contents);
$output = array_slice($contents,2);
shell_exec('sudo rm -r /home/ec2-user/Trimark/Inputs/SICO/ConfigExtract');
shell_exec('mkdir /home/ec2-user/Trimark/Inputs/SICO/ConfigExtract');

foreach ($output as $file){
      //echo "filename: " . $file . "\n";
	  //echo $file[0];
	  $ConfigFileName = str_replace(".zip","",$file);
	  shell_exec('unzip /home/ec2-user/Trimark/Inputs/SICO/AllConfig/e3f5dfa6-be0d-dd11-a23a-00304834a8c9/'.$file.' -d /home/ec2-user/Trimark/Inputs/SICO/ConfigExtract/'.$ConfigFileName);
	  shell_exec('cp /home/ec2-user/Trimark/Inputs/SICO/ConfigExtract/'.$ConfigFileName.'/config.xml /home/ec2-user/Trimark/Inputs/SICO/ActualExtract/e3f5dfa6-be0d-dd11-a23a-00304834a8c9/'.$ConfigFileName.'.xml');

    }

?>