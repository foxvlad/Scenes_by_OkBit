<script language="javascript"> 
    fiR{{ELEMENT_ID}}='%{{OBJECT}}.{{PROPERTY}}%'; 	
	document.getElementById('rad{{ELEMENT_ID}}').options[fiR{{ELEMENT_ID}}].selected = true;
	
	function setRadioBud{{ELEMENT_ID}}(){
		var a=document.getElementById('rad{{ELEMENT_ID}}').value;
		url_string ='/objects/?object={{OBJECT}}&op=set&p={{PROPERTY}}&v='+a;
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 
	}

</script>



	<div class="center-in">
		<div class="link-ico link-ico-{{ICO}}"></div>
		<span>{{TITLE}}</span>
		<form name="select{{ELEMENT_ID}}" class="setTimaF">
			<select class="rad rad-color-{{ICO}}" id="rad{{ELEMENT_ID}}" onchange="setRadioBud{{ELEMENT_ID}}()">
				{{TEXTAREA}}
			</select>
		</form>
		</div> 
	</div>

	
