<?php
/*
* @version 0.1 (wizard)
*/

	
  if ($this->owner->name == 'panel') {
	$out['CONTROLPANEL'] = 1;
	}
	
	global $element_id;
	global $scene_id;
	
	$ok = 1;


	$rec = SQLSelectOne("SELECT * FROM scenes_element_okbit WHERE ID='".$element_id."'");
	
	$res = SQLSelectOne("SELECT * FROM scenes_okbit WHERE ID='".$scene_id."'");
	
	$res_scene = SQLSelectOne("SELECT * FROM scenes WHERE ID='".$res['SCENES_ID']."'");

if ($this->mode == 'update') {
		global $title;
		$rec['TITLE'] = $title;
		if ($rec['TITLE'] == '') {
			$out['ERR_TITLE'] = 1;
			$ok = 0;
		}

		global $priority;
		if ($priority == '') $rec['PRIORITY'] = 0;
		else $rec['PRIORITY'] = $priority;
		
		global $position;
		$rec['POSITION'] =  $position ;
		if ($rec['POSITION'] == '') {
			$out['ERR_POSITION'] = 1;
			$ok = 0;
		}
		
		global $type;
		$rec['TYPE'] = $type;
		if ($rec['TYPE'] == '') {
			$out['ERR_TYPE'] = 1;
			$ok = 0;
		}
		
		global $scene_link;
		$rec['SCENE_LINK'] = $scene_link;
		
		global $ico;
		$rec['ICO'] = $ico;
		
		global $textarea;
		$rec['TEXTAREA'] = $textarea;
		
				
		global $linked_object;
		$rec['LINKED_OBJECT'] = trim($linked_object);
			
		global $linked_property;
		$rec['LINKED_PROPERTY'] = trim($linked_property);
			
		global $linked_method;
		$rec['LINKED_METHOD'] = trim($linked_method);
			
			
		$old_linked_object = $rec['LINKED_OBJECT'];
		$old_linked_property = $rec['LINKED_PROPERTY'];
			
		if ($old_linked_object && $old_linked_object != $rec['LINKED_OBJECT'] && $old_linked_property && $old_linked_property != $rec['LINKED_PROPERTY']) {
			removeLinkedProperty($old_linked_object, $old_linked_property, $this->name);
		}
		

		
		//обработка шаблонов элементов
		$contents = file_get_contents(DIR_MODULES.$this->name.'/elements/'.$rec['TYPE'].'_usual.php');
		$contents = str_replace('{{HREF}}',$rec['SCENE_LINK'],$contents);
		$contents = str_replace('{{ICO}}',$rec['ICO'],$contents);	
		$contents = str_replace('{{TITLE}}',$rec['TITLE'],$contents);
		$contents = str_replace('{{TEXTAREA}}',$rec['TEXTAREA'],$contents);
		$contents = str_replace('{{ELEMENT_ID}}',$rec['ID'],$contents);
		$contents = str_replace('{{OBJECT}}',$rec['LINKED_OBJECT'],$contents);
		$contents = str_replace('{{METOD}}',$rec['LINKED_METHOD'],$contents);
		$rec['HTML'] = $contents;
		
		

		
	if ($ok){		
		if ($rec['ID']) {// обновить элемент сцены
			SQLUpdate('scenes_element_okbit', $rec);
			
		} else { // создать элемент сцены
			$rec['PARENT_ID'] = $scene_id;
			$rec['ID'] = SQLInsert('scenes_element_okbit', $rec);
		}		
		
		$out['OK'] = 1;
	}
	else $out['ERR'] = 1;
}

	$pos_el ='';
	// получение списка позиций из xml файла
	$xml = simplexml_load_file('./templates/scenes_okbit/sc_templates/'.$res['TEMPLATE'].'/templateDetails.xml');
	foreach ($xml as $position) {		
	$temp_pos = $position->namePosition;
		if($temp_pos){
			$pos_el = $pos_el.'<option value='.$temp_pos.' >'.$temp_pos.'</option>'; 
		}
	}

	if ($rec['ID']){ //Выыод списка сцен 
		$all_scenes = '';
		if($rec['TYPE'] == 'link_ico' || $rec['TYPE'] == 'ico_link'){
			$res_all = SQLSelect("SELECT * FROM scenes ORDER BY PRIORITY DESC");
			for($i=0; $i < count($res_all) ;$i++){
				if($res_all[$i]['ID'] == $rec['SCENE_LINK']) $all_scenes = $all_scenes.'<option value="'.$res_all[$i]['ID'].'" selected>'.$res_all[$i]['TITLE'].'</option>';
				else $all_scenes = $all_scenes.'<option value="'.$res_all[$i]['ID'].'">'.$res_all[$i]['TITLE'].'</option>';
			}


		}	

	foreach ($xml as $ico) { //вывыд иконок ссылок полученым из xml файла
		$ico_val = $ico->filesIco;
		$ico_id = $ico_val['id'];
		$ico_pos = $ico['pos'];
		if($ico_val && $ico_pos == $rec['POSITION']){
			if ($ico_id == $rec['ICO'])$checked='checked';
			else $checked='';
			$img = $img . '<input name="ico" type="radio" id="'.$ico_val.'" value="'.$ico_id.'" '.$checked.'><label for="'.$ico_val.'"><img src="/templates/scenes_okbit/sc_templates/'.$res['TEMPLATE'].'/images/ico/'.$ico_val .'.png"></label>';
		}
	}	
	
	
	$rec['ICO_IMG'] = $img;
	
	$rec['SCENE_LINK'] = $all_scenes;
	
}

		
	if ($rec['LINKED_OBJECT'] && $rec['LINKED_PROPERTY']) {
		addLinkedProperty($rec['LINKED_OBJECT'], $rec['LINKED_PROPERTY'], $this->name);
	}

		
		
	
	$rec['POSIT'] = $pos_el;

	$rec['SCENE_ID'] = $scene_id;	
	
	$rec['SCENE_TITLE'] = $res_scene['TITLE'];


outHash($rec, $out);

