$(document).ready(function() {
	$('.1').prependTo('#pholdering');
	$('#parsed').toc();
	$('ul#ugh').bonsai();
	$('ul#pholdering').monsai();
	$('.sidebar-toggle').on('click', function() {
		menumojo();
	});
	$("#page-content-wrapper").click(function() {
		if($("#hamburger").hasClass("is-active")) {
			menumojo();
		}
	});
});
$(document).keyup(function(e) {
	if(($("#hamburger").hasClass("is-active")) && (e.keyCode == 27)) {
		menumojo();
	}
});

function menumojo() {
	$("#hamburger").toggleClass("is-active");
	$("#wrapper").toggleClass("toggled");
	$('.sidebar-nav').toggleClass('subshy subunshy');
 	$(".logout-row").delay(1000).fadeToggle('slow');

}
$('#click').click(function() {
	$('#parsed, #raw').toggleClass('nist');
	$(this).toggleClass('fa-pencil fa-eye');
			$('#parsed').toc();
});

$(document).ready(function()
{
    $('.autosave').keyup(function() {
        var takethis = $("#takethis").val();
        var prelink=document.location.href;
        var link = prelink + ".md";
        delay(function() {
            $.ajax({
		url:prelink,
                type: "post",
                data: { takethis: takethis },
                success: function(data) {
		$("#parsed").load(location.href+" #parsed>*","");

                }
            });
        }, 500 );
    });
});
var delay = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();

// bootstrap hover
$('ul.navbar-nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
