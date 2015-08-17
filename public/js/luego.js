// using "jQuery" here instead of the dollar sign will protect against conflicts with other libraries like MooTools
jQuery(document).ready(function() {

    //Set default Jacked ease
    Jacked.setEase("Expo.easeOut");
	Jacked.setDuration(500);
    Jacked.setEngines({
        firefox: true,
        opera: true,
        safari: true,
		ios: true
    });
    jQuery.easing.def = "easeInOutExpo";
    jQuery.eko();

});

// plugin structure used so we can use the "$" sign safely
 (function($) {

    //main vars
    var mainContainer;
	var scrollTop;
	var win;
	var contWidth;
	var prevContWidth;
	var isMobile;
	var isIE;
	var isIE8;
	var firstLoad = true;
	
	var days;
	var hours;
	var minutes;
	var seconds;
	
	var daysTemp;
	var hoursTemp;
	var minutesTemp;
	
	var daysPct;
	var hoursPct;
	var minutesPct;
	var secPct;
	

	var arcAr = [];
	var arcTxtAr = [];
	var mobileArcAr = [];
	
	var circleSize;
	var fullSize;
	
	


    // class constructor / "init" function
    $.eko = function() {
		
		
		
		
        // write values to global vars, setup the plugin, etc.
        browser = Jacked.getBrowser();
        isMobile = (Jacked.getMobile() == null) ? false : true;
		isIE8 = Jacked.getIE();
		
		if(isMobile){
			$('html').addClass('mobile');
		}
		if(isIE8){
			$('html').addClass('ie8');
		}
		
		isIE = browser == 'ie' ? true : false;
		
		//conditional compilation
		var isIE10 = false;
		/*@cc_on
			if (/^10/.test(@_jscript_version)) {
				isIE10 = true;
			}
		@*/
		if(isIE10) isIE = true;
		if(isIE) $('html').addClass('ie');
		
		
		$('.navBtn').click(function() {
				$.scrollTo('#about', 800);						
		});
		
		


		
		//Save DOM elements
		win = $(window);
		win.scrollTop(0);

		mainContainer = $('.container');
        contWidth = mainContainer.width();
		prevContWidth = contWidth;
		
		//handle window events
		$(window).resize(function() {						  
             handleWindowResize();
		});
		handleWindowResize();
		
		
		
		$('.progressbars').bind('inview', function (event, visible) {
		  if (visible == true) {
			initProgressBars();
			$('.progressbars').unbind('inview');
		  }
		});
		
		
		//listen to video start and remove preloader
		if($('body').find('video').length){
			var video = document.getElementById("video");
			var vTime;
			
			
			function onVideoPlaying(){
				
				//  Current time  
				vTime = video.currentTime;
				

				
				if(vTime.toFixed(1) > 0){
					$('.preloader.main').fadeOut();
					video.removeEventListener("timeupdate", onVideoPlaying);
				}
				
			};
			
			
			video.addEventListener("timeupdate", onVideoPlaying , false);
		}

		

		//Init
		initBg();
		initTipsy();
		initArcs();
        initCountdown();
		initInputFields();
		initNewsletter();
		initContactForm();




    }
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //COUNTDOWN
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
	function initBg(){
		

		if(!$('body').find('video').length){
			$.supersized({
			
				// Functionality
				slide_interval          :   3000,		// Length between transitions
				transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
				transition_speed		:	2000,		// Speed of transition
														   
				// Components							
				slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
				slides 					:  	[			// Slideshow Images
													{image : 'images/home/1.jpg'},
													{image : 'images/home/2.jpg'},  
													{image : 'images/home/3.jpg'}
											]
				
			});
		}
		else if(isMobile){
			
			$.supersized({
				slides  :  	[ {image : 'images/home/1.jpg'} ]
			});
			

			$('.preloader.main').fadeOut();
		
			
		}


	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //COUNTDOWN
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
	function initCountdown(){
		
		
		if(!Raphael.svg || !Raphael.vml){
			
			$('#home .arc').each(function(i) {						  
				mobileArcAr.push($(this));	
				
			});
		}
		

		
		
		
		var endDate = $('.arcs').attr('data-endDate').split('/');
		
		var endDay = parseInt(endDate[0], 10);
		var endMonth = parseInt(endDate[1], 10);
		var endYear = parseInt(endDate[2], 10);
		
		var austDay = new Date();
		
	    austDay = new Date(austDay.getFullYear() + endYear-austDay.getFullYear(), endMonth - 1, endDay);
	    $('.cd').countdown({until: austDay, onTick: cdTick, tickInterval: 1});
		

	}
	
	
	function cdTick(periods) { 

		
		//console.log(periods);
		days = periods[3];
		hours = periods[4];
		minutes = periods[5];
		seconds = periods[6];

		var daysPct;
	    var hoursPct;
	    var minutesPct;
		
		
		//animate days
		if(Raphael.svg || Raphael.vml){
			
			arcTxtAr[0].attr("text", days);
			
			daysPct = Math.floor(days*100/365);
			
			var daysAnim = Raphael.animation({
				arc: [fullSize/2, fullSize/2, daysPct, 100, circleSize/2]
			}, 1000, "bounce");
	
			arcAr[0].stop().animate(daysAnim);
			
			
			//animate hours
			arcTxtAr[1].attr("text", hours);
			
			hoursPct = Math.floor(hours*100/24);
			
			var hoursAnim = Raphael.animation({
				arc: [fullSize/2, fullSize/2, hoursPct, 100, circleSize/2]
			}, 1000, "bounce");
	
			arcAr[1].stop().animate(hoursAnim);
			
			
			//animate minutes
			arcTxtAr[2].attr("text", minutes);
			
			minutesPct = Math.floor(minutes*100/60);
			
			var minutesAnim = Raphael.animation({
				arc: [fullSize/2, fullSize/2, minutesPct, 100, circleSize/2]
			}, 1000, "bounce");
	
			arcAr[2].stop().animate(minutesAnim);
			
			//animate seconds always
			arcTxtAr[3].attr("text", seconds);
			
			secPct = Math.floor(seconds*100/60);
			
			var secAnim = Raphael.animation({
				arc: [fullSize/2, fullSize/2, secPct, 100, circleSize/2]
			}, 1000, "bounce");
	
			arcAr[3].stop().animate(secAnim);
			
		}
		else{
			
			mobileArcAr[0].find('span').first().text(days);
			mobileArcAr[1].find('span').first().text(hours);
			mobileArcAr[2].find('span').first().text(minutes);
			mobileArcAr[3].find('span').first().text(seconds);
	
			
		}

		
	}
	
	
	function initArcs(){
		
            if(Raphael.svg || Raphael.vml){
				
				$('#home').find('svg').remove();
				arcAr = [];
				arcTxtAr = [];
				
				//main vars
				var arcs = $('.arcs');
				
				var amount = 100;
				var strkw = arcs.attr('data-stokewidth');
				var fontSize = arcs.attr('data-fontSize');
				var circleColor = arcs.attr('data-circleColor');
				var strokeInnerColor = arcs.attr('data-innerStrokeColor');
				var strokeColor = arcs.attr('data-strokeColor');
				var textColor = arcs.attr('data-textColor');
				circleSize = arcs.attr('data-size');
				fullSize = parseInt(circleSize, 10)+parseInt(strkw, 10);
				
				$('#home .arc').each(function(i) {
										   
					var arc = $(this);
					var contWidth = arc.width();
					arc.attr('id', 'arc'+i);
					
					arc.css('margin-top', -fullSize+'px').delay(100*(i+1)).animate({
						  'margin-top': 0
						}, 1000);
	
					
					if(parseInt(circleSize, 10)+parseInt(strkw, 10)>contWidth){
						circleSize = contWidth-strkw;
						fullSize = parseInt(circleSize, 10)+parseInt(strkw, 10);
					}
					
					
				
	
					var interval;
					
	
					//Create raphael object
					var r = Raphael('arc'+i, fullSize, fullSize);
					
					
					//draw inner circle
					r.circle(fullSize/2, fullSize/2, circleSize/2).attr({ stroke: strokeInnerColor, "stroke-width": strkw, fill:  circleColor });
		
					//add text to inner circle
					var title = r.text(fullSize/2, fullSize/2, 0).attr({
						font: fontSize+'px Oswald',
						fill: textColor
					}).toFront();
					
					
					arcTxtAr.push(title);
					
					
					r.customAttributes.arc = function (xloc, yloc, value, total, R) {
						
						
						var alpha = 360 / total * value,
							a = (90 - alpha) * Math.PI / 180,
							x = xloc + R * Math.cos(a),
							y = yloc - R * Math.sin(a),
							path;
						if (total == value) {
							path = [
								["M", xloc, yloc - R],
								["A", R, R, 0, 1, 1, xloc - 0.01, yloc - R]
							];
						} else {
							path = [
								["M", xloc, yloc - R],
								["A", R, R, 0, +(alpha > 180), 1, x, y]
							];
						}
						return {
							path: path
						};
					};
					
					//make an arc at 150,150 with a radius of 110 that grows from 0 to 40 of 100 with a bounce
					var my_arc = r.path().attr({
						"stroke": strokeColor,
						"stroke-width": strkw,
						arc: [fullSize/2, fullSize/2, 0, 100, circleSize/2]
					});
					
					
					arcAr.push(my_arc);
					
					
					var anim = Raphael.animation({
						arc: [fullSize/2, fullSize/2, amount, 100, circleSize/2]
					}, 1500, "easeInOut");
					
			
					
					
					if(contWidth == 390 || contWidth == 270) $('svg').css('padding-left',(contWidth-fullSize)/2+'px');
					
					
				});
				
				
				
				//listen to video start and remove preloader
				if(!$('body').find('video').length){
					$('.preloader.main').fadeOut();
				}
		
			}
			

		
	}
	

	
	
	
	function rgb2hex(rgb) {
		rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		function hex(x) {
			return ("0" + parseInt(x).toString(16)).slice(-2);
		}
		return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
	}
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////
	//Init progress bars
	/////////////////////////////////////////////////////////////////////////////
	
	function initProgressBars(){
		
		if ($('.progressbars').length) {
			
			$('.progressbars').each(function() {
									   
				var s = $(this);
				var w = s.width()
				
				s.find('.over').each(function(i) {
											  
					var o = $(this);
					var pct = o.attr('data-percentage');
					var tip = o.parent().find('.tooltip');
					var txt = tip.find('span');
					
					tip.css({
						'opacity': 0,
						'left': 0
					});
					
					o.css('width', 0);
					
					
                    tip.delay(100*(i+1)).animate({
					  'opacity': 1
					}, 2000);
					
		
					o.delay(200*(i+1)).animate({
					  width: pct+'%'
					},
					{
					  duration: 2000,
					  step: function(now, fx) {
						var data = fx.elem.id + ' ' + fx.prop + ': ' + now;
						
						var destX = Math.round(now*w/100)-15+'px';
						
						tip.css('left', destX);
						txt.text(Math.round(now)+'%')
					  }
					});
					
					
				});
									
			});
			
		}
		
	}
	
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    //TIPSY TOOLTIP
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function initTipsy() {

        mainContainer.find('.tooltip').each(function() {

            var t = $(this);

            t.css({
                cursor: 'pointer'
            }).tipsy({
                gravity: 's',
                fade: true,
                offset: 5,
                opacity: 1,
                title: 'data-tooltipText'
            });

        });

    }
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //CONTACT FORM - INPUT FIELDS - NEWSLETTER
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
	
    function initNewsletter() {

        $('.mailchimp').submit(function() {

                var action = $(this).attr('action');
                var values = $(this).serialize();
				
				$.post(action, values, function(data) {

						  $('.mcresult').hide().html(data).fadeIn();
						  setTimeout(resetMailchimp,5000);
	
                 });

                return false;

            });

    }
	
	function resetMailchimp(){
		
		$('.mcresult').html('');
		$('.mailchimp input[type=submit]').fadeIn(500);
		
		$('.mailchimp input[type=text]').each(function() {
													  
				var ipt = $(this);
				ipt.hide().val(ipt.attr('oValue')).fadeIn();
		});
		
	}
	
	function initInputFields(){
		
            var curVal;
			
			
			$('input[type=text]').each(function() {
					var ipt = $(this);
					ipt.attr('oValue', ipt.val());
					
					ipt.focus(function() {
						curVal = ipt.val();
						ipt.val('');
					});
					
					ipt.blur(function() {
						if (ipt.val() == '') {
							ipt.val(curVal);
						}
					});
					
			});
			
			$('textarea').each(function() {
					var ipt = $(this);
					ipt.attr('oValue', ipt.val());
					
					ipt.focus(function() {
						curVal = ipt.val();
						ipt.val('');
					});
					
					ipt.blur(function() {
						if (ipt.val() == '') {
							ipt.val(curVal);
						}
					});
					
			});
			
		
	}

    function initContactForm() {



            $('#contactform').submit(function() {


                var action = $(this).attr('action');
                var values = $(this).serialize();

                $('#contactform #submit').attr('disabled', 'disabled').after('<img src="images/contact/ajax-loader.gif" class="loader" />');


                $("#message").slideUp(750, function() {

                    $('#message').hide();

                    $.post(action, values, function(data) {
                        $('#message').html(data);
                        $('#message').slideDown('slow');
                        $('#contactform img.loader').fadeOut('fast', function() {
                            $(this).remove()
                            });
                        $('#contactform #submit').removeAttr('disabled');
                        if (data.match('success') != null){
						}

                    });

                });

                return false;

            });

      

    }
	
	
	
	
	
	
	
    /////////////////////////////////////////////////////////////////////////////
	//handleWindowResize
	/////////////////////////////////////////////////////////////////////////////
	function handleWindowResize(){

		
		contWidth = mainContainer.width();
		
		if (contWidth != prevContWidth) {
			
			prevContWidth = contWidth;
			initArcs();
			initProgressBars();

		}
		
	}
	

		

    /////////////////////////////////
    //End document


})(jQuery);