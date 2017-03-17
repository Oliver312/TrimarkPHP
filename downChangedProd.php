<?php
$time_start = microtime(true);
sleep(1);

/* // Dakota Server Login Info

$ftp_server = "50.22.53.24";
$ftp_user = "trimark";
$ftp_pass = "WQnZ2r8dBt8nfPrNMoqQP3T8";

// Change Dakota Directory
chdir('/home/ec2-user/Trimark/Inputs/TestConfigDownload');
echo "Dakota Directory has changed to: " . getcwd() . "\n";

// set up a connection or die
$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server");

// Logs into FTP Server
if (@ftp_login($conn_id, $ftp_user, $ftp_pass))
{
	echo "Connection Successful! - Connected as $ftp_user@$ftp_server\n";
}
else
{
	echo "Couldn't connect as $ftp_user\n";
}

ftp_pasv($conn_id, true);

// Change the directory to somedir
if (ftp_chdir($conn_id, "/radektest/config/"))
{
	echo "Current FTP Directory: " . ftp_pwd($conn_id) . "\n";
}
else
{
	echo "Couldn't change directory\n";
}

//Reads text file produced by MapForce - Contains names of files whose Hash value has changed
$text  = "/home/ec2-user/Trimark/Inputs/HashChanges/ProductFiles.txt";
$lines = array();
$fp    = fopen($text, 'r');

//While loop - While the text file still has content. It stores every line in a variable '$line' and downloads that file from FTP server
while (!feof($fp)) {
$line = fgets($fp);
$line = trim($line);
$lines[]  = $line;
$fileName = str_replace(".zip", "", $line);

ftp_get($conn_id, "/home/ec2-user/Trimark/Inputs/TestConfigDownload/" . $line, $line, FTP_BINARY);

}
fclose($fp);

//RESTRICTION LIST
//FILES INSIDE THE RESTRICTION LIST ARE REMOVED FROM THE DOWNLOADED VENDORS
//Reads text file produced by MapForce - Contains names of files whose Hash value has changed
$text2  = "/home/ec2-user/Trimark/Inputs/RestrictionList.txt";
$lines2 = array();
$fp2    = fopen($text2, 'r');
//While loop - While the text file still has content. It stores every line in a variable '$line' and downloads that file from FTP server
while (!feof($fp2)) {
$line2 = fgets($fp2);
$line2 = trim($line2);
$lines2[]  = $line2;

shell_exec('sudo rm /home/ec2-user/Trimark/Inputs/TestConfigDownload/'.$line2);

}
fclose($fp2);

shell_exec('sudo rm -r /home/ec2-user/Trimark/Inputs/TestConfig/*');
//Every file in the directory gets unzipped and the Index file is copied to "./Inputs/Index_Files/Products/RecentJson/$todaysDate"
$dir      = '/home/ec2-user/Trimark/Inputs/TestConfigDownload';
$contents = scandir($dir);

for ($i = 2; $i < count($contents); $i++) {
$vendor     = $contents[$i];
$vendorName = str_replace(".zip", "", $vendor);

shell_exec('sudo mkdir /home/ec2-user/Trimark/Inputs/TestConfig/'.$vendorName);
// shell_exec('sudo mkdir /home/ec2-user/Trimark/Inputs/TestConfigExtract-Step1/'.$vendorName);

shell_exec('sudo unzip /home/ec2-user/Trimark/Inputs/TestConfigDownload/' . $vendor . ' -d /home/ec2-user/Trimark/Inputs/TestConfig/' . $vendorName . '/');
shell_exec('sudo cp /home/ec2-user/Trimark/Inputs/TestConfig/' . $vendorName . '/index.json /home/ec2-user/Trimark/Inputs/Index_Files/Products/RecentJson/20170207/' . $vendorName . '-new.json');

}

//Uses those Index files as inputs to the Comparison Logic Map and outputs a txt file with the Vendor files that need to be opened
$dir2 = '/home/ec2-user/Trimark/Inputs/Index_Files/Products/RecentJson/20170207';
$contents2 = scandir($dir2);

for ($i = 2; $i < count($contents2); $i++)
{
	$json = $contents2[$i];
	$jsonOld = str_replace("-new", "-old", $json);
	$jsonName = str_replace("-new.json", "", $json);
	shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/CompareDiffHashes-PROD.mfx -p=TodaysFile:/home/ec2-user/Trimark/Inputs/Index_Files/Products/RecentJson/20170207/' . $json . ' -p=OldFile:/home/ec2-user/Trimark/Inputs/Index_Files/Products/BackupJson/20170207/' . $jsonOld . ' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/HashChanges/VendorOfProducts/' . $jsonName . '.txt >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
}
 */
