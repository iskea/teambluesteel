/**
 * Elevate WP  v1.0.0
 */

jQuery(document).ready(function () {

	//Modal window request a call form

	$("#requestCallForm").validate({
		rules: {
			first_name: {
				required: true
			}, last_name: {
				required: true
			}, phone: {
				required: true
			}, email: {
				required: true, email: true
			}
		}, messages: {
			first_name: "Please fill in your first name",
			last_name: "Please fill in your last name",
			phone: "Please fill in your phone number",
			email: {
				required: "Please fill in your email", email: "Please enter valid email"
			}
		}, success: "valid",
		submitHandler: function(e) {
			$.ajax({
				type: "POST",
				url: "https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8",
				data: $('#requestCallForm').serialize(),
				statusCode: {
					200: function () {
						console.log("success");
						$("#requestCallBlock").removeClass('show');
						$("#requestCallBlock").addClass('hide');
						$("#requestCallThanks").removeClass('hide');
						$("#requestCallThanks").addClass('show');
					}
				}
			});
			return false;
		}

	});

	//Modal window subscribe form

	$("#submitEmailForm").validate({
		rules: {
			email: {
				required: true, email: true
			}
		}, messages: {
			email: {
				required: "Please fill in your email", email: "Please enter valid email"
			}
		}, invalidHandler: function () {
			$('.error-icon').removeClass('hide');
		}, onfocusout: false, onkeyup: false, success: "valid", submitHandler: function (evt) {
			$('.error-icon').addClass('hide');
			evt.preventDefault();
			$("#submitEmailForm .meter").removeClass("hide");
			$("#submitEmailForm .meter > span").each(function () {
				$(this).data("origWidth", $(this).width()).width(0).animate({
					width: $(this).data("origWidth")
				}, 3000);
			});
			$.ajax({
				type: "POST",
				url: "https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8",
				data: $('#submitEmailForm').serialize(),
				statusCode: {
					200: function () {
						console.log("success");
						$("#subscribeForm").removeClass('show');
						$("#subscribeForm").addClass('hide');
						$("#subscribeThanks").removeClass('hide');
						$("#subscribeThanks").addClass('show');
					}
				}
			});

		}

	});

	//Modal window event form

	$("#eventform").validate({
		rules: {
			email: {
				required: true, email: true
			}
		}, messages: {
			email: {
				required: "Please fill in your email", email: "Please enter valid email"
			}
		}, invalidHandler: function () {
			$('.error-icon').removeClass('hide');
		}, onfocusout: false, onkeyup: false, success: "valid", submitHandler: function (evt) {
			$('.error-icon').addClass('hide');
			evt.preventDefault();
			$("#eventform .meter").removeClass("hide");
			$("#eventform .meter > span").each(function () {
				$(this).data("origWidth", $(this).width()).width(0).animate({
					width: $(this).data("origWidth")
				}, 3000);
			});
			$.ajax({
				type: "POST", url: "test.php", data: $('#eventform').serialize(), statusCode: {
					200: function () {
						console.log("success");
						$("#EventSubscribeForm").removeClass('show');
						$("#EventSubscribeForm").addClass('hide');
						$("#eventThanks").removeClass('hide');
						$("#eventThanks").addClass('show');
					}
				}
			});

		}

	});

	/*

	 Subscription email form

	 */

	$("#subscriptionEmailForm").validate({
		rules: {
			email: {
				required: true, email: true
			}
		}, messages: {
			email: {
				required: "Please fill in your email", email: "Please enter valid email"
			}
		}, invalidHandler: function () {
			$('.error-icon').removeClass('hide');
		}, onfocusout: false, onkeyup: false, success: "valid", submitHandler: function (evt) {
			$('.error-icon').addClass('hide');
			evt.preventDefault();
			$("#subscriptionEmailForm .meter").removeClass("hide");
			$("#subscriptionEmailForm .meter > span").each(function () {
				$(this).data("origWidth", $(this).width()).width(0).animate({
					width: $(this).data("origWidth")
				}, 3000);
			});
			$.ajax({
				type: "POST",
				url: "https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8",
				data: $('#subscriptionEmailForm').serialize(),
				statusCode: {
					200: function () {
						$("#subscribeForm").removeClass('show');
						$("#subscribeForm").addClass('hide');
						$("#subscriptionEmailFormThankyouSection").removeClass('hide');
						$("#subscriptionEmailFormThankyouSection").addClass('show');
					}
				}
			});

		}

	});

	var $subscriptionformClose = $('.subscription-email-form .subscription-email-form-close');

	var SubscriptionFormCloseButton = $subscriptionformClose.on('click', function () {
		$('.subscription-email-form').addClass('hide');
	});

	/* Mega Menu */
	var megamenu = $(function () {
		// navbar mega dropdown animation on scroll
		$('.toggleLogoSmall').addClass('hide');
		$('.toggleLogoBig').addClass('show');

		var position = $(window).scrollTop();

		$(window).scroll(function () {

			$('.dropdown-toggle').each(function () {
				if ($(this).parent().hasClass("open")) {
					$(this).dropdown("toggle");
				}
			});
			//$('.dropdown-menu').stop().fadeOut("fast");

			var scroll = $(window).scrollTop();

			if (scroll > position) {
				//scroll up
				hideSticky();
			} else {
				//scroll down
				showSticky();

			}

			if ($(this).scrollTop() < 560) {
				hideSticky();
			}

			position = scroll;
		});

	});

	function hideSticky() {
		$('.navbar').addClass('fixed-top');
		$('.navbar').removeClass('navbar-fixed-top');

		$('.sticky-cta').removeClass('navbar-fixed-bottom');

		$('.toggleLogoSmall').addClass('hide');
		$('.toggleLogoSmall').removeClass('show');

		$('.toggleLogoBig').addClass('show');
		$('.toggleLogoBig').removeClass('hide');
	}

	function showSticky() {
		$('.navbar').removeClass('fixed-top');
		$('.navbar').addClass('navbar-fixed-top');
		$('.navbar-fixed-top').addClass('animateWidebar');

		$('.sticky-cta').addClass('animateWidebar');
		$('.sticky-cta').addClass('navbar-fixed-bottom');

		$('.toggleLogoSmall').addClass('show');
		$('.toggleLogoSmall').removeClass('hide');

		$('.toggleLogoBig').addClass('hide');
		$('.toggleLogoBig').removeClass('show');
	}

	var megamenuDropdown = $(function () {
		$('.dropdown-menu').click(function (e) {
			e.stopPropagation();
		});
	});

	/**
	 * Scroll to anchor link
	 */

	$(".disclaimer-link").click(function () {

		$("#disclaimer-accordion").collapse('show');

		var addressValue = $(this).attr("href");
		if ($("a" + addressValue).length) {
			$('html, body').animate({
				scrollTop: $("a" + addressValue).offset().top - 65
			}, 500);
		}
		return false;
	});

	var $grid = $('.column-content').isotope({
		itemSelector: '.grid-item', percentPosition: true
	});

	function getHashFilter() {
		var hash = location.hash;
		// get filter=filterName
		var matches = location.hash.match(/filter=([^&]+)/i);
		var hashFilter = matches && matches[1];
		return hashFilter && decodeURIComponent(hashFilter);
	}

	var $grid = $('.column-content');

	// bind filter button click
	var $filters = $('.tile-filter');
	$filters.on('click', function () {
		var filterAttr = $(this).attr('data-filter');
		// set filter in hash
		location.hash = 'filter=' + encodeURIComponent(filterAttr);
	});

	var isIsotopeInit = false;

	function onHashchange() {
		var hashFilter = getHashFilter();
		if (!hashFilter && isIsotopeInit) {
			return;
		}
		isIsotopeInit = true;
		// filter isotope
		$grid.isotope({
			itemSelector: '.grid-item', percentPosition: true, stagger: 80, filter: hashFilter, hiddenStyle: {
				opacity: 0
			}, visibleStyle: {
				opacity: 1
			}
		});
		// set selected class on button
		if (hashFilter) {
			$filters.parent('li').removeClass('active');
			$filters.parent('li').find('[data-filter="' + hashFilter + '"]').parent('li').addClass('active');
		}
	}

	$(window).on('hashchange', onHashchange);
	// trigger event handler to init Isotope
	onHashchange();

	// reveal all items after init
	var $items = $grid.find('.grid-item');
	$grid.addClass('animate').isotope('revealItemElements', $items);

	/**
	 * Wrap rate with spans
	 * @param rate
	 * @returns {*}
	 */
	function rateWrapper(rate) {
		var formattedRate;
		var rateToNumber = parseFloat(rate).toFixed(2);

		if ((rate) && !isNaN(rateToNumber)) {
			formattedRate = '<span class="rate-whole"><span class="rate-decimal">' + rateToNumber + '<span class="rate-percent">%<span class="rate-pa">pa </span></span></span></span>';
		} else {
			formattedRate = '<span class="rate-whole"><span class="rate-decimal">n/a</span></span>';
		}
		return formattedRate;
	}

	if ($(".rate-display").length) {
		$(".rate-display").each(function () {
			var getHtml = $(this).html();
            
			if (getHtml.substr(getHtml.length - 4) == "% pa") {
				$(this).html(rateWrapper(getHtml));
			}
		});
	}
});
