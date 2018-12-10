<?php
/*
* @version 0.1 (wizard)
*/
  
  if ($this->owner->name == 'panel') {
	$out['CONTROLPANEL'] = 1;
}


	$table_name = 'scenes';

	$rec = SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id'" );
	


	$rec_element = SQLSelectOne("SELECT * FROM elements WHERE SCENE_ID='".$rec['ID']."' AND TITLE='scene_by_okbit.ru'");
	$rec_templates = SQLSelectOne("SELECT * FROM scene_okbit WHERE SCENES_ID='".$rec['ID']."'");
	
	$elm_states = Array();
	
	$contents = file_get_contents('./templates/scene_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/index.php');
	
	$xml = simplexml_load_file('./templates/scene_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/templateDetails.xml');

	//подключаем нужный стиль
	foreach ($xml as $css) {			
		$temp_rec = $css->name;					
		if ($rec_templates['TEMPLATE_CSS'] == $temp_rec) $temp_css = $css->files;
	}	
	$contents_css = file_get_contents('./templates/scene_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/css/'.$temp_css.'.css');
	
	//счситываем все элементы данной сцены
	
	$elm_html = SQLSelect("SELECT * FROM scene_element_okbit WHERE PARENT_ID='".$rec_templates['ID']."' ORDER BY PRIORITY DESC");
	$total_html=count($elm_html);
	
	
	
	//заполняем наши позиции считанные из файла xml	
	
	foreach ($xml as $position) {
		if($position->namePosition){
			$rec_h = SQLSelectOne("SELECT * FROM elements WHERE SCENE_ID='".$rec['ID']."' AND TITLE='".$position->namePosition."'");
			$elm_h_states = SQLSelectOne("SELECT * FROM elm_states WHERE ELEMENT_ID='".$rec_h[ID]."'");
			$elm_h_states['ELEMENT_ID'] = $rec_h[ID];
			$elm_h_states['TITLE'] = 'default';
			$html_in = file_get_contents('./templates/scene_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/position/'.$position->positionFile.'.php');
			
			//перебираем элементы сцены 
			$li_html ='';
			for($i=0;$i<$total_html;$i++) {
			
			
				if ($elm_html[$i]['POSITION'] == $position->namePosition){
					$li_html = $li_html.'<li>'.$elm_html[$i]['HTML'].'</li>';
				}
			}	
			
			$html_in = str_replace('{{'.$position->namePosition.'}}','<ul>'.$li_html.'</ul>',$html_in);
			
			$html_in = str_replace('{{TITLE}}',$rec['TITLE'],$html_in);
			
			$elm_h_states['HTML'] = $html_in;
			
			SQLUpdate(elm_states, $elm_h_states);
			
			//прописываем в файле стиля класс для element_ваш_id
			$contents_css = str_replace('{{'.$position->namePosition.'}}','element_'.$rec_h[ID].'',$contents_css);
		}
	}
	
	$contents = '';
	
	if ($rec_element['ID'] == '') {
		$rec_element['SCENE_ID'] = $rec['ID'];
		$rec_element['TITLE'] = 'scene_by_okbit.ru';
		$rec_element['TYPE'] = 'html';
		$rec_element['CSS'] = $contents_css;
		$rec_element['TOP'] = 0;
		$rec_element['LEFT'] = 0;	
		$rec_element['PRIORITY'] = 10000;
		$rec_element['ID'] = SQLInsert(elements, $rec_element);
		
		
		$elm_states['ELEMENT_ID'] = $rec_element[ID];
		$elm_states['TITLE'] = 'default';
		$elm_states['HTML'] = $contents;
		
		SQLInsert(elm_states, $elm_states);
		
	
	} else {

		
		$rec_element['SCENE_ID'] = $rec['ID'];
		$rec_element['TITLE'] = 'scene_by_okbit.ru';
		$rec_element['TYPE'] = 'html';
		$rec_element['CSS'] = $contents_css;
		$rec_element['TOP'] = 0;
		$rec_element['LEFT'] = 0;	
		$rec_element['PRIORITY'] = 10000;
		SQLUpdate(elements, $rec_element);
		
		$elm_states = SQLSelectOne("SELECT * FROM elm_states WHERE ELEMENT_ID='".$rec_element[ID]."'");
		$elm_states['ELEMENT_ID'] = $rec_element[ID];
		$elm_states['TITLE'] = 'default';
		
		
		$elm_states['HTML'] = $contents;
		
		SQLUpdate(elm_states, $elm_states);
	}

	


