<?php
/*
* @version 0.1 (wizard)
*/
 global $session;
  if ($this->owner->name=='panel') {
   $out['CONTROLPANEL']=1;
  }
  $qry="1";
  // search filters
  // QUERY READY
  global $save_qry;
  if ($save_qry) {
   $qry=$session->data['s_okbit_qry'];
  } else {
   $session->data['s_okbit_qry']=$qry;
  }
  if (!$qry) $qry="1";
  $sortby_s_okbit="PRIORITY DESC";
  $out['SORTBY']=$sortby_s_okbit;
  // SEARCH RESULTS
  $res=SQLSelect("SELECT * FROM scenes_okbit WHERE $qry  ORDER BY PRIORITY DESC");
  
  $state_active = SQLSelectOne("SELECT * FROM event WHERE ID=1");

  
  if ($res[0]['ID']) {
   //paging($res, 100, $out); // search result paging
   $total=count($res);
	$in = 0;
	for($i=0;$i<$total;$i++) {
		// some action for every record if required
		$res_temp = SQLSelectOne("SELECT * FROM scenes WHERE ID='".$res[$i]['SCENES_ID']."'");
		if ($res_temp){
			$result[$in] = $res_temp;
			$result[$in]['ID'] = $res[$i]['ID'];
			$result[$in]['TEMPLATE'] = $res[$i]['TEMPLATE'];
			$result[$in]['SCENES_ID'] = $res[$i]['SCENES_ID'];
			$result[$in]['TEMPLATE_CSS'] = $res[$i]['TEMPLATE_CSS'];
						
			
			$xml = simplexml_load_file('./templates/scenes_okbit/sc_templates/'.$result[$in]['TEMPLATE'].'/templateDetails.xml');

			foreach ($xml as $css) {			
				$temp_rec = $css->name;					
				if ($result[$in]['TEMPLATE_CSS'] == $temp_rec) 	$temp_img = $css->img_ico;
			}			
			$result[$in]['TEMPLATE_IMG'] = '/templates/scenes_okbit/sc_templates/'.$res[$i]['TEMPLATE'].'/images/'.$temp_img.'.png';
			
			
		
			$pos = 0;
			
			//DebMes(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>", 'scenes_okbit');
			
			$res_pos = array();
			
			foreach ($xml as $position) {		
				
				if($position->namePosition){
					$res_pos[$pos]['POSIT'] = $position->namePosition;
					$pos++;
				}
			}
			
			
			$qwe = SQLSelect("SELECT * FROM scenes_element_okbit WHERE PARENT_ID='".$res[$i]['ID']."' ORDER BY PRIORITY DESC");
			
			$scene_id = $res[$i]['ID'];
			
			for($iq=0;$iq<count($res_pos);$iq++){
				$iu = 0;
				for($q=0;$q<count($qwe);$q++){

					if($res_pos[$iq]['POSIT'] == $qwe[$q]['POSITION']){

						$element_tp[$iu]['ELEMENT'] = $qwe[$q]['TITLE'];
						$element_tp[$iu]['ID'] = $scene_id;
						$element_tp[$iu]['ELEMENT_ID'] = $qwe[$q]['ID'];
						$iu++;
					}
				}
				$res_pos[$iq]['ELEMENTS'] = $element_tp;
				$element_tp = array();
			}
			
			
			
			$result[$in]['POSITION'] = $res_pos;
			$result[$in]['TOTAL'] = $total_el;
			
			$in++;
			//DebMes ("Yes", 'scenes_okbit');
		}
		else  SQLExec("DELETE FROM scenes_okbit WHERE ID='".$res[$i]['ID']."'");
	}
	

	
   
   $out['RESULT']=$result;
   
	if ( $state_active['STATE'] == '1' ){   
		$out['ACTIVE']='<div class="alert alert-success" role="alert">Спасибо, Ваша копия модуля активирована</div><hr>';
		$out['ACTIVE_INFO']='<div class="alert alert-info">Модуль зарегистрирован.<br>Лицензия ID: '.$state_active['SERIAL_ID'].'<br>Лицензионный ключь: '.$state_active['SERIAL'].'</div>';
		$out['ACTIVE_CODE'] = '1';
	}
	else if ( $state_active['STATE'] == '2' ){   
		$out['ACTIVE']='<div class="alert alert-danger" role="alert">Ваша лицензия заблокированна за нарушение условий соглашения</div><hr>';
		$out['ACTIVE_CODE'] = '2';
	}
	else {
		$out['ACTIVE']='<div class="alert alert-danger" role="alert">Модуль не активирован! Произведите регистрацию модуля!</div><hr>';
		$out['ACTIVE_CODE'] = '0';
		
		
	}
  }
