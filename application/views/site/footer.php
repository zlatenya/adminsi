<section id="konsult">
  <div class="container">
    <div class=" ta_c">
      <h2 class="">Нужна консультация?</h2>
      <p class="bbig mb30">Ответим на ваши вопросы по телефонам:  <span class="big nobr">+7 953 825 17 66</span>   <small>и</small>   <span class="big nobr">+7 912 605 69 36</span></p>
      <h3>On-line заявка на изготовление</h3>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="d_table mb-3" style="margin-left: auto;margin-right: auto;">
        <div class="d_cell" style="margin-top:20px; margin-bottom:20px;">
             <?=$this->session->flashdata('error_callback');?>
          </div>
        </div>
        <div class="d_table mb-3" style="margin-left: auto;margin-right: auto;">
          <label for="name" class="d_cell col-form-label " style="width:160px;">Ваше имя:</label>
          <div class="d_cell">
            <input type="text" class="form-control " name="name" id="name">
          </div>
        </div>
        <div class="d_table mb-3" style="margin-left: auto;margin-right: auto;">
          <label for="email" class="d_cell col-form-label " style="width:160px;">Ваш e-mail:</label>
          <div class="d_cell">
            <input type="email" class="form-control" name="email" id="email">
          </div>
        </div>
        <div class=" d_table mb-3" style="margin-left: auto;margin-right: auto;">
          <label for="tel" class="d_cell col-form-label " style="width:160px;">Ваш телефон:</label>
          <div class="d_cell">
            <input type="tel" class="form-control" name="tel" id="tel">
          </div>
        </div>
        <div class="d_table mb-3" style="margin-left: auto;margin-right: auto;">
          <label for="infofield" class="d_cell col-form-label " style="width:160px;">Ваше сообщение:</label>
          <div class="d_cell">
            <textarea class="form-control" name="infofield" id="infofield" rows="3"></textarea>
          </div>
        </div>
        <div class=" ta_c">
          <button type="submit" name="call_back" class="btn btn-dark" >Отправить</button>
        </div>
      </form>

  </div>
</section>
<div id="footer">
  <div class="container">
      <div class="copyright">
        <div class="dib mr30">© 2023 EURO-MK.ru</div>
        <div class="notes dib mr30">
          <span class="note siteinfo">
          </span>
        </div>
      </div>
    <div class="clearfix"></div>
  </div>
</div>
<script src="/site_v/js/my_js.js"></script>
</body>
</html
