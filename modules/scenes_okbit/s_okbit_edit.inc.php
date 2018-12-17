<?php
/*
* @version 0.1 (wizard)
*/
	global $view_el;
	$out['VIEW_EL']=$view_el;
	
  
  if ($this->owner->name == 'panel') {
	$out['CONTROLPANEL'] = 1;
}



$table_name = 'scenes_okbit';

$rec = SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id'");
	
if ($rec['ID']) {
	$Record = SQLSelectOne("SELECT * FROM scenes WHERE ID='".$rec['SCENES_ID']."'");
	
}


	$out['UPDATED'] = $rec['UPDATED'];

if ($this->mode == 'update') {
	
	//DebMes("UPDATE ", 'scenes_okbit');

	$this->getConfig();
	$ok = 1;
	
	if ($this->tab == '') {

		global $title;
		$Record['TITLE'] = $title;
		if ($Record['TITLE'] == '') {
			$out['ERR_TITLE'] = 1;
			$ok = 0;
		}

		global $priority;
		$Record['PRIORITY'] = $priority;
		$rec['PRIORITY'] = $Record['PRIORITY'];
		
		global $templates;
		$rec['TEMPLATE'] = $templates;
		if ($rec['TEMPLATE'] == '') {
			$out['ERR_TYPE_S'] = 1;
			$ok = 0;
		}
		
		global $template_css;
		$rec['TEMPLATE_CSS'] = $template_css;
		if ($rec['TEMPLATE_CSS'] == '') {
			$out['ERR_TEMPLATE_CSS'] = 1;
			$ok = 0;
		}
		
		
				
	}

	if ($ok) {
		if ($rec['ID']) {
			
			//DebMes("ID - ".$Record['ID'].' Prioriti - '. $Record['PRIORITY'] , 'scenes_okbit');
			SQLUpdate('scenes', $Record);
			SQLUpdate($table_name, $rec);
			
		} else {
			
			$rec['SCENES_ID']=SQLInsert('scenes', $Record);				
			$rec['ID'] = SQLInsert($table_name, $rec);	
			

		//создаем в базе данных позиции длясцены, считаниые из xml файла	
			$xml = simplexml_load_file('./templates/scenes_okbit/sc_templates/'.$rec['TEMPLATE'].'/templateDetails.xml');
			foreach ($xml as $position) {
				if($position->namePosition){
						$rec_element = Array();
						$rec_element['SCENE_ID'] = $rec['SCENES_ID'];
						$rec_element['TITLE'] = $position->namePosition;
						$rec_element['TYPE'] = 'html';
						$rec_element['TOP'] = 0;
						$rec_element['LEFT'] = 0;	
						$rec_element['PRIORITY'] = $position->priority;
						$rec_element['ID'] = SQLInsert('elements', $rec_element);
							
						$elm_states['ELEMENT_ID'] = $rec_element['ID'];
						$elm_states['TITLE'] = 'default';
						$elm_states['HTML'] = '';						
						SQLInsert('elm_states', $elm_states);
				}
			}
		}
		
		$out['OK'] = 1;
		

		
	} else {
		$out['ERR'] = 1;
	}
}



