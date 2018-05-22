jQuery(document).ready( function($){
	//custom pktechie scripts
	
	var carousel = '.pktechie-carousel-thumb';
	
	pktechie_get_bs_thumbs(carousel);

	$(carousel).on('slid.bs.carousel', function(){
		pktechie_get_bs_thumbs(carousel);
	});
	
	function pktechie_get_bs_thumbs( carousel ){
		var nextThumb = $('.item.active').find('.next-image-preview').data('image');
		var prevThumb = $('.item.active').find('.prev-image-preview').data('image');
		$(carousel).find('.carousel-control.right').find('.thumbnail-container').css({ 'background-image' : 'url('+nextThumb+')' });
		$(carousel).find('.carousel-control.left').find('.thumbnail-container').css({ 'background-image' : 'url('+prevThumb+')' });
	}
	
});