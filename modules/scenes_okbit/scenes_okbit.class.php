<?php
/**
* Scenes_OkBit 
* @package project
* @author Wizard <sergejey@gmail.com>
* @copyright http://majordomo.smartliving.ru/ (c)
* @version 0.1 (wizard, 13:12:39 [Dec 01, 2018])
*/
//
//
class scenes_okbit extends module {
/**
* Scenes_OkBit
*
* Module class constructor
*
* @access private
*/
function __construct() {
  $this->name="scenes_okbit";
  $this->title="Сцены от OkBit.ru";
  $this->module_category="Визуализация";
  $this->checkInstalled();
}
/**
* saveParams
*
* Saving module parameters
*
* @access public
*/
function saveParams($data=1) {
 $p=array();
 if (IsSet($this->id)) {
  $p["id"]=$this->id;
 }
 if (IsSet($this->view_mode)) {
  $p["view_mode"]=$this->view_mode;
 }
 if (IsSet($this->edit_mode)) {
  $p["edit_mode"]=$this->edit_mode;
 }
 if (IsSet($this->data_source)) {
  $p["data_source"]=$this->data_source;
 }
 if (IsSet($this->tab)) {
  $p["tab"]=$this->tab;
 }
 return parent::saveParams($p);
}
/**
* getParams
*
* Getting module parameters from query string
*
* @access public
*/
function getParams() {
  global $id;
  global $mode;
  global $view_mode;
  global $edit_mode;
  global $data_source;
  global $tab;
  if (isset($id)) {
   $this->id=$id;
  }
  if (isset($mode)) {
   $this->mode=$mode;
  }
  if (isset($view_mode)) {
   $this->view_mode=$view_mode;
  }
  if (isset($edit_mode)) {
   $this->edit_mode=$edit_mode;
  }
  if (isset($data_source)) {
   $this->data_source=$data_source;
  }
  if (isset($tab)) {
   $this->tab=$tab;
  }
}
/**
* Run
*
* Description
*
* @access public
*/
function run() {
 global $session;
  $out=array();
  if ($this->action=='admin') {
   $this->admin($out);
  } else {
   $this->usual($out);
  }
  if (IsSet($this->owner->action)) {
   $out['PARENT_ACTION']=$this->owner->action;
  }
  if (IsSet($this->owner->name)) {
   $out['PARENT_NAME']=$this->owner->name;
  }
  $out['VIEW_MODE']=$this->view_mode;
  $out['EDIT_MODE']=$this->edit_mode;
  $out['MODE']=$this->mode;
  $out['ACTION']=$this->action;
  $out['DATA_SOURCE']=$this->data_source;
  $out['TAB']=$this->tab;
  $this->data=$out;
  $p=new parser(DIR_TEMPLATES.$this->name."/".$this->name.".html", $this->data, $this);
  $this->result=$p->result;
}
/**
* BackEnd
*
* Module backend
*
* @access public
*/
function admin(&$out) {
 $this->getConfig();
 $out['API_URL']=$this->config['API_URL'];
 if (!$out['API_URL']) {
  $out['API_URL']='http://';
 }
 $out['API_KEY']=$this->config['API_KEY'];
 $out['API_USERNAME']=$this->config['API_USERNAME'];
 $out['API_PASSWORD']=$this->config['API_PASSWORD'];
 if ($this->view_mode=='update_settings') {
   global $api_url;
   $this->config['API_URL']=$api_url;
   global $api_key;
   $this->config['API_KEY']=$api_key;
   global $api_username;
   $this->config['API_USERNAME']=$api_username;
   global $api_password;
   $this->config['API_PASSWORD']=$api_password;
   $this->saveConfig();
   $this->redirect("?");
 }
 

 
 if (isset($this->data_source) && !$_GET['data_source'] && !$_POST['data_source']) {
  $out['SET_DATASOURCE']=1;
 }
 if ($this->data_source=='s_okbit' || $this->data_source=='') {
  if ($this->view_mode=='' || $this->view_mode=='search_s_okbit') {
   $this->search_s_okbit($out);
  }  
  if ($this->view_mode=='edit_s_okbit') {
   $this->edit_s_okbit($out, $this->id);
  }
  
  if ($this->view_mode=='edit_element') {
   $this->edit_element($out, $this->id);
   //$this->redirect("?data_source=s_okbit");
  }
  
  if ($this->view_mode=='build') {
   $this->build_s_okbit($out, $this->id);
  }
  if ($this->view_mode=='delete_s_okbit') {
   $this->delete_s_okbit($this->id);
   $this->redirect("?data_source=s_okbit");
  }
 }
 if (isset($this->data_source) && !$_GET['data_source'] && !$_POST['data_source']) {
  $out['SET_DATASOURCE']=1;
 }
 if ($this->data_source=='so_okbit') {
  if ($this->view_mode=='' || $this->view_mode=='search_so_okbit') {
   $this->search_so_okbit($out);
  }
  if ($this->view_mode=='edit_so_okbit') {
   $this->edit_so_okbit($out, $this->id);
  }
 }
}
/**
* FrontEnd
*
* Module frontend
*
* @access public
*/
function usual(&$out) {
 $this->admin($out);
}
/**
* s_okbit search
*
* @access public
*/
 function search_s_okbit(&$out) {
  require(DIR_MODULES.$this->name.'/s_okbit_search.inc.php');
 }
 

 
 
 
 
/**
* s_okbit edit/add
*
* @access public
*/
 function edit_s_okbit(&$out, $id) {
  require(DIR_MODULES.$this->name.'/s_okbit_edit.inc.php');
 }
 

/**
* s_okbit edit/add
*
* @access public
*/
 function edit_element(&$out, $id) {
  require(DIR_MODULES.$this->name.'/el_okbit_edit.inc.php');
 } 
 
 
 
 
 
/**
* s_okbit build
*
* @access public
*/
 function build_s_okbit(&$out, $id) {
	require(DIR_MODULES.$this->name.'/s_okbit_build.inc.php');
	$this->redirect("?data_source=s_okbit");	
 }
 
 
 