if ($this->tab == 'data') {
	
	if ($view_el=='') {	
		//DebMes ("search-date", 'scenes_okbit');
		$res = SQLSelectOne("SELECT * FROM scenes_okbit WHERE ID='".$id."'");
		$res_temp = SQLSelectOne("SELECT * FROM scenes WHERE ID='".$res['SCENES_ID']."'");
		$rec['TITLE'] = $res_temp['TITLE'];
		
		$xml = simplexml_load_file('./templates/scenes_okbit/sc_templates/'.$res['TEMPLATE'].'/templateDetails.xml');
		$pos = 0;
		foreach ($xml as $position) {		
			if($position->namePosition){
				$res_pos[$pos]['POSIT'] = $position->namePosition;
				
				$qwe = SQLSelect("SELECT * FROM scenes_element_okbit WHERE PARENT_ID='".$res['ID']."' ORDER BY PRIORITY DESC");
					
					
					for($iq=0;$iq<count($res_pos);$iq++){
						$iu = 0;
						for($q=0;$q<count($qwe);$q++){

							if($res_pos[$iq]['POSIT'] == $qwe[$q]['POSITION']){

								$element_tp[$iu]['ELEMENT'] = $qwe[$q]['TITLE'];
								$element_tp[$iu]['PRIORITY'] = $qwe[$q]['PRIORITY'];
								$element_tp[$iu]['TYPE'] = $qwe[$q]['TYPE'];
								$element_tp[$iu]['ID'] = $id;
								$element_tp[$iu]['ELEMENT_ID'] = $qwe[$q]['ID'];
								$iu++;
							}
						}
						$res_pos[$pos]['ELEMENTS'] = $element_tp;
						$element_tp = array();
					}
					
					
					
					$result[$in]['POSITION'] = $res_pos;
					$result[$in]['TOTAL'] = $total_el;
				
				
				
				
				$pos++;

			}
		}
		$result['POSITION'] = $res_pos;
		$out['RESULT']=$result;
	
	}
	
	if ($view_el=='up_elements') { //поднять приоритет элемента
		global $element_id;
		$this->reorder_elements($element_id, 'up');
		$this->redirect("?id=".$rec['ID']."&view_mode=".$this->view_mode."&tab=".$this->tab);
	}

	if ($view_el=='down_elements') { //опустить приоритет элемента		
		global $element_id;
		$this->reorder_elements($element_id, 'down');
		$this->redirect("?id=".$rec['ID']."&view_mode=".$this->view_mode."&tab=".$this->tab);
	}
	
	if ($view_el=='delete_elements') { // удалить элемент
		global $element_id;
		$this->delete_elements($element_id);
		$this->redirect("?id=".$rec['ID']."&view_mode=".$this->view_mode."&tab=".$this->tab);
	}

	

}


else {

	if ($rec['ID']) {
		$new_rec = SQLSelectOne("SELECT * FROM scenes WHERE ID='".$rec['SCENES_ID']."'");

		$rec['TITLE'] = $new_rec['TITLE'];
		$rec['PRIORITY'] = $new_rec['PRIORITY'];
	}else{
		$rec['TITLE'] = $title;
	}


$filelist = array();

//Сканировнание папки со стилями оформления для вывода списка тем в выподающий список
	
	if ($handle = opendir('./templates/scenes_okbit/sc_templates')) {

		while (false !== ($file = readdir($handle))) { 
			if ($file != "." && $file != "..") {
				$filelist[] = $file;
			}
		}
		closedir($handle); 
	}

	$dropdown = $filelist;



	$total = count($dropdown);
	$text_html = '';

	for($i = 0; $i < $total; $i++) { 
		if ($rec['TEMPLATE'] == $dropdown[$i]) $text_html = $text_html . '<option value='.$dropdown[$i].' selected>'.$dropdown[$i].'</option>';
		else $text_html = $text_html.'<option value='.$dropdown[$i].' >' .$dropdown[$i].'</option>';
	} 
	
	
	if ($rec['TEMPLATE']) {	
		$xml = simplexml_load_file('./templates/scenes_okbit/sc_templates/'.$rec['TEMPLATE'].'/templateDetails.xml');
		foreach ($xml as $css) {		
			$temp_rec = $css->name;
			if($temp_rec){
				if ($rec['TEMPLATE_CSS'] == $temp_rec) {
					$text_css = $text_css.'<option value='.$temp_rec.' selected>'.$temp_rec.'</option>';
					$temp_img = $css->img_ico;
				}
				else $text_css = $text_css.'<option value='.$temp_rec.' >'.$temp_rec.'</option>'; 
			}
		}	
	}
		

	$rec['TEMPLATE_SEARH'] = $text_html;
	$rec['TEMPLATE_CSS'] = $text_css;
	
	$rec['TEMPLATE_IMG'] = '/templates/scenes_okbit/sc_templates/'.$rec['TEMPLATE'].'/images/'.$temp_img.'.png';
}

outHash($rec, $out);

