let burgerMenu = document.getElementById('burger');
let overlay = document.getElementById('menu-burger');
burgerMenu.addEventListener('click',function(){
  this.classList.toggle("close");
  overlay.classList.toggle("overlay");
});

let burgerUser = document.getElementById('burger-user');
let overlayUser = document.getElementById('menu-user');
burgerUser.addEventListener('click',function(){
  this.classList.toggle("close");
  overlayUser.classList.toggle("overlay");
});