 /**
* s_okbit reorder elements
*
* Изменение порядка элементов на сцене
*
* @access public
*/
function reorder_elements($id, $direction='up') {
	
	
	$element=SQLSelectOne("SELECT * FROM scenes_element_okbit WHERE ID='".(int)$id."'");
	
	$all_elements=SQLSelect("SELECT * FROM scenes_element_okbit WHERE PARENT_ID='".$element['PARENT_ID']."' AND POSITION='".$element['POSITION']."' ORDER BY PRIORITY DESC, TITLE");

	$total=count($all_elements);


	for($i=0;$i<$total;$i++) {
		if ($all_elements[$i]['ID']==$id && $i>0 && $direction=='up') {
			$tmp=$all_elements[$i-1];
			$all_elements[$i-1]=$all_elements[$i];
			$all_elements[$i]=$tmp;
			break;
		}
		if ($all_elements[$i]['ID']==$id && $i<($total-1) && $direction=='down') {
			$tmp=$all_elements[$i+1];
			$all_elements[$i+1]=$all_elements[$i];
			$all_elements[$i]=$tmp;
			break;
		}
	}

	$priority=($total)*10;

	for($i=0;$i<$total;$i++) {
		$all_elements[$i]['PRIORITY']=$priority;
		$priority-=10;
		SQLUpdate('scenes_element_okbit', $all_elements[$i]);
	}

}
 
