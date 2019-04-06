// IF JS IS ENABLED, REMOVE 'no-js' AND ADD 'js' CLASS
jQuery('html').removeClass('no-js').addClass('js');

var Bean_Isotope = Bean_Isotope || {};
Bean_Isotope.callAfterNewElements = [];

function isCanvasSupported() {
	var elem = document.createElement('canvas');
	return !!(elem.getContext && elem.getContext('2d'));
}

jQuery(document).ready(function($) {
	"use strict";

	//FITVIDS
	$("#page-inner, .widget_bean_video").fitVids();


	//DROPDOWNS - SUPERFISH
	$('nav ul#primary-menu').superfish({
    		delay: 0,
    		animation: { opacity:'show', height:'show' },
    		speed: 0,
    		cssArrows: false,
    		disableHI: true
	});


	//MATERIAL INPUTS
	$('#BeanForm input').blur(function() {
		"use strict";
		if ($(this).val())
			$(this).addClass('used');
		else
		$(this).removeClass('used');
	});


	//LIGHTBOX TRIGGER
	$(".lightbox").fancybox({
		fitToView: true,
		autoSize :  false,
		margin : 30,
		autoScale : false,
		width : '100%',
		height : '100%',
		helpers : {
			media : {}
		}
	});


	//FULLSCREEN MENU
	if( $('body').is('.menu_fullscreen, .menu_standard') ) {

		var menuTrigger = $('#nav-toggle');

		menuTrigger.on('click', function(e){
			"use strict";
			e.preventDefault();

			var nav = $('.menu-fullscreen');

			menuTrigger.toggleClass('active');
			nav.fadeToggle(300);

			if($(this).hasClass('active')){
				$('body').addClass('menu_fullscreen_open');
			}
			else {
				$('body').removeClass('menu_fullscreen_open');
			}
		});
	}


	//SIDEBAR MENU
	if( $('body').hasClass('menu_sidebar') ) {
		$( "#nav-toggle, .sidebar-close, .nav-overlay" ).click( function(e) {
			$( "body" ).toggleClass( "menu_sidebar_open" );
			$( "#menu-sidebar" ).toggleClass( "open" );
			$( "#nav-toggle" ).toggleClass( "active" );
			$( ".nav-overlay" ).toggleClass( "open" );
			return false;
		} );
	}


	//MENU DROPDOWNS
	$('#fullscreen-menu .sub-menu, #sidebar-menu .sub-menu').hide();

	$('#fullscreen-menu li a, #sidebar-menu li a').click(function(event){
		"use strict";
		if ($(this).next('ul.sub-menu').children().length !== 0) {
	     	event.preventDefault();
		}
		$(this).siblings('.sub-menu').slideToggle(150);
		$(this).toggleClass( "open" );
	});


	//FORM VALIDATION
	if (jQuery().validate) { jQuery("#commentform").validate(); }


	//COMMENTS
	var $commentform = $('#commentform');
	if ( $commentform.length ) {
		var commentformHeight = $commentform.height(),
			$cancelComment = $('#cancel-comment'),
			$commentTextarea = $('#comment');
		$commentTextarea.css({
			height : 52
		});
		$commentform.css({
			height : 52,
			overflow : 'hidden'
		}).on('click', function() {
			var $this = $(this);
			$this.animate({
				height : commentformHeight,
			}, 250);
			$commentTextarea.css({
				height : 'auto',
				overflow : 'visible'
			});
			$cancelComment.on('click', function(e) {
				e.preventDefault();
				$this.animate({
					height : 52,
				}, 250, function(){
					$commentTextarea.css({
						height : 52,
						overflow : 'hidden'
					});
				});
				return false;
			});
		});
	}


	//PRELOADER
	$(window).load(function() {
		"use strict";
		setTimeout(function(){
			$('body').addClass('loaded');
		}, 300);

		setTimeout(function(){
			$('.hero-area .post-cover').addClass('loaded');
		}, 1200);

		if( $('.hero-area .post-cover').hasClass('image-zoom') ) {
			setTimeout(function(){
				$('.hero-area .post-cover').addClass('imagezoom');
			}, 1750);
		}

	});


	//DOWN ARROW, HERO AREA SCROLLING
	$(function() {
		"use strict";
		$('a.down-arrow, #back-to-top').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {

					if( $("body").hasClass('admin-bar') ) {
						$('html,body').animate({
							scrollTop: target.offset().top - $(".header").outerHeight() - 32
						}, 1300);
					} else {
						$('html,body').animate({
							scrollTop: target.offset().top - $(".header").outerHeight()
						}, 1300);
					}

					if( $("body").hasClass('single-format-audio') ) {
						$('html,body').animate({
							scrollTop: target.offset().top - $(".header").outerHeight() - 50
						}, 300);
					}

					return false;
				}
			}
		});
	});


	//FULLSCREEN PROJECT HIDE/SHOW
	$(window).load(function() {
		"use strict";
		if( $("body").hasClass('single_portfolio_fullscreen') ) {
			var $projectContent = $('#page-container').find('.project-content.expandable'),
				projectHeight = $projectContent.outerHeight(),
				$hideDetails = $('#hide-details');
			$hideDetails.on('click', function() {
				var currentHeight = $projectContent.outerHeight();
				if( currentHeight > 30 ) {
					$projectContent.animate({ height: 30,paddingTop: 0,paddingBottom: 0
					}, 200, function() {
						$projectContent.toggleClass('hide-content');
						$hideDetails.removeClass('active');
						$projectContent.animate({width: 30,padding: 0}, 200);
					});
				} else {
					$projectContent.animate({width: '100%',paddingLeft: 50,paddingRight: 50
					}, 200, function() {
						$projectContent.animate({height: projectHeight,paddingBottom: 50,paddingTop: 50}, 100, function() {
							$projectContent.toggleClass('hide-content');
							$hideDetails.addClass('active');
						});
					});
				}
			});
		}
	});


	//MOBILE FILTER
	var FilterTrigger = $('#filter-toggle'),
	    SubHeader = $('#sub-header'),
	    Filter = $('#project-filter'),
	    Filter_a = $('#project-filter a');

	FilterTrigger.on('click', function(e){
		"use strict";
		Filter.addClass( "open" );
		SubHeader.addClass( "open" );
	});

	Filter_a.on('click', function(e){
		"use strict";
		Filter.removeClass('open');
		SubHeader.removeClass( "open" );
	});


	//THEME STRUCTURE
	! function(a) {
	    "use strict";
	    a(document).ready(function() {
			a("#page-container").css({
				"margin-top": a(".header").outerHeight()
			});

			a(".single-portfolio .page-inner").css({
				"margin-bottom": a(".footer").outerHeight()
			});

			a(".page-template-template-portfolio-fullpage-php #page-inner").css({
				"margin-top": a(".header").outerHeight() / 2
			});

			a(".page-template-template-portfolio-fullpage-php #page-container.has-hero").css({
				"margin-top": a(".header").outerHeight() / 2
			});

			a(".hero-area.hero-fullscreen").css({
				"margin-top": - a(".header").outerHeight() / 2,
				"margin-bottom": - a(".header").outerHeight() / 2
			});

			a(".hero-area .jp-audio").css({
				"bottom": a(".header").outerHeight() / 2
			});

			if( a("#projects").hasClass('filtered') ) {
				a("#sub-header.no-hero").css({
					"margin-top": a(".header").outerHeight()
				});

				a("#projects.filtered").css({
					"margin-top": a("#sub-header").outerHeight() + a(".header").outerHeight()
				});
			}

			if( a("body").is('.archive, .search') ) {
				a(".sub-header").css({
					"margin-top": a(".header").outerHeight()
				});

				a("#page-container").css({
					"margin-top": a(".sub-header").outerHeight() + a(".header").outerHeight()
				});
			}

			if( a("body").hasClass('single-format-gallery') ) {
				a(".superslides").css({
					"margin-top": - a(".header").outerHeight() / 2,
					"margin-bottom": - a(".header").outerHeight() / 2
				});
			}

			if( a("body").hasClass('page-template-template-contact-php') ) {
				a(".contact-wrapper .entry-content").css({
					"height": a(".contactform").outerHeight(),
				});
			}


			a(window).resize(function(){
		   		a("#page-container").css({
					"margin-top": a(".header").outerHeight()
				});

				a(".single-portfolio .page-inner").css({
					"margin-bottom": a(".footer").outerHeight()
				});

				a(".page-template-template-portfolio-fullpage-php #page-inner").css({
					"margin-top": a(".header").outerHeight() / 2
				});

				a(".page-template-template-portfolio-fullpage-php #page-container.has-hero").css({
					"margin-top": a(".header").outerHeight() / 2
				});

				a(".hero-area.hero-fullscreen").css({
					"margin-top": - a(".header").outerHeight() / 2,
					"margin-bottom": - a(".header").outerHeight() / 2
				});

				a(".hero-area .jp-audio").css({
					"bottom": a(".header").outerHeight() / 2
				});

				if( a("#projects").hasClass('filtered') ) {
					a("#sub-header.no-hero").css({
						"margin-top": a(".header").outerHeight()
					});

					a("#projects.filtered").css({
						"margin-top": a("#sub-header").outerHeight() + a(".header").outerHeight()
					});
				}

				if( a("body").is('.archive, .search') ) {
					a(".sub-header").css({
						"margin-top": a(".header").outerHeight()
					});

					a("#page-container").css({
						"margin-top": a(".sub-header").outerHeight() + a(".header").outerHeight()
					});
				}

				if( a("body").hasClass('single-format-gallery') ) {
					a(".superslides").css({
						"margin-top": - a(".header").outerHeight() / 2,
						"margin-bottom": - a(".header").outerHeight() / 2
					});
				}

				if( a("body").hasClass('page-template-template-contact-php') ) {
					a(".contact-wrapper .entry-content").css({
						"height": a(".contactform").outerHeight(),
					});
				}

			});
	    })
	}(window.jQuery);

	//HERO AREA
	$(function(){
		"use strict";
		var pageHeight = jQuery(window).height();
		var loggedinHeight = pageHeight - 32;

		if( $('body').hasClass('admin-bar') ) {
			$('.hero-fullscreen').css({ "height": loggedinHeight + 'px' });
			$('.g-map .google-maps-builder').css({ "height": loggedinHeight - $(".header").outerHeight() + 'px' });
		} else {
			$('.hero-fullscreen').css({ "height": pageHeight + 'px' });
			$('.g-map .google-maps-builder').css({ "height": pageHeight - $(".header").outerHeight() + 'px' });
		}
		$(window).resize(function(){
			var pageHeight = jQuery(window).height();
			var loggedinHeight = pageHeight - 32;

			if( $('body').hasClass('admin-bar') ) {
				$('.hero-fullscreen').css({ "height": loggedinHeight + 'px' });
				$('.g-map .google-maps-builder').css({ "height": loggedinHeight - $(".header").outerHeight() + 'px' });
			} else {
				$('.hero-fullscreen').css({ "height": pageHeight + 'px' });
				$('.g-map .google-maps-builder').css({ "height": pageHeight - $(".header").outerHeight() + 'px' });
			}
		});
	});


	//HERO AREA PARALLAX
	! function(a) {
		"use strict";
		a(document).ready(function() {
			if (a(".hero-area .center-vertical").length) {
				var c = a(".hero-area"),
				d = c.outerHeight(),
				e = a(".hero-area .center-vertical"),
				f = a(".hero-area .post-cover"),
				h = a(".hero-area .background-video");
				e.css({
					position: "absolute",
					transform: "translate(0, " + -50 + "%)",
				}), a(window).on("scroll", function() {
					var b = 1 - a(window).scrollTop() / d * 1;
					var g = 1 - a(window).scrollTop() / d * 5;

					0 >= b && (b = 0), e.css({
						transform: "translate(0, " + -50 * g + "%)",
						opacity: b
					}),
					f.css({
						opacity: b
					}),
					h.css({
						opacity: b
					})
				}), a(window).on("resize", function() {
					e.css({
						position: "relative"
					}), d = c.outerHeight(), c.css({
					}), e.css({
						position: "absolute"
					});
					var b = 1 - a(window).scrollTop() / d * 2;
					var g = 1 - a(window).scrollTop() / d * 10;
					0 >= b && (b = 0), e.css({
						transform: "translate(0, " + -50 * g + "%)",
						opacity: b
					})
				})
			}
		})
	}(window.jQuery);


	//GRID INIT
	Bean_Likes.Bean_Likes_Init();
	Bean_Media.setupAudioPosts();
	Bean_Media.setupVideoPosts();

	Bean_Isotope.callAfterNewElements.push(Bean_Likes.Bean_Likes_Init);
	Bean_Isotope.callAfterNewElements.push(Bean_Media.setupAudioPosts);
	Bean_Isotope.callAfterNewElements.push(Bean_Media.setupVideoPosts);
});


