<h3 class="page-title mb-4"><?=$element['title']?></h3>
    <form method="post" class="forms-sample" enctype="multipart/form-data">
      <div style="margin-top:20px; margin-bottom:20px;">
           <?=$this->session->flashdata('error_account');?>
        </div>
      <div class="form-group">
        <label for="login">Логин: </label>
        <input type="text" class="form-control" id="login" name="login"  value="<?=(isset($element['login']) ? $element['login'] : '')?>">
      </div>
      <div class="form-group">
        <label for="full_name">Полное имя: </label>
        <input type="text" class="form-control" id="full_name" name="full_name"  value="<?=(isset($element['full_name']) ? $element['full_name'] : '')?>">
      </div>
      <div class="form-group">
        <label for="password">Пароль: </label>
        <input type="text" class="form-control" id="password" name="password" value="<?=(isset($element['password']) ? $element['password'] : '')?>">
      </div>
      <button type="submit" name="account" class="btn btn-gradient-primary me-2 mt-3">Сохранить</button>

      </form>
