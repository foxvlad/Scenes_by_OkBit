<script language="javascript">
	var
	val =%{{OBJECT}}.{{PROPERTY}}%;
	$('#range{{ELEMENT_ID}}').css({'background':'-webkit-linear-gradient(left ,#36b736 0%,#36b736 '+val+'%,#bec1c5 '+val+'%, #bec1c5 100%)'});
	$('#rangeStyle{{ELEMENT_ID}}').html(val+'%');
	
	function range_{{ELEMENT_ID}}(){
		var
		val = $('#range{{ELEMENT_ID}}').val();
		$('#range{{ELEMENT_ID}}').css({'background':'-webkit-linear-gradient(left ,#36b736 0%,#36b736 '+val+'%,#bec1c5 '+val+'%, #bec1c5 100%)'});
		$('#rangeStyle{{ELEMENT_ID}}').html(val+'%');
		document.getElementById('rangeStyle{{ELEMENT_ID}}').innerHTML = val+'%';
	}
	
	function rangeSend_{{ELEMENT_ID}}(){
        val = $('#range{{ELEMENT_ID}}').val();
        url_string ='/objects/?object={{OBJECT}}&op=set&p={{PROPERTY}}&v='+val;
        xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 
	}

</script>



	<div class="center-in">
		<input class="range" id="range{{ELEMENT_ID}}" oninput="range_{{ELEMENT_ID}}()" onchange="rangeSend_{{ELEMENT_ID}}()" type="range" min="0" max="100" value="%{{OBJECT}}.{{PROPERTY}}%">
        <div class="rangeStyle" id="rangeStyle{{ELEMENT_ID}}" >%{{OBJECT}}.{{PROPERTY}}%%</div>
         <div style="clear: left"></div>
	</div>

	
