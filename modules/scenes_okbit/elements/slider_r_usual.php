<script language="javascript">

	
	
	val = $('#range{{ELEMENT_ID}}').val();
	tempVal = map_{{ELEMENT_ID}}(val, {{CENTER_SHOW}}, {{RIGHT_SHOW}}, 0, 100);
	
	$('#range{{ELEMENT_ID}}').css({'background':'-webkit-linear-gradient(left ,#36b736 0%,#36b736 '+tempVal+'%,#bec1c5 '+tempVal+'%, #bec1c5 100%)'});
	$('#rangeStyle{{ELEMENT_ID}}').html(val+' {{TEXTAREA}}');
	
	
	function map_{{ELEMENT_ID}}(x,  in_min,  in_max,  out_min,  out_max){
  		return Math.floor((x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min);
	}
	
	
	function range_{{ELEMENT_ID}}(){
		var
		val = $('#range{{ELEMENT_ID}}').val();
		tempVal = map_{{ELEMENT_ID}}(val, {{CENTER_SHOW}}, {{RIGHT_SHOW}}, 0, 100);
		
		
		$('#range{{ELEMENT_ID}}').css({'background':'-webkit-linear-gradient(left ,#36b736 0%,#36b736 '+tempVal+'%,#bec1c5 '+tempVal+'%, #bec1c5 100%)'});
		$('#rangeStyle{{ELEMENT_ID}}').html(val+'{{TEXTAREA}}');
		document.getElementById('rangeStyle{{ELEMENT_ID}}').innerHTML = val+' {{TEXTAREA}}';
	}
	
	function rangeSend_{{ELEMENT_ID}}(){
        val = $('#range{{ELEMENT_ID}}').val();
        url_string ='/objects/?object={{OBJECT}}&op=set&p={{PROPERTY}}&v='+val;
        xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 
	}

</script>


<div class="player"> 
	<div class="player-in-2">	
		<div class="center-in">
			<input class="range" id="range{{ELEMENT_ID}}" oninput="range_{{ELEMENT_ID}}()" onchange="rangeSend_{{ELEMENT_ID}}()" type="range" min="{{CENTER_SHOW}}" max="{{RIGHT_SHOW}}" value="%{{OBJECT}}.{{PROPERTY}}%">
			<div class="rangeStyle" id="rangeStyle{{ELEMENT_ID}}" >%{{OBJECT}}.{{PROPERTY}}% {{TEXTAREA}}</div>
			 <div style="clear: left"></div>
		</div>
	</div>
</div>
	