//Removes contents in ConfigExtract-step 1 and 2 before filling up that directory with new content
shell_exec('sudo rm -r /home/ec2-user/Trimark/Inputs/TestConfigExtract-Step1/*');
shell_exec('sudo rm -r /home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/*');
$dir3 = '/home/ec2-user/Trimark/Inputs/HashChanges/VendorOfProducts';
$contents3 = scandir($dir3);

for ($i = 2; $i < count($contents3); $i++)
{
	$vendorFile = $contents3[$i];
	$vendorFileName = str_replace(".txt", "", $vendorFile);
	$text = "/home/ec2-user/Trimark/Inputs/HashChanges/VendorOfProducts/$vendorFile";
	$lines = array();
	$fp = fopen($text, 'r');
	while (!feof($fp))
	{
		$line = fgets($fp);
		$line = trim($line);
		$lines[] = $line;
		$fileName = str_replace(".zip", "", $line);
		$makeVenProd = '/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/' . $vendorFileName;
		shell_exec('sudo unzip /home/ec2-user/Trimark/Inputs/TestConfig/' . $vendorFileName . '/' . $line . ' -d /home/ec2-user/Trimark/Inputs/TestConfigExtract-Step1/' . $fileName);
		shell_exec('sudo mkdir -p ' . $makeVenProd . ' && cp /home/ec2-user/Trimark/Inputs/TestConfigExtract-Step1/' . $fileName . '/config.xml /home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/' . $vendorFileName . '/' . $fileName . '.xml');
		
		//echo "This is the config file: " . "/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/$vendorFileName/$fileName.xml" . "\n";

		// This starts the mappings
		// Converts all XML files into UTF-8 so the files are valid for mapping
		$xmlFile = "/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/$vendorFileName/$fileName.xml";
		$old = '<?xml version="1.0" encoding="utf-16"?>';
		$new = '<?xml version="1.0" encoding="utf-8"?>';

		// read the entire string
		$str = file_get_contents($xmlFile);

		// replace something in the file string
		$str = str_replace("$old", "$new", $str);

		// write the entire string
		file_put_contents($xmlFile, $str);
		
		//ListProperties
		shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/' . $vendorFileName . '/' . $fileName . '.xml -p=VendorID:' . $vendorFileName . ' -p=ModelID:' . $fileName . ' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListProperties/' . $fileName . '.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
		
		//ListSelections
		shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/' . $vendorFileName . '/' . $fileName . '.xml -p=VendorID:' . $vendorFileName . ' -p=ModelID:' . $fileName . ' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/ListSelections/ListSel'.$fileName.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
		
		//RuleConditions
		shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleConditions2_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/' . $vendorFileName . '/' . $fileName . '.xml -p=VendorID:' . $vendorFileName . ' -p=ModelID:' . $fileName . ' -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleConditions/RuleCond'.$fileName.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
		
		//RuleToList
		shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/TestConfigExtract-Step2/' . $vendorFileName . '/' . $fileName . '.xml -p=VendorID:' . $vendorFileName . ' -p=ModelID:' . $fileName . '  -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/RuleToList/RuleToList'.$fileName.'.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
		
	}
	fclose($fp);
}

// ListProperties
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/ListProperties/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/ListPMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/ListProperties.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

// ListSelections
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/ListSelections/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/ListSelMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeListSelections_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/ListSelMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/ListSelections.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

//RuleConditions
shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/RuleConditions/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleCondMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleConditions_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleCondMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/RuleConditions.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

shell_exec('sudo find /home/ec2-user/Trimark/Inputs/temp_config/RuleToList/ -name "*.csv" -exec cat "{}" ";" > /home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleToListMerged.csv');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeRuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/temp_config/Merged/RuleToListMerged.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalChangedCSV/RuleToList.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');

//******************************************************************************************
//This is the process for CSV files that require JSON File as inputs

$contents4 = scandir('/home/ec2-user/Trimark/Inputs/ProdExtract');

