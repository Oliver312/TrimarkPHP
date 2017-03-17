<?php
/*
//Original code *********************************
$doc1 = new DOMDocument();
$doc1->load('/home/ec2-user/Trimark/Inputs/Config/testxml/3.xml');

$doc2 = new DOMDocument();
$doc2->load('/home/ec2-user/Trimark/Inputs/Config/testxml/4.xml');

// get 'ArrayOfConfigLogic' element of document 1
$res1 = $doc1->getElementsByTagName('ArrayOfConfigLogic')->item(0);

// iterate over 'ConfigLogic' elements of document 2
$items2 = $doc2->getElementsByTagName('ConfigLogic');
for ($i = 0; $i < $items2->length; $i ++) {
$item2 = $items2->item($i);

// import/copy ConfigLogic from document 2 to document 1
$item1 = $doc1->importNode($item2, true);

// append imported item to document 1 'ArrayOfConfigLogic' element
$res1->appendChild($item1);

}
$doc1->save('/home/ec2-user/Trimark/Inputs/Config/testxml/merged.xml');
*/

$dir      = '/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract';
$contents = scandir($dir);
$output = array_slice($contents,2);
//print_r($output);

foreach ($output as $file) {
            //echo "filename:" . $file . "\n";
            $xml = '/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file;
            $old = '<?xml version="1.0" encoding="utf-16"?>';
            $new = '<?xml version="1.0" encoding="utf-8"?>';
            //read the entire string
            $str = file_get_contents($xml);
            
            //replace something in the file string
            $str = str_replace("$old", "$new", $str);
            
            //write the entire string
            file_put_contents($xml, $str);
            
			//shell_exec('sudo cp /home/ec2-user/Trimark/Inputs/Config-OLD/BaseFileBackup/BaseFile.xml /home/ec2-user/Trimark/Inputs/Config-OLD/BaseFile.xml')
			
            $doc1 = new DOMDocument();
            $doc1->load('/home/ec2-user/Trimark/Inputs/Config-OLD/BaseFile.xml');
            
            
            $doc2 = new DOMDocument();
            $doc2->load('/home/ec2-user/Trimark/Inputs/Perlick/ActualExtract/'.$file);
            
            // get 'ArrayOfConfigLogic' element of document 1
            $res1 = $doc1->getElementsByTagName('ArrayOfConfigLogic')->item(0);
            
            // iterate over 'ConfigLogic' elements of document 2
            $items2 = $doc2->getElementsByTagName('ConfigLogic');
            for ($i = 0; $i < $items2->length; $i++) {
                $item2 = $items2->item($i);
                
                // import/copy ConfigLogic from document 2 to document 1
                $item1 = $doc1->importNode($item2, true);
                
                // append imported item to document 1 'ArrayOfConfigLogic' element
                $res1->appendChild($item1);
				
				$doc1->save('/home/ec2-user/Trimark/Inputs/Config-OLD/BaseFile.xml');
                
            }
}

$doc1->save('/home/ec2-user/Trimark/Inputs/Perlick/PerlickMerged.xml');

?>