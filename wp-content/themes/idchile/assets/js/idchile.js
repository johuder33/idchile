jQuery(document).ready(function($){
	$('body').on('click', '.wcustom-add-to-cart', function(){
		var data = $(this).data();

		if(!$(this).data('adding')){
			changeStates(this);
			$.ajax({
				type: "POST",
				url: '?wc-ajax=add_to_cart',
				context: this,
				data: {product_id : data.id, product_sku: data.sku, quantity: data.qty},
				timeout: 15000,
				success: function(data){
					changeStates(this);
					$(this).data('adding', false);
					$('.currentTotalCart').html(data.fragments.currentTotal);
				},
				beforeSend: function(){
					$(this).data('adding', true);
				},
				error: function(data, ajax){
					changeStates(this);
					$(this).data('adding', false);
				}
			});
		}
	});

	$('.wrap-search').on('mouseleave', function(){
		var val = $.trim($('.search_input').val());
		if(val === '') {
			$(this).removeClass('opened');
			$('.search_input').blur();
		}else{
			$(this).addClass('opened');
		}
	});

	function changeStates(element){
		$(element).toggleClass('glyphicon glyphicon-shopping-cart');
		$(element).toggleClass('fa fa-circle-o-notch fa-spin');
	}

	var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    slidesPerView: 5,
    simulateTouch: false,
    paginationHide: true,
    nextButton: '.icon-next',
    prevButton: '.icon-prev',
    spaceBetween: 5,
    speed: 1000,
  });

  $('.permalink').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash.replace('!', ''));
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        //return false;
      }
    }
  });

  if(window.location.hash) {
  	var target = $(window.location.hash.replace('!', ''));
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 1000);
      //return false;
    }
  }

	// encapsulate the vars
	(function(){
		var elements = [];
		var limit = 2;
		$('#comparer').on('click', function(){
			if($('.selectable-compared.active').length == limit){
				//$(this).html('Comparando').attr('disabled', 'disabled');
				alert("FUNCION COMPARAR EJECUTADA");
			}else{
				$('.product-box').toggleClass('selectable-compared');
			}
		});

		$('body').on('click', '.selectable-compared', function(){
			if($('.selectable-compared.active').length < limit){
				elements = [];
				$(this).toggleClass('active');
				$('.selectable-compared.active').each(function(i, e){
					if(elements.length <= limit){
						var data = $(e).data();
						if(data.id) elements.push(data.id);
					}
				});
			}else{
				if($(this).hasClass('active')){
					$(this).toggleClass('active');
				}
			}

			console.log(elements);
		});

	})();
});