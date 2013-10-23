var basespeed = 15000;
var numberPics = 5;
var picturePool = Array();
var showClass = 0;
var moveCloud = true;

$(document).ready(function() {
	// stop ajax because of random numbers
	$.ajaxSetup({async: false});
	//generate clouds
	for (var i=0; i < numberPics; i++) {
		// get random picture via PHP
		$.get("php/randomCloud.php?dir=../img/maturanten/", function(response){
			var dom = $(response); // convert string to dom
	
			dom.insertBefore('#gallery-maturanten span');
		});
	}; 
	
	// Navigation scroll
	$('#nav').onePageNav({         // #nav must be the id of your navigation
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 750,          // change this parameter to adjust scrolling speed
        scrollOffset: 30
    });
	
	//set .active #gallery-maturanten
	$('#gallery-maturanten ul li').click(function() {
		$('#gallery-maturanten ul li').removeClass('active');
		$(this).addClass('active');
	});
	
	// parallax
	$.stellar();
	
	// load gallery
	$.get("php/loadPics.php?dir=../img/ball/aufbau/", function(response){
			var dom = $(response); // convert string to dom
			$("#gallery-aufbau").append(dom);
	});
	$.get("php/loadPics.php?dir=../img/ball/nacht/", function(response){
			var dom = $(response); // convert string to dom
			$("#gallery-ball").append(dom);
	});
	
	// move Clouds
	moveClouds();
});

function moveClouds(){  
  $('#gallery-maturanten div').each(function animation(){
  	// Animate Pictures
  	var rspeed = Math.floor(Math.random()*7000);
	$(this).animate({left: "120em"}, basespeed + rspeed, 'linear', function(){
	  	// Reset Cloud
	  	$(this).css("left", "-15em");
		
		// make copy of cloud
		var cloud = $(this);
		
		// get new image from PHP
 		$.get("php/randomPicture.php?class=" + showClass, function(response){
			cloud.find('a img').attr('src', response);
  			cloud.find('a').attr('href', response);

  			// filter name out .... dirty work
  			var nameInklExtension = response.substr(20);
  			var name = nameInklExtension.slice(0, -4).replace('_', ' ');
  			cloud.find('a').attr('title', name);
 		});
 		//REDO
 		if(moveCloud == true)
  			moveClouds();
  	});
  });
}



function showGallery(classname){
	// Stop Move Clouds
		moveCloud = false;

	// Clean Gallery
		$('#gallery-maturanten div').fadeOut('fast');
		$('#gallery-maturanten div').remove();

	
	// change Style to meet Gallery
	var width = $( window ).width();
	var cloudHeight = 200;
	var cloudWidth = 280;
	var columns = width / cloudWidth;
	var numberClouds = 0;
	var newHeight = 0;
	
	
	// Get Gallery and put in Constainer
	$.get("php/loadGallery.php?dir=../img/maturanten/" + classname, function(response){
			var input = $(response);
			
			// Calculate Gallery height
			numberOfClouds = input.length;
			var rows = numberOfClouds / columns;
			newHeight = rows * cloudHeight;
			console.log(numberOfClouds + " % " + Math.floor(columns) + " = " + numberOfClouds % Math.floor(columns));
			var missingClouds = ((numberOfClouds % Math.floor(columns)) -5) *-1;
			
			// add new CSS
			$('#gallery-maturanten').css('height', newHeight + "px");
			
			// append
			//$("#gallery-maturanten ul").insertBefore(input);
			input.insertBefore('#gallery-maturanten span');
			
			// append transparent clouds
			for(var i = 0; i < missingClouds; i++){
				var tCloud = $('<div style="visibility: hidden;" class="galleryCloud"><div>');
				//$("#gallery-maturanten ul").insertBefore(tCloud);
				tCloud.insertBefore('#gallery-maturanten span');
			}
 		});

}
