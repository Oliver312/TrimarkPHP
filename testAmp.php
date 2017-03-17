<?php

	      shell_exec('/opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/ListProperties_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/00062f72-8ec9-de11-8d01-001ec95274b6/0d6710aa-a533-df11-b3a6-001ec95274b6.xml -p=VendorID:123 -p=ModelID:abc -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/TESTListProperties150/1.csv ; /opt/Altova/MapForceServer2017/bin/mapforceserver run /home/ec2-user/Trimark/Mfx/RuleToList_Map.mfx -p=InputFileName:/home/ec2-user/Trimark/Inputs/ConfigExtract-OLD/00062f72-8ec9-de11-8d01-001ec95274b6/0d6710aa-a533-df11-b3a6-001ec95274b6.xml -p=VendorID:456 -p=ModelID:def -p=OutputFileName:/home/ec2-user/Trimark/Inputs/temp_config/TESTRuleToList150/2.csv');
	      

?>