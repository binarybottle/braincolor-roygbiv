<!-- (c) 2010 arno klein, MIT license 
     arno@mindboggle.info
     http://www.braincolor.org
-->
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
	<script type="text/javascript" src="../scripts/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="./scripts/jquery/jquery.metadataOLD.min.js"></script>
	<script type="text/javascript" src="../scripts/jquery/jquery.maphilightOLD.min.js"></script>
	<script type="text/javascript">
	$(function() {
		$('.map').maphilight();
	});
	
	// Press spacebar to load url's data
	$(document).keypress(function (e) {
		if (e.keyCode == 32 || e.charCode == 32){
	
			var url = './maphilight_test_data.html'
			$('#contour_data').load(url, function(data) {
				alert("Data Loaded: " + data);
			});
		}
	});		
	</script>
 </head>
 <body>

<div id="contour_data">
    Type the number "1"
</div>

 </body>
</html>
