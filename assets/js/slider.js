var slides = document.querySelectorAll(".slider > .slider__item");

var currentSlide = 0;

var slideInterval = setInterval(nextSlide, 50000);

function nextSlide() {
  goToSlide(currentSlide+1);
}
function prevSlide(){
  goToSlide(currentSlide-1);
}
function goToSlide(n){
  slides[currentSlide].className = 'slider__item';
  currentSlide = (n+slides.length)%slides.length;
  slides[currentSlide].className = 'slider__item slider__item--current';
}
var prev = document.querySelector('.controls__btn--prev'),
    next = document.querySelector('.controls__btn--next');

next.onclick = function(){
  nextSlide();
}
prev.onclick = function(){
  prevSlide();
}