<section class="promo">
  <h2 class="promo__title">Нужен стафф для катки?</h2>
  <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное
    снаряжение.</p>
  <ul class="promo__list">
    <!--заполните этот список из массива категорий-->
    <?php foreach ($product_categories as $modifer => $item): ?>
    <li class="promo__item promo__item--<?php echo $modifer; ?>">
      <a class="promo__link" href="pages/all-lots.html"><?php echo $item; ?></a>
    </li>
    <?php endforeach; ?>

  </ul>
</section>
<section class="lots">
  <div class="lots__header">
    <h2>Открытые лоты</h2>
  </div>
  <ul class="lots__list">
    <!--заполните этот список из массива с товарами-->
    <?php foreach ($product_items as $item): ?>
    <li class="lots__item lot">
      <div class="lot__image">
        <img src="<?php echo $item["photo"]; ?>" width="350" height="260" alt="<?php echo $item["title"]; ?>">
      </div>
      <div class="lot__info">
        <span class="lot__category"><?php echo $item["category"]; ?></span>
        <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?php echo $item["title"]; ?></a></h3>
        <div class="lot__state">
          <div class="lot__rate">
            <span class="lot__amount">Стартовая цена</span>
            <span class="lot__cost"><?php echo price_formatting($item["price"]); ?></span>

          </div>
          <div class="lot__timer timer">
            12:23
          </div>
        </div>
      </div>
    </li>
    <?php endforeach; ?>

  </ul>
</section>