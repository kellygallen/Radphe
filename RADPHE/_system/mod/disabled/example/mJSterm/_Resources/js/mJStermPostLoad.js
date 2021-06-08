 // https://stackoverflow.com/questions/34867066/javascript-mouse-click-coordinates-for-image
  document.getElementById("Terminal").addEventListener('click', function (event) {
	var ImageDOM = document.getElementById("Terminal");
	var ImageFieldFridgeX = document.getElementById("TermClickX");
	var ImageFieldFridgeY = document.getElementById("TermClickY");

    // https://stackoverflow.com/a/288731/1497139
    bounds=this.getBoundingClientRect();
    var left=Math.round(bounds.left);
    var top=Math.round(bounds.top);
    var xx = Math.round(event.pageX);
    var yy = Math.round(event.pageY);
    //ImageFieldFridgeX.value = Math.round(x);//px fix below in comment issue.
    //ImageFieldFridgeY.value = Math.round(y);
    var x = xx - left;
    var y = yy - top;
    var cw = Math.round(this.clientWidth);
    var ch = Math.round(this.clientHeight);
//    var iw = ImageDOM.naturalWidth;
//    var ih = ImageDOM.naturalHeight;
    var iw = Math.round(ImageDOM.width);
    var ih = Math.round(ImageDOM.height);
    var px = Math.round(x/cw*iw);
    var py = Math.round(y/ch*ih);
	ImageFieldFridgeX.value = Math.round(px);
	ImageFieldFridgeY.value = Math.round(py);
//px and py are supposed to be adjusted for screen/device/zoom and css resized/scaled image. that broke at some point.
//    alert("\n("+xx+","+yy+") un-altered click on "+this.tagName+"\n("+px+","+py+") pixle location\n("+x+"," + y+ ") mouse pos\n\n("+left+","+top+") relative to boundingClientRect\n"+cw+" x "+ch+" client image size\n"+iw+" x "+ih+" natural image size\n" );
//maybe it is edge... or a browser js dom change... something changed. click cordinates are just wrong. and get worse as y increases.
//what messes it up is page scroll!
//very possibly!!
});

