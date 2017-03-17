<?php

  //File path of final result
    $filepath = "/home/ec2-user/Trimark/Inputs/ProdMerge/Lekue-ASCII-Filter.txt";

/*     $out = fopen($filepath, "w");
    //Then cycle through the files reading and writing.

      foreach($filepathsArray as $file){
          $in = fopen($file, "r");
          while ($line = fgets($in)){
                print $file;
               fwrite($out, $line);
          }
          fclose($in);
      }

    //Then clean up
    fclose($out);

    return $filepath; */
	$fp1 = fopen($filepath, "a+");
	$file2 = file_Get_contents("/home/ec2-user/Trimark/Inputs/ProdMerge/Perlick-ASCII-Filter.txt");
	//$file3 = file_Get_contents("/home/ec2-user/Trimark/Inputs/Config/testxml/textfiles/2.txt");
	fwrite($fp1,$file2);
	
?>