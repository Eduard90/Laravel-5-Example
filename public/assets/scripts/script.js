$(document).ready(function() {
    $('input[name="phone"]').mask('+7 (000) 000 0000', {
        placeholder: '+7 (___) ___ ____'
    });

	$('.product-item, #do-description').hide();

	setTimeout(function(){
		$('.product-item, #do-description').each(function(idx, val) {
			$(val).delay(500*idx).fadeIn(400);
		});
	}, 500);

    $('#review-popup #product-review textarea').on('input', function() {
        var review = $('#review-popup textarea[name="review"]').val();
        var q = review.split(/[\s\n,\.]+/gm);
        var words = q.length;

        var sum = words * 2;

        $('#product-review div').html('Вы получите за этот отзыв: <b>'+sum+'</b> руб.');
    });

	$('#products').on('click', '.product-item', function(e) {
		var $product = $(e.currentTarget);
		var id = $product.data('id');
		if (id) {
			$.getJSON('/get_product', {'id': id}, function(resp) {
                var title = resp.title;
				var link = resp.ym_url;
				var image = resp.image_url;
                $('#review-popup').data('id', id);
				$('#review-popup #product-review textarea').val('');
                $('#product-review div').text('Вы получите за этот отзыв: 0 руб.');
                $('#review-popup #product-info #product-image img').attr('src', image);
                $('#review-popup #product-info #product-title').html(title);
				$('#review-popup #product-info #product-link').html("Ссылка на Яндекс.Маркет - <a href='"+link+"' target='_blank'>Перейти</a>");
				$('#review-popup').modal();
			});
		}
	});


    $('#review-popup #post_review').on('click', function() {
        var id = $('#review-popup').data('id');
        var review = $('#review-popup textarea[name="review"]').val();
        var q = review.split(/[\s\n,\.]+/gm);
        var words = q.length;

        if (words < 5) {
            alert('Введите не менее 5ти слов.');
        } else {
            $.post('/post_review', {'product_id': id, 'review': review}, function(resp) {
                if (resp.ok) {
                    location.reload();
                } else {
                    alert(resp.errors);
                }
            }, "json");
        }
    });
});