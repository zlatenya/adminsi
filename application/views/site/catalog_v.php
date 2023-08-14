<section id="katalog">
    <div class="container">
      <div class="mb30">
      <p><?= $this->session->flashdata('message')?><p>
      </div>
      <div class="row g-5">
        <?foreach($products as $key=>$product){
            foreach($product as $key=>$prod){?>
              <div class="col-sm col-md-6 col-lg-4 ta_c">
                <div class="card">
                  <img src="/upload/<?=$prod['img_product']?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <a href="<?=$prod['page_url']?>"><h5 class="card-title mt10"><?=(isset($prod['name_product']) ? $prod['name_product'] : '')?></h5></a>
                    <?$cat_v="";
                    foreach($categories as $key=>$cat){
                      if($cat['id'] == $prod['category_product']){
                        $cat_v=$cat['name_category'];
                      }
                    }?>
                    <p class="card-text mt10"><?=(isset($cat_v) ? $cat_v : '')?></p>
                    <p class="card-text mt10"><?=(isset($prod['price']) ? $prod['price'] : '')?> руб</p>
                    <?=form_open('cart/add_to_cart'); ?>
                    <input type="hidden" name="product_id" value="<?=$prod['id']; ?>"/>
                    <input type="submit" name="add-to-cart" class="btn btn-dark mt10" value="Купить"/>
                    <?=form_close(); ?>
                  </div>
                </div>
              </div>
            <?}?>
        <?}?>
      </div>
    </div>
  </section>
