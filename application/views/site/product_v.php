<section id="product">
  <div class="container">
    <h3><?=(isset($product['name_product']) ? $product['name_product'] : '')?></h3>
    <?$cat_v="";
    foreach($categories as $key=>$cat){
      if($cat['id'] == $product['category_product']){
        $cat_v=$cat['name_category'];
      }
    }?>
    <p><?=(isset($cat_v) ? $cat_v : '')?></p>
    <img src="/upload/<?=$product['img_product']?>" class="card-img-top" alt="...">
    <div><?=(isset($product['full_text_product']) ? $product['full_text_product'] : '')?></div>
  </div>
</section>
