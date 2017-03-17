<?php


			$xml_doc = new DOMDocument();
			$xml_doc->load('/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/9fc8e7a0-be0d-dd11-a23a-00304834a8c9/96de5df3-bf0d-dd11-a23a-00304834a8c9.xml');

			// XSL
			$xsl_doc = new DOMDocument();
			$xsl_doc->load('/home/ec2-user/Trimark/Inputs/XSL/RuleToList.xsl');

			// Proc
			$proc = new XSLTProcessor();
			$proc->setParameter('', 'VendorID', "vendor");
		    $proc->setParameter('', 'ModelID', "model");
			$proc->importStylesheet($xsl_doc);
			ob_start();
			$proc->transformToURI($xml_doc, 'php://output');
			$outputString = ob_get_flush(); 
			
			//echo $outputString;
			//print $newdom->saveXML();

?>