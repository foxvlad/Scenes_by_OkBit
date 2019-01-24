<script language="javascript">

	
	function block_none(){
		document.getElementById('{{CENTER1}}').setAttribute('class', 'hide');
		document.getElementById('{{CENTER2}}').setAttribute('class', 'hide');
		document.getElementById('{{CENTER3}}').setAttribute('class', 'hide');
		document.getElementById('{{CENTER4}}').setAttribute('class', 'hide');
		document.getElementById('{{CENTER5}}').setAttribute('class', 'hide');
		document.getElementById('{{RIGHT1}}').setAttribute('class', 'hide');
		document.getElementById('{{RIGHT2}}').setAttribute('class', 'hide');
		document.getElementById('{{RIGHT3}}').setAttribute('class', 'hide');
		document.getElementById('{{RIGHT4}}').setAttribute('class', 'hide');

 	}
	
	function show_center_1(){
		document.getElementById('{{CENTER1}}').removeAttribute('style');
		document.getElementById('{{CENTER1}}').setAttribute('class', 'show center-v');
	}
	
	function show_center_2(){
		document.getElementById('{{CENTER2}}').removeAttribute('style');
		document.getElementById('{{CENTER2}}').setAttribute('class', 'show center-v');
	}
	
	function show_center_3(){
		document.getElementById('{{CENTER3}}').removeAttribute('style');
		document.getElementById('{{CENTER3}}').setAttribute('class', 'show center-v');
	}
	
	function show_center_4(){
		document.getElementById('{{CENTER4}}').removeAttribute('style');
		document.getElementById('{{CENTER4}}').setAttribute('class', 'show center-v');
	}
	
	function show_center_5(){
		document.getElementById('{{CENTER5}}').removeAttribute('style');
		document.getElementById('{{CENTER5}}').setAttribute('class', 'show center-v');
	}
	
	function show_right_1(){
		document.getElementById('{{RIGHT1}}').removeAttribute('style');
		document.getElementById('{{RIGHT1}}').setAttribute('class', 'show right-v');
	}
	
	function show_right_2(){
		document.getElementById('{{RIGHT2}}').removeAttribute('style');
		document.getElementById('{{RIGHT2}}').setAttribute('class', 'show right-v');
	}
	
	function show_right_3(){
		document.getElementById('{{RIGHT3}}').removeAttribute('style');
		document.getElementById('{{RIGHT3}}').setAttribute('class', 'show right-v');
	}
	
	function show_right_4(){
		document.getElementById('{{RIGHT4}}').removeAttribute('style');
		document.getElementById('{{RIGHT4}}').setAttribute('class', 'show right-v');
	}
	
	
	
</script>

<style type="text/css">
	
	.hide{	
		display:none !important;
	}
	
	.show{	
		display:inline-block !important;
	}
	
</style>

<div class="left-menu">

	<div class="img-home">
	</div>
	{{LEFT}}

</div>

