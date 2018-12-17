<script>  
    width1=screen.width; // ширина  
    height1=screen.height; // высота  
    //alert ("Разрешение экрана: "+width1+"x"+height1); 
	var oi;
    oi=document.getElementById('raz1');
    oi.innerHTML=+width1+"x"+height1;
	
</script>

<script>  
    width2=document.body.clientWidth; // ширина  
    height2=document.body.clientHeight; // высота  
    //alert ("Разрешение окна клиента: "+width2+"x"+height2); 
	var oi;
    oi=document.getElementById('raz2');
    oi.innerHTML=+width2+"x"+height2;	
</script>  

<div class="right-menu">
{{RIGHT}}
</div>