 /**
* elements delete record
*
* @access public
*/

function delete_elements($id) {
	$element=SQLSelectOne("SELECT * FROM scenes_element_okbit WHERE ID='".$id."'");
	if ($element['ID']) {
		SQLExec("DELETE FROM scenes_element_okbit WHERE ID='".$element['ID']."'");
	}
 }

 
 
/**
* s_okbit delete record
*
* @access public
*/
 function delete_s_okbit($id) {
  $rec=SQLSelectOne("SELECT * FROM s_okbit WHERE ID='$id'");
  // some action for related tables
  SQLExec("DELETE FROM s_okbit WHERE ID='".$rec['ID']."'");
 }
 
 
/**
* so_okbit search
*
* @access public
*/
 function search_so_okbit(&$out) {
  require(DIR_MODULES.$this->name.'/so_okbit_search.inc.php');
 }
/**
* so_okbit edit/add
*
* @access public
*/
 function edit_so_okbit(&$out, $id) {
  require(DIR_MODULES.$this->name.'/so_okbit_edit.inc.php');
 }
 function propertySetHandle($object, $property, $value) {
  $this->getConfig();
   $table='scenes_element_okbit';
   $properties=SQLSelect("SELECT ID FROM $table WHERE LINKED_OBJECT LIKE '".DBSafe($object)."' AND LINKED_PROPERTY LIKE '".DBSafe($property)."'");
   $total=count($properties);
   if ($total) {
    for($i=0;$i<$total;$i++) {
     //to-do
    }
   }
 }
/**
* Install
*
* Module installation routine
*
* @access private
*/
 function install($data='') {
  parent::install();
  
  
 }
/**
* Uninstall
*
* Module uninstall routine
*
* @access public
*/
 function uninstall() {
  SQLExec('DROP TABLE IF EXISTS scenes_okbit');
  SQLExec('DROP TABLE IF EXISTS scenes_element_okbit');
  parent::uninstall();
 }
/**
* dbInstall
*
* Database installation routine
*
* @access private
*/
 function dbInstall($data) {
/*
scenes_okbit - 
scenes_element_okbit - 
*/
  $data = <<<EOD
 scenes_okbit: ID int(10) unsigned NOT NULL auto_increment
 scenes_okbit: SCENES_ID int(10) NOT NULL DEFAULT '0'
 scenes_okbit: TEMPLATE varchar(255) NOT NULL DEFAULT ''
 scenes_okbit: TEMPLATE_CSS varchar(255) NOT NULL DEFAULT ''
 scenes_okbit: ADDITION varchar(255) NOT NULL DEFAULT ''
 scenes_okbit: HOME_IMG varchar(255) NOT NULL DEFAULT ''
 scenes_okbit: TYPE_SCENE varchar(255) NOT NULL DEFAULT ''
 scenes_okbit: HOME_SCENE varchar(255) NOT NULL DEFAULT ''
 scenes_okbit: CLONE_MENU varchar(255) NOT NULL DEFAULT ''
 scenes_okbit: PRIORITY int(10) NOT NULL DEFAULT '0'
 scenes_element_okbit: ID int(10) unsigned NOT NULL auto_increment
 scenes_element_okbit: TITLE varchar(100) NOT NULL DEFAULT ''
 scenes_element_okbit: POSITION varchar(100) NOT NULL DEFAULT ''
 scenes_element_okbit: VALUE varchar(255) NOT NULL DEFAULT ''
 scenes_element_okbit: HTML varchar(1000) NOT NULL DEFAULT ''
 scenes_element_okbit: TEXTAREA varchar(255) NOT NULL DEFAULT ''
 scenes_element_okbit: TYPE varchar(255) NOT NULL DEFAULT ''
 scenes_element_okbit: SCENE_LINK varchar(100) NOT NULL DEFAULT ''
 scenes_element_okbit: ICO varchar(255) NOT NULL DEFAULT ''
 scenes_element_okbit: SHOW1 varchar(255) NOT NULL DEFAULT ''
 scenes_element_okbit: SHOW2 varchar(255) NOT NULL DEFAULT ''
 scenes_element_okbit: PARENT_ID int(10) NOT NULL DEFAULT '0'
 scenes_element_okbit: LINKED_OBJECT varchar(100) NOT NULL DEFAULT ''
 scenes_element_okbit: LINKED_PROPERTY varchar(100) NOT NULL DEFAULT ''
 scenes_element_okbit: LINKED_METHOD varchar(100) NOT NULL DEFAULT ''
 scenes_element_okbit: PRIORITY int(10) NOT NULL DEFAULT '0'
 
 
EOD;
  parent::dbInstall($data);
 }
// --------------------------------------------------------------------
}
/*
*
* TW9kdWxlIGNyZWF0ZWQgRGVjIDAxLCAyMDE4IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
