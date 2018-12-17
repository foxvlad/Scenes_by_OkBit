<?php
if(isset($_GET['template'])){
		$zap = $_GET['position'];
		$xml = simplexml_load_file('../../templates/scene_okbit/sc_templates/'.$_GET['template'].'/templateDetails.xml');

		foreach ($xml as $elements) {
			$element_val = $elements->nameElements;
			$element_name = $elements->titleElements;
			$id = $elements['pos'];
			if($element_val && $zap == $id){
				echo "obj.options[obj.options.length] = new Option('$element_name','$element_val');\n";
			}
		}		
}  
?> 