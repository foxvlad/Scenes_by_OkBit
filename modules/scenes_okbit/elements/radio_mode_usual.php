<script language="javascript">

	var InSound_{{ELEMENT_ID}}=Number('%{{OBJECT}}.{{PROPERTY}}%');
 	
 	if(InSound_{{ELEMENT_ID}} == 0){
		document.RadioMode_{{ELEMENT_ID}}.option_{{ELEMENT_ID}}[0].checked=true;
 	}
 
 	else if(InSound_{{ELEMENT_ID}} == 1){
		document.RadioMode_{{ELEMENT_ID}}.option_{{ELEMENT_ID}}[1].checked=true;
 	}
 
 	else if(InSound_{{ELEMENT_ID}} == 2){
		document.RadioMode_{{ELEMENT_ID}}.option_{{ELEMENT_ID}}[2].checked=true;
 	}


	function  radioMode_{{ELEMENT_ID}}(){
		var radS=document.getElementsByName('option_{{ELEMENT_ID}}');
		for (var i=0;i<radS.length; i++) {
			if (radS[i].checked) {
				url_string ='/objects/?object={{OBJECT}}&op=set&p={{PROPERTY}}&button='+i;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET", url_string, true);
				xmlhttp.send(null); 
			}
		}
	}


</script>





		<form name="RadioMode_{{ELEMENT_ID}}" class="mode-in">
			<div class="radio-container-m">
				<div class="radio-btn">
					<input type="radio" name="option_{{ELEMENT_ID}}" id="RadioMode_{{ELEMENT_ID}}_1" value="0" onclick="radioMode_{{ELEMENT_ID}}();"/>
					<label for="RadioMode_{{ELEMENT_ID}}_1">OFF</label>
				</div>
				<div class="radio-btn">
					<input type="radio" name="option_{{ELEMENT_ID}}" id="RadioMode_{{ELEMENT_ID}}_2" value="1" onclick="radioMode_{{ELEMENT_ID}}();"/>
					 <label for="RadioMode_{{ELEMENT_ID}}_2">AUTO</label>
				</div>
				 <div class="radio-btn">
					<input type="radio" name="option_{{ELEMENT_ID}}" id="RadioMode_{{ELEMENT_ID}}_3" value="2" onclick="radioMode_{{ELEMENT_ID}}();"/>
					<label for="RadioMode_{{ELEMENT_ID}}_3">ECO</label>
				</div>
			</div>
		</form>
		<div style="clear: left"></div>

	
