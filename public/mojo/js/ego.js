$.fn.egofunction = function() {
    this.css( "position", "absolute" );
	 watchWinChange = this;
    var $this = $(this);
var wego = $this.width();
var hego = $this.innerHeight();
var w = $(window).width();
var h = $(window).height();
var midW = ((w / 2) - (wego / 2)) + 'px';
var midH = ((h / 2) - (hego /2)) + 'px';
var styled = {
    "top": midH,
    "left": midW
}   ;
$this.css(styled);
	$(window).resize(function(){
        watchWinChange.egofunction();
    });
}
$("#ego").egofunction();

