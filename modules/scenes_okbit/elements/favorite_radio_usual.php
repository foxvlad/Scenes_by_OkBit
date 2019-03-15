<script language="javascript">

	function favorite_radio_{{ELEMENT_ID}}(number){
		url_string ='/objects/?object={{OBJECT}}&op=m&m={{METOD}}&button='+number;
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 
		//alert(number);
 	}

</script>


<div class="img_fav">
	<img src="{{IMG_FAV}}" onclick="favorite_radio_{{ELEMENT_ID}}({{ICO}})">
</div>