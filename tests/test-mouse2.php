<html>
<head>
<script type="text/javascript" src="./scripts/jquery.js"></script>
</head>
<body>

<h2>jQuery Documentation</h2>
<p>How to get the co-ordinates is documented <a href="http://docs.jquery.com/Tutorials:Mouse_Position">here</a> in the jQuery documentation/tutorials but doesn't show a working example of getting the position relative to the element (just the page as a whole), whereas I have a working example here. It also doesn't show how to get the mouse position as you move your mouse over an element relative to the element.</p>
<div><style type="text/css"> 

.mouse-xy {
    width: 150px;
    border: 1px solid black;
    padding: 10px;
    background-color: white;
}
div.slice {
	position: relative;
	float: left;
	width: 257px;
        height: 256px;
       	overflow: hidden;
	margin: 1px;
}
 
</style></div>

<div id="example1-xy" class="mouse-xy">MOUSE XY</div>
<div id="example1" class="slice">
    <img src="images/montage1.jpg" id="img1id" style="position: relative; top: -500; left: 0;">
</div>
<script language="Javascript">
    $('#example1').mousemove(function(e){
        var x = e.pageX - this.offsetLeft;
        var y = e.pageY - this.offsetTop;
        $('#example1-xy').html("X: " + x + " Y: " + y); 
    });
</script>

</body>
</html>