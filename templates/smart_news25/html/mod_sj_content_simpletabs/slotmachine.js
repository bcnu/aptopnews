/*------------------------------------------------------------------------
 # Ytc Content Simple Tabs  - Version 1.0
 # ------------------------------------------------------------------------
 # Copyright (C) 2009-2010 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://addon.ytcvn.com
 -------------------------------------------------------------------------*/

// When the DOM is ready
(function($) {

    $.fn.simpleTabs = function(options) {
		
        //Yo' defaults
        var defaults = {
			allContentBoxes:".content-box",
			allTabs:".tabs li a",
			$el:"", $colOne:"", $colTwo:"", $colThree:"",
			hrefSelector:"",
			speedOne:1000,
			speedTwo:2000,
			speedOne:1000,
			columnReadyCounter:0
		};
	
	  //Extend those options
	var options = $.extend(defaults, options); 

	return this.each(function() {
		var module_id = this.id;
		options.allContentBoxes = "#"+module_id+" "+options.allContentBoxes;
		options.allTabs = "#"+module_id+" "+options.allTabs;
		$("#"+module_id+" .tabs li:first-child a, #"+module_id+" .content-box:first").addClass("current");
		$("#"+module_id+" .box-wrapper .current .col").css("top", 0);
	
		//$(this).delegate(".tabs a", "click", function() {
		($(this).find(".tabs a")).click(function() {
												 
			$el = $(this);
			
			if ( (!$el.hasClass("current")) && ($(":animated").length == 0 ) ) {
			
				// current tab correctly set
				$(options.allTabs).removeClass("current");
				$el.addClass("current");
				
				// optional... random speeds each time.
				speedOne = Math.floor(Math.random()*1000) + 500;
				speedTwo = Math.floor(Math.random()*1000) + 500;
				speedThree = Math.floor(Math.random()*1000) + 500;
			
				// each column is animated upwards to hide
				// kind of annoyingly redudundant code
				
				colOne = $("#"+module_id+" .box-wrapper .current .col-one");
				colOne.animate({
					"top": colOne.height()
				}, speedOne);
			
				colTwo = $("#"+module_id+" .box-wrapper .current .col-two");
				colTwo.animate({
					"top": colTwo.height()
				}, speedTwo);
			
				colThree = $("#"+module_id+" .box-wrapper .current .col-three");
				colThree.animate({
					"top": colThree.height()
				}, speedThree);
				
				// new content box is marked as current
				$(options.allContentBoxes).removeClass("current");		
				hrefSelector = "#" + $el.attr("name");
				$(hrefSelector).addClass("current");
			
				// columns from new content area are moved up from the bottom
				// also annoying redundant and triple callback seems weird
				$("#"+module_id+" .box-wrapper .current .col-one").animate({
					"top": 0
				}, speedOne, function() {
					ifReadyThenReset(module_id,options);
				});
		
				$("#"+module_id+" .box-wrapper .current .col-two").animate({
					"top": 0
				}, speedTwo, function() {
					ifReadyThenReset(module_id,options);
				});
			
				$("#"+module_id+" .box-wrapper .current .col-three").animate({
					"top": 0
				}, speedThree, function() {
					ifReadyThenReset(module_id,options);
				});
				
			
			};    return false; 
		});
		
		function ifReadyThenReset(module_id,options) {
			
			options.columnReadyCounter++;
			
			if (options.columnReadyCounter == 3) {
				$("#"+module_id+" .col").not(".current .col").css("top", 350);
				columnReadyCounter = 0;
			}

		};
	});

	

    }//simpleTabs plugin call
})($jYtc);