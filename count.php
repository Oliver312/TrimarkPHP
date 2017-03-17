<?php
/*
$file = '/home/ec2-user/Trimark/Inputs/Config/Perlick/theconfig.xml';

$xml = simplexml_load_file($file);

$galleries = $xml->galleries;

$gallery = $galleries->addChild('gallery');
$gallery->addChild('name', 'a gallery');
$gallery->addChild('filepath', 'path/to/gallery');
$gallery->addChild('thumb', 'mythumb.jpg');

$xml->asXML($file);
*/
$source = simplexml_load_file("/home/ec2-user/Trimark/Inputs/Config/Perlick/theconfig.xml");
//$xml = simplexml_load_file("/home/ec2-user/Trimark/Inputs/Config/Perlick/theconfig.xml");
$TestTag = $source->Test;
$BroTag = $source->bro;

$xml = simplexml_load_file("/home/ec2-user/Trimark/Inputs/Config/Perlick/testAppend.xml");

$galleries = $xml;

$gallery = $galleries->addChild('ConfigLogic');
$gallery->addChild('PKey', $TestTag);
$gallery->addChild('Description', $BroTag);

$xml->asXML("/home/ec2-user/Trimark/Inputs/Config/Perlick/testAppend.xml");

/*
  <ConfigLogic xsi:type="ListConfigLogic">
    <PKey>5b21c2a4-86b9-48a3-9fd4-e7e9715eca18</PKey>
    <Description>Note</Description>
    <Models>
      <ModelLogic xsi:type="AccessoryModelLogic">
        <PKey>7d398991-8768-48e3-8496-fffca4fd6baa</PKey>
        <VendorNum>1226</VendorNum>
        <Model>ZZPERL02ANOTE1</Model>
        <ModelHidden>true</ModelHidden>
      </ModelLogic>
    </Models>
    <ItemsVisibleByDefault>true</ItemsVisibleByDefault>
  </ConfigLogic>
 */

?>