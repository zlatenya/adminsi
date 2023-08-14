<section id="cart">
  <div class="container">
    <div class="controls" style="text-align: right;">
        <a href="/cart/cart_empty/">Очистить корзину</a>
    </div>
    <div class="cart">
      <?if (empty($cart_items)) { ?>
          <p><?= $this->session->flashdata('create_zakaz')?><p>
          <p>В корзине нет товаров</p>
      <? } else { ?>
        <p><?= $this->session->flashdata('delete')?><p>
        <?=form_open('cart/create_zakaz/'); ?>
          <div class="row align-items-center">
              <?php foreach ($cart_items as $row_id => $item) {
                      foreach($items as $key=>$it){
                        if($item['id'] == $it['id']){?>
                <?//print_r($item)?>
                    <div class="col-sm mobile_ta_c but_mobail">
                      <img src="/upload/<?=$item['img_product']?>" class="cart-img" alt="...">
                    </div>
                    <div class="col-sm mobile_ta_c but_mobail">
                      <h5><?= $item['name_product']; ?></h5>
                    </div>
                    <div class="col-sm mobile_ta_c but_mobail">
                      <?= $item['price'];?> руб
                    </div>
                    <div class="col-sm mobile_ta_c">
                      <div class="input-number mob_ta_c but_mobail">
                        <div class="input-number_minus">-</div>
                         <input class="input-number_input" type="text" pattern="^[0-9]+$" value="<?= $it['qty']; ?>" name="<?=$key?>">
                         <div class="input-number_plus">+</div>
                      </div>
                    </div>
                    <!--div class="col-sm">
                      <?= $it['subtotal']; ?>
                    </div-->

                  <div class="col-sm mobile_ta_c but_mobail" style="text-align: right;">
                    <a href="/cart/delete_item/?row_id=<?=$key?>" class="btn btn-dark">Удалить</a>
                  </div>
                  <hr>
                  <?} ?>
              <?} ?>
              <?} ?>
            </div>
            <p class="mt10"><?= $this->session->flashdata('no_create_zakaz')?><p>
            <p class="mt10 mb10">Данные для заказа</p>
            <div class="d_table mb-3">
              <label for="name" class="d_cell col-form-label " style="width:160px;">Ваше имя:</label>
              <div class="d_cell">
                <input type="text" class="form-control " name="name_zakaz" id="name">
              </div>
            </div>
            <div class="d_table mb-3">
              <label for="email" class="d_cell col-form-label " style="width:160px;">Ваш e-mail:</label>
              <div class="d_cell">
                <input type="email" class="form-control" name="email_zakaz" id="email">
              </div>
            </div>
            <div class=" d_table mb-3">
              <label for="tel" class="d_cell col-form-label " style="width:160px;">Ваш телефон:</label>
              <div class="d_cell">
                <input type="tel" class="form-control" name="tel_zakaz" id="tel">
              </div>
            </div>
            <input type="submit" class="btn btn-dark mt30" name="zakaz" value="Оформить заказ"/>
            <?=form_close(); ?>
            <!--div class="mt30" style="float: right;"><h5>Итог: </5><?=$this->cart->total();?></div-->
      <?} ?>
  </div>
</div>
</section>
