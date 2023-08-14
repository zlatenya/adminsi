<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="/site_v/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/site_v/css/common.css">
  <link rel="stylesheet" type="text/css" href="/site_v/css/my_css.css">
  <link rel="stylesheet" type="text/css" href="/site_v/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/site_v/css/owl.carousel.css" />
  <link rel="stylesheet" type="text/css" href="/site_v/owl_carousel/dist/assets/owl.theme.default.css" />
  <script src="/site_v/js/jquery-3.6.3.min.js"></script>
  <script src="/site_v/bootstrap/js/bootstrap.min.js"></script>
  <script src="/site_v/js/owl.carousel.min.js"></script>
  <script src="/site_v/js/common.js"></script>

  <title>Document</title>
</head>
<body>
  <header id="header">
    <div class="container">
      <div class="row row_header align-items-center">
        <div class="col-sm col-lg-3  ta_c_mobile mar_bot">
          <img src="/site_v/css/images/logo.webp" style="height: 100px;">
        </div>
        <div class="col-sm col-lg-6 ta_c_mobile">
          <small class="small_text d_cell">Производство метизной продукции</small>
        </div>
        <div class="col-sm ta_r col-lg-3 ta_c_mobile mar_top">
  				<p class="sity "><i class="fa fa-map-marker mr10"></i>г. Екатеринбург</p>
  				<p class="tel"><i class="fa fa-phone mr10"></i><a href="tel:+7 9126056936" class="">+7 912 605 69 36</a></p>
  				<p class="email"><i class="fa fa-envelope mr10"></i><a href="mailto:euro-mk@ya.ru" onclick="ym(49220362,'reachGoal','click_on_email');" class="">euro-mk@ya.ru</a></p>
        </div>
      </div>
    </div>
  </header>

  <div class="menu_g">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="wrap_float_cart no_vis_mobile"><a href="/cart"><img src="/site_v/css/images/cart_img.svg"></a></div>

      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
          <?$arr_parent=array();
            foreach ($menu as $key=>$m){
              if(!empty($m['parent_id'])){
                foreach ($menu as $key=>$mn){
                  if($mn['id'] == $m['parent_id']){
                    $arr_parent[] = $mn;
                  }
                }
              }
            }
          foreach ($menu as $key=>$m){//если у страницы нет родителя и она не является никому родителем, но выводим так
            if(empty($m['parent_id']) AND !in_array($m,$arr_parent)){?>
                  <li class="nav-item">
                    <a class="nav-link mx-2 active" aria-current="page" href="<?=(!empty($m['url']) ? '/site/index/'.$m['url'].'/' : '/site/index/')?>"><?=$m['title']?></a>
                  </li>
                <?}else{
                  if(empty($m['parent_id'])){?>
                  <li class="nav-item dropdown">
                    <a class="nav-link mx-2 dropdown-toggle" href="/site/index/<?=$m['url']?>/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <?=$m['title']?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <?foreach ($menu as $key=>$men){
                          if($m['id']==$men['parent_id']){?>
                      <li><a class="dropdown-item" href="/site/index/<?=$m['url']?>/<?=$men['url']?>/"><?=$men['title']?></a></li>
                      <?}?>
                      <?}?>
                    </ul>
                  </li>
                <?}?>
              <?}?>
            <?}?>
        </ul>
      </div>
      <div class="wrap_float_cart no_vis_pc"><a href="/cart"><img src="/site_v/css/images/cart_img.svg"></a></div>
    </div>
    </nav>
  </div>