//Removes previous CSV Files for Concat
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/AddlItemDataCSV/ -name "*.csv" -print0 | xargs -0 rm');
//shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/CasePricingCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/CertificationCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/ElectricalCSV/ -name "*.csv" -print0 | xargs -0 rm');
//shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/FlyersCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/FOBCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/GasSteamCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/HVACCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/ModelDataCSV/ -name "*.csv" -print0 | xargs -0 rm');
shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/PlumbingCSV/ -name "*.csv" -print0 | xargs -0 rm');
//shell_exec('find /home/ec2-user/Trimark/Output/AllCSV/QtyPricingCSV/ -name "*.csv" -print0 | xargs -0 rm');

for ($i = 2; $i < count($contents4); $i++) {
    $file = $contents4[$i];
    
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/AddlItemData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/AddlItemDataCSV/AddlItemData' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/CasePricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/CasePricingCSV/CasePricing' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Certification_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/CertificationCSV/Certifications' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Electrical_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/ElectricalCSV/Electrical' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Flyers_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/FlyersCSV/Flyers' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/FOB_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/FOBCSV/FOB' . $i . '.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/GasSteam_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/GasSteamCSV/GasSteam' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/HVAC_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/HVACCSV/HVAC' . $i . '.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
    shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ModelData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/ModelDataCSV/ModelData' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
	shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/Plumbing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/PlumbingCSV/Plumbing' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
   //shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/QtyPricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ProdExtract/' . $file . ' -p=OutputFileName:/home/ec2-user/Trimark/Output/AllCSV/QtyPricingCSV/QtyPricing' . $i . '.csv >> /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


}



//Concats all the CSV files
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/AddlItemDataCSV/AddlItemData*.csv > /home/ec2-user/Trimark/Output/Merged/AddlItemData.csv');
//shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/CasePricingCSV/CasePricing*.csv > /home/ec2-user/Trimark/Output/Merged/CasePricing.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/CertificationCSV/Certifications*.csv > /home/ec2-user/Trimark/Output/Merged/Certifications.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/ElectricalCSV/Electrical*.csv > /home/ec2-user/Trimark/Output/Merged/Electrical.csv');
//shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/FlyersCSV/Flyers*.csv > /home/ec2-user/Trimark/Output/Merged/Flyers.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/FOBCSV/FOB*.csv > /home/ec2-user/Trimark/Output/Merged/FOB.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/GasSteamCSV/GasSteam*.csv > /home/ec2-user/Trimark/Output/Merged/GasSteam.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/HVACCSV/HVAC*.csv > /home/ec2-user/Trimark/Output/Merged/HVAC.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/ModelDataCSV/ModelData*.csv > /home/ec2-user/Trimark/Output/Merged/ModelData.csv');
shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/PlumbingCSV/Plumbing*.csv > /home/ec2-user/Trimark/Output/Merged/Plumbing.csv');
//shell_exec('sudo cat /home/ec2-user/Trimark/Output/AllCSV/QtyPricingCSV/QtyPricing*.csv > /home/ec2-user/Trimark/Output/Merged/QtyPricing.csv');



//Adds metadata rows to the merged CSV files
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeAddlItemData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/AddlItemData.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/AddlItemData.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
//shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeCasePricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/CasePricing.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/CasePricing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeCertification_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/Certifications.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/Certifications.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeElectrical_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/Electrical.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/Electrical.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
//shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeFlyers_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/Flyers.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/Flyers.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeFOB_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/FOB.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/FOB.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeGasSteam_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/GasSteam.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/GasSteam.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeHVAC_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/HVAC.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/HVAC.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeModelData_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/ModelData.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/ModelData.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergePlumbing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/Plumbing.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/Plumbing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');
//shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/MergeQtyPricing_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Output/Merged/QtyPricing.csv -p=OutputFileName:/home/ec2-user/Trimark/Output/FinalCSV/QtyPricing.csv > /home/ec2-user/Trimark/Logs/MapforceMap-log.txt 2>&1');


$CSVcontents = scandir('/home/ec2-user/Trimark/Output/FinalCSV');

for ($i = 2; $i < count($CSVcontents); $i++) {
    $file = $CSVcontents[$i];
	$fileName = str_replace(".csv", "", $file);
	shell_exec('sudo zip -j /home/ec2-user/Trimark/Output/ZippedFinal/'.$fileName.'.zip /home/ec2-user/Trimark/Output/FinalCSV/'.$file);

}



$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
echo "Total Execution Time: " . $execution_time . " Mins" . "\n";
?>