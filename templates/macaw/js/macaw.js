// JavaScript Document

$(function() {
    $(".randomslides").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev"
    });
});






$(document).ready(function() {

$('a.screenshot').tooltip(function (el) {
        var c = (el.anchor_title != "") ? "<br/>" + el.anchor_title : "";
       return "<img class='BOXGAMES_IMG' src='"+ el.rel +"' alt='url preview' />"+ c;
  }, {'tooltipID': 'screenshot'});
 
 

$('#slider').anythingSlider({
hashTags: false,
buildStartStop: false,
autoPlay: true
});

$('#tabs > div').hide();
$('#tabs div:first').show(); 
$('#tabut li:first').addClass('active');
$('#tabut li a').click(function(){ 
$('#tabut li').removeClass('active');
$(this).parent().addClass('active'); 
var currentTab = $(this).attr('href');
$('#tabs > div').hide();
$(currentTab).show();
return false;
});


	//Select all anchor tag with rel set to tooltip
	$('a[rel=tooltip]').mouseover(function(e) {
		
		//Grab the title attribute's value and assign it to a variable
		var tip = $(this).attr('title');	
		
		//Remove the title attribute's to avoid the native tooltip from the browser
		$(this).attr('title','');
		
		//Append the tooltip template and its value
		$(this).append('<div id="tooltip"><div class="tooltipBOX">' + tip + '</div></div>');		
				
		//Show the tooltip with faceIn effect
		$('#tooltip').fadeIn('500');
		$('#tooltip').fadeTo('10');
		
	}).mousemove(function(e) {
	
		//Keep changing the X and Y axis for the tooltip, thus, the tooltip move along with the mouse
		$('#tooltip').css('top', e.pageY + 40 );
		$('#tooltip').css('left', e.pageX + -90 );
		
	}).mouseout(function() {
	
		//Put back the title attribute's value
		$(this).attr('title',$('.tooltipBOX').html());
	
		//Remove the appended tooltip template
		$(this).children('div#tooltip').remove();
		
	});
	


});