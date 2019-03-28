<script language="javascript">
function  button_{{ELEMENT_ID}}(){
		url_string ='/objects/?object={{OBJECT}}&op=m&m={{METOD}}&';
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 

}
</script>
<div class="right-menu">
	<div class="link-ico-out">
		<div class="link-ico link-color-{{ICO}}-0" onclick="button_{{ELEMENT_ID}}()">
			<div class="link-ico-in link-ico-{{ICO}}-0"></div>
		</div>
		<span>{{TITLE}}</span>
	</div>
</div>