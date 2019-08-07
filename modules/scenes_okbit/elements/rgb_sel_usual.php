 <script>

 
$(function(){
	
	
	$('#hexVal_{{ELEMENT_ID}}').text('#'+'%{{OBJECT}}.{{PROPERTY}}%');
	$('.preview_{{ELEMENT_ID}}').css('backgroundColor','#'+'%{{OBJECT}}.{{PROPERTY}}%');

    // create canvas and context objects
    var canvas = document.getElementById('picker_{{ELEMENT_ID}}');
    var ctx = canvas.getContext('2d');

    // drawing active image
    var image = new Image();
    image.onload = function () {
        ctx.drawImage(image, 0, 0, image.width, image.height); // draw the image on the canvas
    }


    
    image.src = '../../templates/scenes_okbit/sc_templates/room_iOS_style/images/colorwheel2.png';

    $('#picker_{{ELEMENT_ID}}').click(function(e) { // mouse move handler
            // get coordinates of current position
            var canvasOffset = $(canvas).offset();
            var canvasX = Math.floor(e.pageX - canvasOffset.left);
            var canvasY = Math.floor(e.pageY - canvasOffset.top);

            // get current pixel
            var imageData_{{ELEMENT_ID}} = ctx.getImageData(canvasX, canvasY, 1, 1);
            var pixel_{{ELEMENT_ID}} = imageData_{{ELEMENT_ID}}.data;

            // update preview color
            var pixelColor_{{ELEMENT_ID}} = "rgb("+pixel_{{ELEMENT_ID}}[0]+", "+pixel_{{ELEMENT_ID}}[1]+", "+pixel_{{ELEMENT_ID}}[2]+")";
            $('.preview_{{ELEMENT_ID}}').css('backgroundColor', pixelColor_{{ELEMENT_ID}});

            // update controls
            $('#rVal_{{ELEMENT_ID}}').val(pixel_{{ELEMENT_ID}}[0]);
            $('#gVal_{{ELEMENT_ID}}').val(pixel_{{ELEMENT_ID}}[1]);
            $('#bVal_{{ELEMENT_ID}}').val(pixel_{{ELEMENT_ID}}[2]);
            $('#rgbVal_{{ELEMENT_ID}}').val(pixel_{{ELEMENT_ID}}[0]+','+pixel_{{ELEMENT_ID}}[1]+','+pixel_{{ELEMENT_ID}}[2]);

            var dColor_{{ELEMENT_ID}} = pixel_{{ELEMENT_ID}}[2] + 256 * pixel_{{ELEMENT_ID}}[1] + 65536 * pixel_{{ELEMENT_ID}}[0];
            $('#hexVal_{{ELEMENT_ID}}').text('#' + ('0000' + dColor_{{ELEMENT_ID}}.toString(16)).substr(-6));
			$.get('/objects/?op=m&object={{OBJECT}}&m={{METOD}}&rgb='+('0000' + dColor_{{ELEMENT_ID}}.toString(16)).substr(-6));
    });
});
</script>

<div class="center-in">
	<div class="link-ico link-ico-{{ICO}}"></div>
	<span>{{TITLE}}</span>
	<a href="#openModal_{{ELEMENT_ID}}">	
		<div class="rgb-sel preview_{{ELEMENT_ID}}" >			
		</div> 
	</a>

	<div id="openModal_{{ELEMENT_ID}}" class="modalDialog">
		<div>
			
			<div class="colorpicker" >
				<a href="#close" title="Закрыть" class="close">X</a>
                <canvas id="picker_{{ELEMENT_ID}}" width="300" height="300"></canvas>

        <!--    <div class="controls">
                    <div><label>R</label> <input type="text" id="rVal" /></div>
                    <div><label>G</label> <input type="text" id="gVal" /></div>
                    <div><label>B</label> <input type="text" id="bVal" /></div>
                    <div><label>RGB</label> <input type="text" id="rgbVal" /></div>
                    <div><label>HEX</label> <input type="text" id="hexVal" /></div>
					<div class="preview"></div>
                </div> -->
            </div>
		</div>
	</div>
		
</div> 


