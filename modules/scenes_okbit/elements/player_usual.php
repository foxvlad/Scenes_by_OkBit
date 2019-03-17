<script language="javascript">

	function playControl(number){
		//url_string ='/objects/?object={{OBJECT}}&op=m&m={{METOD}}&';
		url_string ='/objects/?op=m&object={{OBJECT}}&m={{METOD}}&button='+number;
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 
 	}

</script>



<div class="player"> 
	<div class="player-in">					
		<div class="circleP gray" onclick="playControl(1)">
			<img src="../../templates/scenes_okbit/sc_templates/room_iOS_style/images/playControl/prev.png"/>
		</div>           
		<div class="circleP gray" onclick="playControl(2)">
			<img src="../../templates/scenes_okbit/sc_templates/room_iOS_style/images/playControl/pause.png"/>
		</div>
		<div class="circleP gray" onclick="playControl(3)">
			<img src="../../templates/scenes_okbit/sc_templates/room_iOS_style/images/playControl/play.png"/>
		</div>
		<div class="circleP gray" onclick="playControl(4)">
			<img src="../../templates/scenes_okbit/sc_templates/room_iOS_style/images/playControl/stop.png"/>
		</div>
		<div class="circleP gray" onclick="playControl(5)">
			<img src="../../templates/scenes_okbit/sc_templates/room_iOS_style/images/playControl/next.png"/>		
		</div>
		<div style="clear: left"></div>
	</div>
</div>



    