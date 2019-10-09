<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sebastian's Homework</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->

        <style type="text/css">
        	body{
        		margin: 0;
        		padding: 0;
        	}
        	.container{
        		padding: 20px;
        	}
        	.tabs{

        	}
        	ul{
        		list-style: none;
        	}
        	li.tab{
        		float: left;
        		padding: 10px 20px;
        		cursor: pointer;
        	}
        	li.tab:hover{
        		background: rgba(0,0,255,0.5);
        	}
        	li.tab.active{
        		background: rgba(255,0,0,0.5);
        	}
        	.tabtoshow{
        		border: 1px solid black;
        		display: none;
        	}
        	.tabtoshow.active{
        		display: block;
        	}
        	img{
        		max-width: 100%;
        	}

        	.imgcontainer{
        		width: 100%;
        		height: 100vh;
        		overflow: hidden;
        	}

        </style>

    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <div class="container">
	        <nav class="tabs">
	        	<ul>
	        		<li class="active tab" data-tab="tab1">Low Sample</li>
	        		<li class="tab" data-tab="tab2">LS with high Ray Bound</li>
	        		<li class="tab" data-tab="tab3">High Sample</li>
	        		<li class="tab" data-tab="tab4">HS with high Ray Bound</li>
	        		<li class="tab" data-tab="tab5">Sun Plain</li>
	        		<li class="tab" data-tab="tab6">Sun Background</li>
	        		<li class="tab" data-tab="tab7">Spotlights</li>
	        		<li class="tab" data-tab="tab8">Denoised Low Qual</li>
	        		<li class="tab" data-tab="tab9">Denoised High Qual</li>
	        	</ul>
	        </nav>

	        <div id="tab1" class="tabtoshow active">
	        	<div id="imgcontainer1" class="imgcontainer"></div>
	        </div>
	        <div id="tab2" class="tabtoshow">
	        	<div id="imgcontainer2" class="imgcontainer"></div>
	        </div>
	        <div id="tab3" class="tabtoshow">
	        	<div id="imgcontainer3" class="imgcontainer"></div>
	        </div>
	        <div id="tab4" class="tabtoshow">
	        	<div id="imgcontainer4" class="imgcontainer"></div>
	        </div>
	        <div id="tab5" class="tabtoshow">
	        	<div id="imgcontainer5" class="imgcontainer"></div>
	        </div>
	        <div id="tab6" class="tabtoshow">
	        	<div id="imgcontainer6" class="imgcontainer"></div>
	        </div>
	        <div id="tab7" class="tabtoshow">
	        	<div id="imgcontainer7" class="imgcontainer"></div>
	        </div>
	        <div id="tab8" class="tabtoshow">
	        	<div id="imgcontainer8" class="imgcontainer"></div>
	        </div>
	        <div id="tab9" class="tabtoshow">
	        	<div id="imgcontainer9" class="imgcontainer"></div>
	        </div>
     	</div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/konva@4.0.13/konva.min.js"></script>
        <script type="text/javascript">
        	var folder = "/img/"; //folder in which you find the images
			var images = {
				"imgcontainer1" : "1st_render.jpg",
				"imgcontainer2" : "2nd_render.jpg",
				"imgcontainer3" : "3rd_render.jpg",
				"imgcontainer4" : "4th_render.jpg",
				"imgcontainer5" : "sun_plain.jpg",
				"imgcontainer6" : "sun_backgroundTexture.jpg",
				"imgcontainer7" : "spotlight.jpg",
				"imgcontainer8" : "denoising_lowQuality.jpg",
				"imgcontainer9" : "denoising_highQuality.jpg",
				
				
			}
        	jQuery("li.tab").click(function(){
        		var elem = jQuery(this).data("tab");
        		jQuery("li.tab").removeClass("active");
        		jQuery(this).addClass("active");
        		jQuery("div.tabtoshow").removeClass("active");
        		jQuery("#"+elem).addClass("active");

        		if(jQuery(this).data("loaded")){
        			//Do nothing
        		}else{
        			let property = jQuery("#"+elem).children().eq(0).attr("id");
        			let imageObj = new Image();
					imageObj.onload = function() {
						drawImage(this, property);
					};
					imageObj.src = folder+images[property];
					jQuery(this).data("loaded", true);
        		}
        	});
        	jQuery("li.tab.active").trigger("click"); //to trigger on first one
        </script>

        <script type="text/javascript">
        	var width = window.innerWidth;
			var height = window.innerHeight;
        	function drawImage(imageObj, imageContainer) {
				let stage = new Konva.Stage({
					container: imageContainer,
					width: width,
					height: height
				});

				let layer = new Konva.Layer();
				// Image sizes
				let imgwidth = 1280;
				let imgheight = 720;
				let darthVaderImg = new Konva.Image({
					image: imageObj,
					x: stage.width() / 2 - imgwidth / 2,
					y: stage.height() / 2 - imgheight / 2,
					width: imgwidth,
					height: imgheight,
					draggable: true
				});

				// add cursor styling
				darthVaderImg.on('mouseover', function() {
					document.body.style.cursor = 'pointer';
				});
				darthVaderImg.on('mouseout', function() {
					document.body.style.cursor = 'default';
				});

				layer.add(darthVaderImg);
				stage.add(layer);
			}

			// for(var property in images) {
			// 	let imageObj = new Image();
			// 	imageObj.onload = function() {
			// 		drawImage(this, property);
			// 	};
			// 	imageObj.src = folder+images[property];
			// }
        </script>
    </body>
</html>