//BEAN LIKES FUNCTIONS
var Bean_Likes = {
	Bean_Reload_Likes: function(who) {
	var text = jQuery("#" + who).html();
	var patt= /(\d)+/;

	var num = patt.exec(text);
	num[0]++;
	text = text.replace(patt,num[0]);
	jQuery("#" + who).html('<span class="count">' + text + '</span>');
	},

	Bean_Likes_Init: function() {
	jQuery(".bean-likes").click(function() {
		var classes = jQuery(this).attr("class");
		classes = classes.split(" ");

		if(classes[1] == "active") {
			return false;
		}
		var classes = jQuery(this).addClass("active");
		var id = jQuery(this).attr("id");
		id = id.split("like-");
		jQuery.ajax({
		  type: "POST",
		  url: "index.php",
		  data: "likepost=" + id[1],
		  success: Bean_Likes.Bean_Reload_Likes("like-" + id[1])
		});
		return false;
	});
	}
};


// FUNCTIONS FOR HANDLING POSTS OF TYPE 'AUDIO' AND 'VIDEO'
var Bean_Media = {
	setupAudioPosts: function() {

		if(jQuery().jPlayer) {
			jQuery(".jp-audio").each(function() {
				var mp3 = jQuery(this).data("file");
				var cssSelectorAncestor = '#' + jQuery(this).attr("id");

				jQuery(this).find(".jp-jplayer").jPlayer( {
					ready : function () {
							jQuery(this).jPlayer("setMedia", {
							mp3: mp3,
							end: ""
						});
					},
					size: {
					    width: "100%",
					},
					swfPath: WP_TEMPLATE_DIRECTORY_URI[0] + "/assets/js",
					cssSelectorAncestor: cssSelectorAncestor,
					supplied: (mp3 ? "mp3": "") + ", all"
				});
			});
		}
		jQuery(".jp-audio .jp-interface").css("display", "block");

	},

	setupVideoPosts: function() {
		jQuery('.jp-video').each(function() {
			var m4v = jQuery(this).data("file");
			var poster = jQuery(this).data("poster");

			var cssSelectorAncestor = '#' + jQuery(this).attr("id");

			jQuery(this).find(".jp-jplayer").jPlayer( { ready : function () {
			jQuery(this).jPlayer(
				'setMedia', {
						m4v: m4v,
						poster: poster
						}
					);
				},
				preload: 'auto',
				cssSelectorAncestor : cssSelectorAncestor,
				swfPath: WP_TEMPLATE_DIRECTORY_URI[0] + "/assets/js",
				supplied: (m4v ? "m4v":"") + ", all",
				size : {
					width : '100%',
					height: "100%"
				},
				wmode : 'window'
			});
		});
		jQuery(".jp-video .jp-interface").css("display", "block");
	}
};