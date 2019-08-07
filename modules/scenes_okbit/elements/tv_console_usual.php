<script language="javascript">

	function pult_tv(number){
		//url_string ='/objects/?object={{OBJECT}}&op=m&m={{METOD}}&';
		url_string ='/objects/?op=m&object={{OBJECT}}&m={{METOD}}&button='+number;
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", url_string, true);
		xmlhttp.send(null); 
 	}

</script>

<div style="width:calc(100vw/3)" class="tv-out-p">
	<div class="pult">	

		<div class="pult-line">
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/power.png" onclick="pult_tv(1);" />
			</div>
			<div class="pult-sd-4">
				
			</div>
			<div class="pult-sd-4">
				
			</div>
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/power.png" onclick="pult_tv(2);" />
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="pult-line">
			<div class="pult-sm-4">
				TV
			</div>
			<div class="pult-sm-4">
				
			</div>
			<div class="pult-sm-4">
				
			</div>
			<div class="pult-sm-4">
				SAT
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="pult-line">
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/rec.png" onclick="pult_tv(3);" />
			</div>
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/u1.png" onclick="pult_tv(4);" />
			</div>
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/u2.png" onclick="pult_tv(5);" />
			</div>
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/in.png" onclick="pult_tv(6);" />
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="pult-line">
			<div class="pult-sdx-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/set.png"  onclick="pult_tv(7);" />
			</div>
			<div class="pult-sdx-2">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/up.png" onclick="pult_tv(8);" />
			</div>
			<div class="pult-sdx-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/home.png" onclick="pult_tv(9);" />
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="pult-line">
			<div class="pult-sdx-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/left.png" onclick="pult_tv(10);" />
			</div>
			<div class="pult-sdx-2">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/ok.png" onclick="pult_tv(11);" />
			</div>
			<div class="pult-sdx-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/right.png" onclick="pult_tv(12);" />
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="pult-line">
			<div class="pult-sdx-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/info.png" onclick="pult_tv(13);" />
			</div>
			<div class="pult-sdx-2">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/down.png" onclick="pult_tv(14);" />
			</div>
			<div class="pult-sdx-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/exit.png" onclick="pult_tv(15);" />
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="pult-line">
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/b-red.png" onclick="pult_tv(16);" />
			</div>
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/b-green.png" onclick="pult_tv(17);" />
			</div>
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/b-yellow.png" onclick="pult_tv(18);" />
			</div>
			<div class="pult-sd-4">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/b-blue.png" onclick="pult_tv(19);" />
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="pult-line">
			<div class="pult-sd-4">
				<img class="vb-up" src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/vol1.png" onclick="pult_tv(20);" />
				<img class="vb-down" src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/vol2.png" onclick="pult_tv(21);" />
			</div>
			<div class="pult-sd-2">
				<div class="gude">
					<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/gude.png" onclick="pult_tv(22);" />
					<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/menu.png" onclick="pult_tv(23);" />
					<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/mute.png" onclick="pult_tv(24);" />
				</div>
			</div>
			<div class="pult-sd-4">
				<img class="vb-up" src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/prog1.png" onclick="pult_tv(25);" />
				<img class="vb-down" src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/prog2.png" onclick="pult_tv(26);" />
			</div>
			<div style="clear:both"></div>
		</div>
		
			<div class="pult-line">
			<div class="pult-sd-5">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/prev.png" onclick="pult_tv(27);" />
			</div>
			<div class="pult-sd-5">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/stop.png" onclick="pult_tv(28);" />
			</div>
			<div class="pult-sd-5">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/play.png"  onclick="pult_tv(29);" />
			</div>
			<div class="pult-sd-5">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/pause.png" onclick="pult_tv(30);" />
			</div>
			<div class="pult-sd-5">
				<img src="/templates/scenes_okbit/sc_templates/room_iOS_style/images/ico/pult/next.png"  onclick="pult_tv(31);" />
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
</div>	
	
	

