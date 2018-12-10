<?php
if(isset($_GET['template'])){
	
		$xml = simplexml_load_file('../../templates/scene_okbit/sc_templates/'.$_GET['template'].'/templateDetails.xml');

		foreach ($xml as $css) {			
			$temp_rec = $css->name;
			echo "obj.options[obj.options.length] = new Option('$temp_rec','$temp_rec');\n";
		}		
      }    
?> 