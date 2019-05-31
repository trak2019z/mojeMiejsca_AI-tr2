function resize()
{
    var heights = window.innerHeight ;
    
    document.getElementById("placeView").style.height = heights-150 + "px";
    document.getElementById("placeView").style.width = "100%";
}

resize();

window.onresize = function () {
    resize();
};