/*
	Uni-validate - это надстройка над jquery-validate,
	добавляющая общий механизм валидации для любого кол-ва форм и полей,
	без привязки к именам полей

	1. добавляем форме класс js-validate

	2. добавляем обязательным полям атрибут required

	3. если требуется особое расположение ошибки - добавляем
	   <label class="error" for="ИМЯ_ПОЛЯ" style="display:none"></label>
	   (для сравнения, обычный label привязывается по for="ID_ПОЛЯ")

	4. по умолчанию есть правила валидации для email, телефона и даты.
	   своё правило можно добавить так:
	   pattern="регулярка" data-pattern-message="сообщение"
	   готовые регулярки можно найти на http://html5pattern.com/
*/

$(function() {
	"use strict";

	/* Русские сообщения */
	$.extend($.validator.messages,{
		required: "Это поле является обязательным",
		remote: "Введите правильное значение",
		email: "Введите адрес вида name@example.ru",
		url: "Введите корректный URL",
		date: "Введите корректную дату",
		dateISO: "Введите корректную дату в формате ISO",
		number: "Введите число",
		digits: "Введите целое положительное число",
		creditcard: "Введите правильный номер кредитной карты",
		equalTo: "Введите такое же значение ещё раз",
		accept: "Выберите файл с правильным расширением",
		maxlength: $.validator.format("Введите не более {0} символов"),
		minlength: $.validator.format("Введите не менее {0} символов"),
		rangelength: $.validator.format("Введите значение длиной от {0} до {1} символов"),
		range: $.validator.format("Введите число от {0} до {1}"),
		max: $.validator.format("Введите число, меньшее или равное {0}"),
		min: $.validator.format("Введите число, большее или равное {0}")
	});

  /* Доп. методы для валидации */
    // Дата
      $.validator.addMethod("ru_date", function(value, element) {
        return value.match(/^[0123]\d\.[01]\d\.\d{2}(\d{2})?$/) || !value;
      });
      $.extend($.validator.messages, {
        ru_date: "Введите дату вида 01.01.2000"
      });

      // Телефон
        $.validator.addMethod("tel", function(value, element) {
          return value.match(/^[0-9()\-\+\s]+$/) || !value;
        });
        $.extend($.validator.messages, {
          tel: "Допускаются цифры и символы + ( ) -"
        });

      // Селект
        $.validator.addMethod("select_required", function(value, element) {
          var firstOption = $(element).children('option').first();
          return value !== null && value != firstOption.text() && value != firstOption.attr("value");
        });
        $.extend($.validator.messages, {
          select_required: $.validator.messages.required
        });
        
   /* Валидация всего-всего */
	(function SphericalValidationInVacuum()	{

		// начало цикла по ФОРМАМ
		$('form.js-validate').each(function(index, element) {
			var $form = $(element);
			var rules = {};    // { имя_инпута: правила, имя_инпута: правила, ... }



    // начало цикла по ПОЛЯМ
			$form.find('input, textarea, select').each(function(index,element) {
				var $this = $(element);
				var name = $this.attr("name");
				var type = $this.attr("type");

				// игнорируем поля без имени:
          if (typeof(name) == "undefined" || !name) { console.warn("Не задан атрибут name", $this); return }

				rules[name] = {};

				// отдельно обрабатываем select и textarea
          if (typeof(type) == "undefined") {
            if ($this.is('select')) {
              if (typeof($this.attr("required")) !== "undefined") {
                // проверяем, что значение селекта не равно первой опции
                // (предполагается, что первая опция - это "выберите ...")
                rules[name].select_required = true;
              }
              return;
            }

            if ($this.is('textarea')) {
              // атрибут required валидируется автоматически для input и textarea
              return;
            }
            console.warn("Не задан атрибут type", $this);
            return;
          }

				// произвольное правило:
          if ($this.attr("pattern")) {
            var patternName = "pattern_" + name;
            var regexp = new RegExp($this.attr("pattern"));
            var message = {}; message[patternName] = $this.attr("data-pattern-message");
            $.validator.addMethod(patternName, function(value, element) {
              return value.match(regexp);
            });
            $.extend($.validator.messages, message);
            rules[name][patternName] = true;
            return;
          }

        // "должно сопадать с...":
          if ($this.attr("data-equal-to")) {
            rules[name].equalTo = $this.attr("data-equal-to");
          }

        // типовые правила:
          switch(type) {
            case "date":			{ rules[name].date = false; rules[name].ru_date = true; break; }
            case "email":			{ rules[name].email = true; break; }
            case "number":			{ console.warn("Поле [type=number] несовместимо с валидацией; заменено на [type=text]");
                          $this.attr("type", "text"); rules[name].digits = true; break; }
            case "tel":				{ rules[name].tel = true; break; }
          }

			}); // конец цикла по ПОЛЯМ


    //console.info("Правила валидации: ", rules);


    // инициализируем
			$form.validate({			    
				rules: rules,
				keyup: false,
				ignore: '', // do not ignore hidden elements

				// подавляет дефолтный сабмит формы
				submitHandler: function(form){
          
          var
            post = $form.serialize(),
            self = form,
            goal = $form.attr('data-goal');
          
          if (typeof(goal) != 'undefined' && goal != '') {
            yaCounter5227012.reachGoal(goal);
          }
          
          if ($(form).hasClass('_popup')){
				    
            $(form).parent().find('div').text('Ваша заявка принята! Спасибо Вам!');
            $(form).parent().find('form').remove();
            setTimeout(function() {
              $.ajax({
                url: $form.attr('data-action'), // you can use this
                type: 'POST',
                data: post,
                success: function(response) {                  
                  return false;
                }
              });
              self.submit();
              
            }, 1000);
            
            //console.log($(form).serialize());
            return false; //is superfluous, but I put it here as a fallback
            
          } else {
            self.submit();
          } 
				} 

				// вызывается, когда уводим фокус из верно заполненного поля
				// не вызывается на чекбоксе, если он ещё ни разу ни валидировался с ошибкой
          /*unhighlight: function(element) {
            $(element).removeClass(validator.settings.errorClass);
            setTimeout(function(){window.redrawProgress(element)},100);
          },*/

				/*invalidHandler: function(form, validator) {
					if (!validator.numberOfInvalids()) return;
					var OFFSET = 100;
					var firstErrorTop = $(validator.errorList[0].element).parents('.b-a__field').offset().top - OFFSET;
					$('html,body').animate({ scrollTop: firstErrorTop }, 1000);
				},*/
			});

		}); // конец цикла по ФОРМАМ

  })();
  
});