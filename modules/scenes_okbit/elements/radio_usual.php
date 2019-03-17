<script language="javascript">

	var InSound_{{ELEMENT_ID}}=Number('%{{OBJECT}}.{{PROPERTY}}%');
 	
 	if(InSound_{{ELEMENT_ID}} == 0){
		document.RadioSound_{{ELEMENT_ID}}.option_{{ELEMENT_ID}}[0].checked=true;
 	}
 
 	else if(InSound_{{ELEMENT_ID}} == 1){
		document.RadioSound_{{ELEMENT_ID}}.option_{{ELEMENT_ID}}[1].checked=true;
 	}
 
 	else if(InSound_{{ELEMENT_ID}} == 2){
		document.RadioSound_{{ELEMENT_ID}}.option_{{ELEMENT_ID}}[2].checked=true;
 	}
 
 	else if(InSound_{{ELEMENT_ID}} == 3){
		document.RadioSound_{{ELEMENT_ID}}.option_{{ELEMENT_ID}}[3].checked=true;
 	}


	function  radioSound_{{ELEMENT_ID}}(){
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




<div class="player">
		<form name="RadioSound_{{ELEMENT_ID}}" class="player-in">
			<div class="radio-container">
				<div class="radio-btn">
					<input type="radio" name="option_{{ELEMENT_ID}}" id="RadioSoun_{{ELEMENT_ID}}_1" value="0" onclick="radioSound_{{ELEMENT_ID}}();"/>
					<label for="RadioSoun_{{ELEMENT_ID}}_1">TERM</label>
				</div>
				<div class="radio-btn">
					<input type="radio" name="option_{{ELEMENT_ID}}" id="RadioSoun_{{ELEMENT_ID}}_2" value="1" onclick="radioSound_{{ELEMENT_ID}}();"/>
					 <label for="RadioSoun_{{ELEMENT_ID}}_2">AUX1</label>
				</div>
				 <div class="radio-btn">
					<input type="radio" name="option_{{ELEMENT_ID}}" id="RadioSoun_{{ELEMENT_ID}}_3" value="2" onclick="radioSound_{{ELEMENT_ID}}();"/>
					<label for="RadioSoun_{{ELEMENT_ID}}_3">AUX2</label>
				</div>
				<div class="radio-btn">
					<input type="radio" name="option_{{ELEMENT_ID}}" id="RadioSoun_{{ELEMENT_ID}}_4" value="3" onclick="radioSound_{{ELEMENT_ID}}();"/>
					<label for="RadioSoun_{{ELEMENT_ID}}_4">AUX3</label>
				</div>
			</div>
		</form>
		<div style="clear: left"></div>
</div>  

	
