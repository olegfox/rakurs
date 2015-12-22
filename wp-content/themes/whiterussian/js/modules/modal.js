"use strict";



$(function()
{

	var FADE_IN_TIME = 100,
		FADE_OUT_TIME = 500,
		$window = $(window),
		$document = $(document),
		$overlay = $('.md-overlay'),
		$modal = $('.md-modal'),
		$other = $('.md-other');



	// для открытия попапа нужно задать кнопке data-modal-close="#айди_попапа"
	$('[data-modal-open]').on("click", function(event)
	{
		event.preventDefault();
		window.showModal($(this).attr("data-modal-open"));
	});



	// для закрытия попапа нужно задать кнопке data-modal-hide либо data-modal-hide="#айди_попапа"
	$('[data-modal-hide]').on("click", function(event)
	{
		event.preventDefault();
		if ($(this).attr("data-modal-hide") != "") window.hideModal($(this).attr("data-modal-hide"));
		else window.hideModal();
	});



	window.showModal = function(selector)
	{

		var $selector = $(selector),
			h = null,
			top = null;

		window.hideModal();
		$overlay.stop().height($document.height()).show();
		$other.addClass('md-hide-other');
		h = $selector.outerHeight();
		top = $window.scrollTop() + Math.abs(($window.height() - h) / 2);
		if (top + h > $document.height()) top = $document.height() - h;
		$selector
			.css("top", top + "px")
			.fadeIn(FADE_IN_TIME, function(){ $selector.addClass('md-show'); });
	}



	window.hideModal = function(selector) // можно вызвать без параметра - тогда закроются все попапы
	{
		if (!$overlay.is(':visible')) return;
		$overlay.fadeOut(FADE_OUT_TIME);
		$other.removeClass('md-hide-other');
		if (typeof(selector) == "undefined") selector = '.md-modal';
		$(selector).removeClass('md-show');
		$(selector).fadeOut();
	}



	$modal.on("click", function(event) { event.stopPropagation(); });
	$overlay.on("click", function(event) { window.hideModal(); });
	$(document).keyup(function(e) { if (e.keyCode == 27) { window.hideModal(); } });



});