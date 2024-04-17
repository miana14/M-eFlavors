<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<article>
  <h2 id="sliderTitre">Slider</h2>
  <div class="slider-container">
    <ul class="slider">
      <li class="slider__item"><img src="assets/img/bolinho.jpg" alt="bolinho de bacalhau"></li>
      <li class="slider__item"><img src="assets/img/francesinha.jpg" alt="francesinha"></li>
      <li class="slider__item"><img src="assets/img/sardinhas.jpg" alt="sardinhas"></li>
    </ul>
    <div class="controls">
      <button class="controls__btn controls__btn--prev"></button>
      <button class="controls__btn controls__btn--next"></button>
    </div>
  </div>
</article>

<article class="video">
  <h2>Video Recette Francesinha</h2>
  <video controls="controls" id="videoFrancesinha">
    <source src="assets/video/francesinha.mp4" type="video/mp4">
  </video>
</article>

<?php include './vue/vueFooter.php'; ?>