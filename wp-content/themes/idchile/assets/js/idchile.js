jQuery(document).ready(function($){
	// encapsulate the vars

	var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    slidesPerView: 3,
    centeredSlides: true,
    simulateTouch: false,
    paginationHide:false,
    pagination: '.swiper-pagination',
    paginationClickable: true,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    spaceBetween: 30,
    speed: 1000,
    loop: true
  });

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