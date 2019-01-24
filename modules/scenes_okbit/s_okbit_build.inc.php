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
	$rec_templates = SQLSelectOne("SELECT * FROM scenes_okbit WHERE SCENES_ID='".$rec['ID']."'");
	
	$elm_states = Array();
	
	$contents = file_get_contents('./templates/scenes_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/index.php');
	
	$xml = simplexml_load_file('./templates/scenes_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/templateDetails.xml');

	//подключаем нужный стиль
	foreach ($xml as $css) {			
		$temp_rec = $css->name;					
		if ($rec_templates['TEMPLATE_CSS'] == $temp_rec) $temp_css = $css->files;
	}	
	$contents_css = file_get_contents('./templates/scenes_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/css/'.$temp_css.'.css');
	
	//счситываем все элементы данной сцены
	
	$elm_html = SQLSelect("SELECT * FROM scenes_element_okbit WHERE PARENT_ID='".$rec_templates['ID']."' ORDER BY PRIORITY DESC");
	$total_html=count($elm_html);
	
	
	
	//заполняем наши позиции считанные из файла xml	
	
	foreach ($xml as $position) {
		if($position->namePosition){
			$rec_h = SQLSelectOne("SELECT * FROM elements WHERE SCENE_ID='".$rec['ID']."' AND TITLE='".$position->namePosition."'");
			$elm_h_states = SQLSelectOne("SELECT * FROM elm_states WHERE ELEMENT_ID='".$rec_h['ID']."'");
			$elm_h_states['ELEMENT_ID'] = $rec_h['ID'];
			$elm_h_states['TITLE'] = 'default';
			$html_in = file_get_contents('./templates/scenes_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/position/'.$position->positionFile.'.php');
			//перебираем элементы сцены 
			$li_html ='';

			for($i=0; $i<$total_html; $i++) {
								
				if ($elm_html[$i]['POSITION'] == $position->namePosition){
					$li_html = $li_html.'<li>'.$elm_html[$i]['HTML'].'</li>'. PHP_EOL;
				}
			}


			$html_in = str_replace('{{'.$position->namePosition.'}}','<ul>'.$li_html.'</ul>',$html_in);

			
			$html_in = str_replace('{{TITLE}}',$rec['TITLE'],$html_in);
			
			$html_in = str_replace('{{ADDITION}}',$rec_templates['ADDITION'],$html_in);
			
			$html_in = str_replace('{{HOME_SCENE}}',$rec_templates['HOME_SCENE'],$html_in);
			
			//прописываем в файле стиля класс для element_ваш_id
			$contents_css = str_replace('{{'.$position->namePosition.'}}','element_'.$rec_h['ID'].'',$contents_css);
	
			if ($position->namePosition == 'LEFT'){ //обработка шаблона ROOM с и скрытие его подменю элементов
				
				$xml2 = simplexml_load_file('./templates/scenes_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/templateDetails.xml');
				
				
				foreach ($xml2 as $position) {
					if($position->namePosition){
						$rec_elm = SQLSelectOne("SELECT * FROM elements WHERE SCENE_ID='".$rec['ID']."' AND TITLE='".$position->namePosition."'");
						if ($rec_elm['ID'] && $position->namePosition != 'LEFT') {
							$rec_state = SQLSelectOne("SELECT * FROM elm_states WHERE ELEMENT_ID='".$rec_elm['ID']."'");
							$html_in = str_replace('{{'.$position->namePosition.'}}','state_'.$rec_state['ID'].'',$html_in);
						}			
					}
				}
		
				
				$rec_elm = SQLSelectOne("SELECT * FROM elements WHERE SCENE_ID='".$rec['ID']."' AND TITLE='LEFT'");
				$rec_state = SQLSelectOne("SELECT * FROM elm_states WHERE ELEMENT_ID='".$rec_elm['ID']."'");
			}
			
			
			
			$elm_h_states['HTML'] = $html_in;
			
			SQLUpdate('elm_states', $elm_h_states);
			
		}
	}
	
	/*
	$xml2 = simplexml_load_file('./templates/scenes_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/templateDetails.xml');
	$html_left = file_get_contents('./templates/scenes_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/position/left.php');
	
	foreach ($xml2 as $position) {
		if($position->namePosition){
			$rec_elm = SQLSelectOne("SELECT * FROM elements WHERE SCENE_ID='".$rec['ID']."' AND TITLE='".$position->namePosition."'");
			if ($rec_elm['ID'] && $position->namePosition != 'LEFT') {
				$rec_state = SQLSelectOne("SELECT * FROM elm_states WHERE ELEMENT_ID='".$rec_elm['ID']."'");
				$html_left = str_replace('{{'.$position->namePosition.'}}','element_'.$rec_state['ID'].'',$html_left);
			}			
		}
	}
	
	
	$rec_elm = SQLSelectOne("SELECT * FROM elements WHERE SCENE_ID='".$rec['ID']."' AND TITLE='LEFT'");
	$rec_state = SQLSelectOne("SELECT * FROM elm_states WHERE ELEMENT_ID='".$rec_elm['ID']."'");

	$rec_state['HTML'] = $html_left;			
	SQLUpdate('elm_states', $rec_state);
	*/
	
	
	$header_li = '';
	
	if ($rec_templates['HOME_SCENE']!='0' && $rec_templates['CLONE_MENU']==1){//Копируем меню главной сцены в дочерний
		//Донор
		$don_scene = SQLSelectOne("SELECT * FROM scenes_okbit WHERE SCENES_ID='".$rec_templates['HOME_SCENE']."'");
		
		$elm_html_don = SQLSelect("SELECT * FROM scenes_element_okbit WHERE PARENT_ID='".$don_scene['ID']."' AND POSITION='HEADER' ORDER BY PRIORITY DESC");
		$total_html_don=count($elm_html_don);
		
		for($i=0;$i<$total_html_don;$i++) {
			$header_li = $header_li.'<li>'.$elm_html_don[$i]['HTML'].'</li>'. PHP_EOL;
		}
		
		$header = file_get_contents('./templates/scenes_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/position/header.php');
		
		$header = str_replace('{{TITLE}}',$rec['TITLE'],$header);
		$header = str_replace('{{HOME_SCENE}}',$rec_templates['HOME_SCENE'],$header);
		
		$header = str_replace('{{HEADER}}','<ul>'.$header_li.'</ul>',$header);
		
		//Вставка
		$rec_element_new = SQLSelectOne("SELECT * FROM elements WHERE SCENE_ID='".$rec['ID']."' AND TITLE='HEADER'");
		$elm_h_states_new = SQLSelectOne("SELECT * FROM elm_states WHERE ELEMENT_ID='".$rec_element_new['ID']."'");
		
		$elm_h_states_new['HTML'] = $header;
		
		
		SQLUpdate('elm_states', $elm_h_states_new);

	}
	
	
	if ($rec_templates['HOME_IMG']==''){
		$contents_css = str_replace('{{HOME_IMG}}','../../templates/scenes_okbit/sc_templates/'.$rec_templates['TEMPLATE'].'/images/home_'.$rec_templates['TEMPLATE_CSS'].'.png',$contents_css);
	}	
	else {
		$contents_css = str_replace('{{HOME_IMG}}',$rec_templates['HOME_IMG'],$contents_css);
	}
	
	$contents_css = str_replace('{{ID}}',$rec_templates['SCENES_ID'],$contents_css);
	
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
		
		
		$elm_states['ELEMENT_ID'] = $rec_element['ID'];
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
		SQLUpdate('elements', $rec_element);
		
		$elm_states = SQLSelectOne("SELECT * FROM elm_states WHERE ELEMENT_ID='".$rec_element['ID']."'");
		$elm_states['ELEMENT_ID'] = $rec_element['ID'];
		$elm_states['TITLE'] = 'default';
		
		
		$elm_states['HTML'] = $contents;
		
		SQLUpdate('elm_states', $elm_states);
	}

	


