function resize()
{
    var heights = window.innerHeight ;
    var width= window.innerWidth+'px';
    var c, cS;
    
    c=document.querySelector('.container');
    cS= getComputedStyle(c);
    
    document.getElementById("map").style.height = heights-110 + "px";
    document.getElementById('map').style.width=(parseInt(width))+'px';
}

resize();

window.onresize = function () {
    resize();
};