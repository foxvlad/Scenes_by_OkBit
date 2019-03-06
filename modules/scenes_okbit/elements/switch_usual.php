<script language="javascript">

	function switch_{{ELEMENT_ID}}(){
		url_string ='/objects/?object={{OBJECT}}&op=m&m={{METOD}}&';
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 
 	}

</script>



	<div class="center-in">
		<div class="link-ico link-ico-{{ICO}}"></div>
		<span>{{TITLE}}</span>
		<div class="left-arrow" onclick="switch_{{ELEMENT_ID}}()"></div>
	</div>
