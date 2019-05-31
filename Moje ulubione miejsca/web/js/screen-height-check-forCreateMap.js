function resize()
{
    var heights = window.innerHeight ;
    
    document.getElementById("createMap").style.height = heights-150 + "px";
}

resize();

window.onresize = function () {
    resize();
};