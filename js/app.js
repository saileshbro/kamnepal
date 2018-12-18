function toggleDropdown(){
    let element = document.querySelector('#register');
    document.querySelector('.dropdown').classList.toggle("show");
}
function toggleRegistration(){
    let element = document.querySelectorAll('#drop-nav');
    let element2 = document.querySelectorAll('.drop-active');
    for(let i =0;i<element.length;i++){
        element[i].classList.toggle('active');
    }
    for(let i =0;i<element2.length;i++){
        element2[i].classList.toggle('show');
    }
}

// function scrollPage(){
//     $(window).scrollTop ($(".landing-body").height());
// }
$(".scroll").click(function(e) {
	e.preventDefault();
	
	var position = $($(this).attr("href")).offset().top;

	$("body, html").animate({
		scrollTop: position
	} /* speed */ );
});