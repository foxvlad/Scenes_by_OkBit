
<script language="javascript">

	
	val = $('#range{{ELEMENT_ID}}').val();
	tempVal = map_{{ELEMENT_ID}}(val, {{CENTER_SHOW}}, {{RIGHT_SHOW}}, 0, 100);
	
	$('#range{{ELEMENT_ID}}').css({'background':'-webkit-linear-gradient(left ,#36b736 0%,#36b736 '+tempVal+'%,#bec1c5 '+tempVal+'%, #bec1c5 100%)'});
	$('#rangeStyle{{ELEMENT_ID}}').html(val+' °C');
	
	
	function map_{{ELEMENT_ID}}(x,  in_min,  in_max,  out_min,  out_max){
  		return Math.floor((x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min);
	}
	
	
	function range_{{ELEMENT_ID}}(){
		var
		val = $('#range{{ELEMENT_ID}}').val();
		tempVal = map_{{ELEMENT_ID}}(val, {{CENTER_SHOW}}, {{RIGHT_SHOW}}, 0, 100);
		
		
		$('#range{{ELEMENT_ID}}').css({'background':'-webkit-linear-gradient(left ,#36b736 0%,#36b736 '+tempVal+'%,#bec1c5 '+tempVal+'%, #bec1c5 100%)'});
		$('#rangeStyle{{ELEMENT_ID}}').html(val+'{{TEXTAREA}}');
		document.getElementById('rangeStyle{{ELEMENT_ID}}').innerHTML = val+' °C';
	}
	
	function rangeSend_{{ELEMENT_ID}}(){
        val = $('#range{{ELEMENT_ID}}').val();
        url_string ='/objects/?object={{OBJECT}}&op=set&p=normalTargetValue&v='+val;
        xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 
	}
	
	

	// -----------Переключатель {{ELEMENT_ID}} --------------
	var Ch{{ELEMENT_ID}}=Number('%{{OBJECT}}.disabled%');
    if(Ch{{ELEMENT_ID}} == 1){
		document.querySelector("#checkbox_{{ELEMENT_ID}}").setAttribute('checked', 'checed');
	}
  	else {
  		document.querySelector("#checkbox_{{ELEMENT_ID}}").removeAttribute('checked');
	}
  	//--------------------------------- 


	function switch_{{ELEMENT_ID}}(){
		
		if(document.getElementById('checkbox_{{ELEMENT_ID}}').checked){
			url_string ='/objects/?object={{OBJECT}}&op=set&p=disabled&v=1';
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", url_string, true);
			xmlhttp.send(null); 
		}
		else {
			url_string ='/objects/?object={{OBJECT}}&op=set&p=disabled&v=0';
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", url_string, true);
			xmlhttp.send(null); 
		}
		
		
		//alert('TEST');

 	}
		

</script>



	<div class="center-in-2">
		<div class="link-ico info-ico-4"></div>
		<span>{{TITLE}}</span>
		
		
		<div class="checkStyle">
			<input type="checkbox"  class="checkbox" id="checkbox_{{ELEMENT_ID}}" onchange="switch_{{ELEMENT_ID}}()">
			<label for="checkbox_{{ELEMENT_ID}}"></label>
		</div> 
		
		<input class="range-t" id="range{{ELEMENT_ID}}" oninput="range_{{ELEMENT_ID}}()" onchange="rangeSend_{{ELEMENT_ID}}()" type="range" min="{{CENTER_SHOW}}" max="{{RIGHT_SHOW}}" value="%{{OBJECT}}.currentTargetValue%">
		
		
		<div class="rangeStyle" id="rangeStyle{{ELEMENT_ID}}" >%{{OBJECT}}.currentTargetValue% °C</div>


		<div class="sys-link-ico info-term-%{{OBJECT}}.relay_status%"></div>
		
		<div class="rangeStyle2" id="rangeStyle{{ELEMENT_ID}}" >%{{OBJECT}}.value% °C</div>
	</div>
	

	
	


