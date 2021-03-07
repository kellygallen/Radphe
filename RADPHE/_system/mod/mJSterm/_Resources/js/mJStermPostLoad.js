 // https://stackoverflow.com/questions/34867066/javascript-mouse-click-coordinates-for-image
  document.getElementById("Terminal").addEventListener('click', function (event) {
	var ImageDOM = document.getElementById("Terminal");
	var ImageFieldFridgeX = document.getElementById("TermClickX");
	var ImageFieldFridgeY = document.getElementById("TermClickY");

    // https://stackoverflow.com/a/288731/1497139
    bounds=this.getBoundingClientRect();
    var left=bounds.left;
    var top=bounds.top;
    var x = event.pageX - left;
    var y = event.pageY - top;
    var cw = this.clientWidth;
    var ch = this.clientHeight;
//    var iw = ImageDOM.naturalWidth;
//    var ih = ImageDOM.naturalHeight;
    var iw = ImageDOM.width;
    var ih = ImageDOM.height;
    var px = x/cw*iw;
    var py = y/ch*ih;
	ImageFieldFridgeX.value = Math.round(px);
	ImageFieldFridgeY.value = Math.round(py);

//    alert("click on "+this.tagName+" at pixel ("+px+","+py+") mouse pos ("+x+"," + y+ ") relative to boundingClientRect at ("+left+","+top+") client image size: "+cw+" x "+ch+" natural image size: "+iw+" x "+ih );
  });

