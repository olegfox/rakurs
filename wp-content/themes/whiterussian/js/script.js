"use strict";

// для включения консоли задать localStorage.debug = "on"
//if (typeof(localStorage) != "undefined" && localStorage.debug != "on")
//{ console.log = console.info = console.warn = console.error = function(){}; }




$(function()
{
	var $window = $(window);
	var $body = $('body');


	/* независимые фрагменты кода - в раздельных самовызывающихся функциях. */




	(function OwlCarousel()
	{

		$('.owl-carousel.index-1').owlCarousel(
		{
			items: 1,
			center: true,
			loop: true,
			autoWidth: false,
			nav: true,
			autoplay: true
		});

		$('.owl-carousel.index-1')
			.find('.owl-stage-outer')
			.prepend('<div class="b-index__slider-top-left"/>')
			.append('<div class="b-index__slider-right-bottom"/>');


		$('.owl-carousel.index-2').owlCarousel(
		{
			items: 5,
			center: false,
			loop: true,
			autoWidth: false,
			nav: true,
			dots: false,
			stagePadding: 50 // размер стрелок
		});


		$('.owl-carousel.index-3').owlCarousel(
		{
			items: 1,
			center: true,
			loop: true,
			autoWidth: false,
			nav: false
		});


		$('.owl-carousel.b-photo__slider').owlCarousel(
		{
			items: 4,
			center: false,
			loop: true,
			autoWidth: false,
			margin: 20,
			nav: true,
			dots: false,
		});

	})();






	// 3d-кнопки
	(function RollingLinks()
	{

		var supports3DTransforms =  document.body.style['webkitPerspective'] !== undefined || 
									document.body.style['MozPerspective'] !== undefined;

		function linkify(selector)
		{
			if(Modernizr.csstransforms3d && Modernizr.csstransitions) {
				
				var nodes = document.querySelectorAll(selector);

				for(var i = 0, len = nodes.length; i < len; i++) {
					var node = nodes[i];

					if (node.className.match(/_no-roll/g)) continue;

					//try
					//{
						if(!node.className || !node.className.match(/roll/g))
						{
							var text = $(node).text();
							node.className += ' roll';
							$(node).html('<span>' + text + '<b>' + text + '</b>' + '</span>');
						}
					//}
					//catch(e) { console.log(e)}
				};
			}
			else {
				$('.b-button').not('._no-roll').addClass('roll').wrapInner('<span>');
			}
		}

		linkify('.b-button');

	})();






	// Календарь
	(function Datepicker()
	{
		if (typeof($.ui) == "undefined") { console.warn("Календарь требует jQueryUI"); return; }
		if (typeof($.datepicker) == "undefined") { console.warn("Отсутствует $.datepicker"); return; }

		var $datepicker = $('.js-datepicker');
		var $open = $('.js-datepicker-open');

		if ($datepicker.length)
		{
			$.datepicker.regional['ru'] =
			{
				closeText: 'Закрыть',
				prevText: '&#x3c;Пред',
				nextText: 'След&#x3e;',
				currentText: 'Сегодня',
				monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
				'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
				monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
				'Июл','Авг','Сен','Окт','Ноя','Дек'],
				dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
				dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
				dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
				dateFormat: 'dd.mm.yy',
				firstDay: 1,
				isRTL: false
			}; 

			$.datepicker.setDefaults($.datepicker.regional["ru"]);

			$datepicker.datepicker();

			$open.click(function(event)
			{
				event.preventDefault();
				$(this).siblings('.js-datepicker').datepicker("show");
			});
		}

		
	})();










	// Раскрывашка
	(function Expander()
	{
		$('[data-toggle]').click(function(event)
		{
			event.preventDefault();

			var	ANIM_DURATION = 300,
				$this = $(this),
				targetSelector = $this.attr("data-toggle"),
				$target = $(targetSelector);

			$this.toggleClass('_open');
			$target.toggle(0, ANIM_DURATION, function()
			{
				var $cat = $target.parent().find('.b-cat__subcat-contents');
				if ($cat.length)
				{
					$cat.masonry({ gutter: 16, transitionDuration: 0 });
				}
			});

		});
	})();












	// Меню
	(function HeaderMenuPopup()
	{
		var
			PADDING = 24 * 2,
			isSizeSet = false,
			$mainItems = $('.b-h__menu-list').children(),
			$3dItems = $('.b-h__link-group-list').children();

		$('.b-h__menu-button').click(function(event)
		{
			event.preventDefault();

			$('.b-h__menu-popup-wrapper, .b-h__nav').toggleClass('_open');

			if (!isSizeSet)
			{
				$mainItems.each(function(index, element)
				{
					$3dItems.eq(index).width($(element).width() - PADDING);
				});
			}
		});

	})();










	// Поле поиска в шапке
	(function HeaderSearch()
	{
		$('#header_search_toggle').click(function(event)
		{
			event.preventDefault();
			$('#header_search_toggle, #header_search_form').toggleClass('_open');
			$('#header_search_form').find('input[type=text]').focus();
		});

	})();









	// Анимация категорий (где плюс)
	if (Modernizr.csstransitions)
	{
		$('.b-index-cat__title, .b-pro-cat__title').each(function(index, element)
		{
			var $this = $(element);
			$this.height($this.height());
		});
	}
	else
	{
		$('.b-index-cat__title, .b-pro-cat__title').each(function(index, element)
		{
			var $this = $(element);
			$this.data("initialHeight", $this.height());
		});

		$('.b-index-cat__link, .b-pro-cat__link')
			.mouseenter(function(event)
			{
				var $title = $(this).find('.b-index-cat__title, .b-pro-cat__title');
				$title
					.stop(true, false)
					.animate({ height: "136px" }, 500);
			})
			.mouseleave(function(event)
			{
				var $title = $(this).find('.b-index-cat__title, .b-pro-cat__title');
				$title
					.stop(true, false)
					.animate({ height: $title.data("initialHeight") }, 500);
			})
	}




	// Прикрепление файла
	;(function()
	{
		$('input[type=file]').on("change", function()
		{
			$(this).parent().find('._fake').html("Прикреплён файл: " + $(this).val())
		});
	})();



	//возможность отмены выбора радиобаттонов
	(function DeselectableRadioButton()
	{
		$('[data-deselectable]')
			.on("click", function(event)
			{
				var $this = $(this);

				console.log('click')

				if ($this.data("clicked"))
				{
					console.log("deselect");
					$this.data("clicked", false);
					$this[0].checked = false;
					$this
						.attr('data-deselectable', false);
				}
				else
				{
					console.log("select");
					$this
						.parents('.b-cat__group-options-list')
						.find('input[type=radio]')
						.data("clicked", false)
						.attr('data-deselectable', false);

					$this
						.data("clicked", true)
						.attr('data-deselectable', true);
				}

			});

/*
		var radio = document.querySelectorAll('[data-deselectable]');
		var clicked = null;

		// отобразить радиоселекты для отладки
		//$('.b-cat__group-options-input').css({"opacity": 1, "z-index":1})


		for (var i = 0; i < radio.length; i++)
		{
			radio[i].onclick = function(e)
			{
				console.log(this.checked);


				if (this == clicked)
				{
					this.checked = false;	
					clicked = null;
					e.target.setAttribute("data-deselectable",'false');
				}
				else
				{
					clicked = this;
					$(this).parent().parent().parent().find(".b-cat__group-options-input").each(function(){
						$(this).attr('data-deselectable','false');
					});
					e.target.setAttribute("data-deselectable",'true');
				}
			};
		}*/


	})();







	// Плавная прокрутка
	;(function SmoothScrollTo()
	{
		var $htmlbody = $('html, body');

		$('a[href^=#]').on("click", function(event)
		{
			//if ($(this).attr("href")[0] != "#") return;

			event.preventDefault();
			$(this).blur();

			var hash = this.hash,
				top = (hash ? $(hash).offset().top : 0);

			$htmlbody.animate(
			{
				scrollTop: top
			}, 
			300,
			function()
			{
				window.location.hash = hash;
			});
		});

	})();






	(function GotoTopShowHide()
	{
		var $gototop = $('.b-goto-top'),
			isVisible = false;

		$window.on("scroll", function()
		{
			var isVisibleNew = ($window.scrollTop() > 0);

			if (isVisibleNew != isVisible)
			{
				isVisible = isVisibleNew;
				$gototop.stop().fadeToggle(isVisible);
			}
		});

	})();










});



