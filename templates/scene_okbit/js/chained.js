var ajax = new Array();

function getTemplateCodeList(sel)
{
	var template = sel.options[sel.selectedIndex].value;
	document.getElementById('template_css').options.length = 0;	// Empty city select box
	if(template.length>0){
		var index = ajax.length;
		ajax[index] = new sack();
		
		ajax[index].requestFile = '/modules/scene_okbit/getStyleCss.php?template='+template;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createCSS(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createCSS(index)
{
	var obj = document.getElementById('template_css');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code	
}


