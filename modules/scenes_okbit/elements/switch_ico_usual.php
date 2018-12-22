<script language="javascript">

	function switch_{{ELEMENT_ID}}(){
		url_string ='/objects/?object={{OBJECT}}&op=m&m={{METOD}}&';
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 
 	}

</script>

<div class="link-ico-out">
	<div class="link-ico link-color-{{ICO}}-%{{LINKED_PROPERTY}}%" onclick="switch_{{ELEMENT_ID}}()">
		<div class="link-ico-in link-ico-{{ICO}}-%{{LINKED_PROPERTY}}%"></div>
	</div>
	<span>{{TITLE}}</span>
</div>
