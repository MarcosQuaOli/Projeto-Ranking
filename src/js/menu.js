$(document).ready(() => {

	$('.bar-btn').click(() => {
		$('.navbar').slideToggle();
	})

	$(window).resize((e) => {
		if(window.innerWidth > 768) {
			$('.navbar').show();

		} else {
			$('.navbar').hide();
		}
	})
})