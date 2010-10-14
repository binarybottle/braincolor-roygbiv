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
.mouse-click {
    margin-top: 10px;
    width: 500px;
    height: 200px;
    border: 1px solid black;
    padding: 10px;
    background-color: #ccc;
}
 
</style></div>

<div id="example1-xy" class="mouse-xy">MOUSE XY</div>
<div id="example1" class="mouse-click">MOUSE CLICK AREA</div>
<script language="Javascript">
    $('#example1').mousemove(function(e){
        var x = e.pageX - this.offsetLeft;
        var y = e.pageY - this.offsetTop;
        $('#example1-xy').html("X: " + x + " Y: " + y); 
    });
</script>

</body>
</html>