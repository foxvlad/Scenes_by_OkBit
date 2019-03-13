<script language="javascript">
	// -----------Переключатель {{ELEMENT_ID}} --------------
	var Ch{{ELEMENT_ID}}=Number('%{{OBJECT}}.{{PROPERTY}}%');
    if(Ch{{ELEMENT_ID}} == 1){
		document.querySelector("#checkbox_{{ELEMENT_ID}}").setAttribute('checked', 'checed');
	}
  	else {
  		document.querySelector("#checkbox_{{ELEMENT_ID}}").removeAttribute('checked');
	}
  	//--------------------------------- 


	function switch_{{ELEMENT_ID}}(){
		
		if(document.getElementById('checkbox_{{ELEMENT_ID}}').checked){
			url_string ='/objects/?object={{OBJECT}}&op=set&p={{PROPERTY}}&v=1';
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", url_string, true);
			xmlhttp.send(null); 
		}
		else {
			url_string ='/objects/?object={{OBJECT}}&op=set&p={{PROPERTY}}&v=0';
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", url_string, true);
			xmlhttp.send(null); 
		}
		
		
		//alert('TEST');

 	}

</script>



	<div class="center-in">
		<div class="link-ico link-ico-{{ICO}}"></div>
		<span>{{TITLE}}</span>
		<div class="checkStyle">
			<input type="checkbox"  class="checkbox" id="checkbox_{{ELEMENT_ID}}" onchange="switch_{{ELEMENT_ID}}()">
			<label for="checkbox_{{ELEMENT_ID}}"></label>
		</div> 
	</div>

	
