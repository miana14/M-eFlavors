// function burger() {
//     let menuBurger = document.getElementById("list-items");
//     if (menuBurger.style.display === "block") {
//       menuBurger.style.display = "none";
//     } else {
//       menuBurger.style.display = "block";
//     }
//   }

// function user() {
//     let menuUser = document.getElementById("user-menu");
//     if (menuUser.style.display === "block") {
//       menuUser.style.display = "none";
//     } else {
//       menuUser.style.display = "block";
//     }
//   }

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
