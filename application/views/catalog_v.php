<a href="/adminsi/catalog/edit/0" class="btn btn-gradient-primary btn-fw mb-3 mt-3">Добавить товар</a>

<a class="btn btn-primary btn-fw mb-3 mt-3" onclick="openForm()">Добавить категорию</a>

<div class="form-popup-category mt-2" id="category_catalog">
  <form method="post" class="forms-sample" enctype="multipart/form-data" >
    <div class="form-group">
      <label for="name_category">Название категории:</label>
      <input type="text" class="form-control" id="name_category" name="name_category" onchange="checkParams()" >
    </div>
    <input type="submit" name="category" id="category" class="btn btn-gradient-primary me-2 mt-1" value="Сохранить" disabled>
    <button type="button" class="btn btn-inverse-danger me-2 mt-1" onclick="closeForm()">Закрыть</button>
  </form>
</div><br>
<?foreach($category as $key=>$cat){?>
<a href="" class="btn btn-outline-primary btn-fw mb-3 mt-3"><?=$cat['name_category']?></a> <a href="http://diplom/adminsi/catalog/?del_cat=<?=$cat['id']?> " class="btn btn-inverse-danger me-2" onclick="return confirm('Удалить?')" style="padding: 0.875rem 0.875rem;"><i class="mdi mdi mdi-delete"></i></a>
<?}?>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?=$title?></h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th> Фото товара </th>
            <th> Название </th>
            <th> Категория </th>
            <th></th>
            <th> </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?foreach($products as $key=>$product){?>
            <td class="py-1">
              <?if(!empty($product['img_product'])){?>
              <img src="/upload/<?=$product['img_product']?>" alt="image" />
              <?}else{?>
                <img src="/upload/noimage.jpg" alt="image" />
            <?  }?>
            </td>
            <td> <?=$product['name_product']?> </td>
            <?foreach($category as $key=>$cat){
              if($cat['id'] == $product['category_product']){?>
            <td> <?=$cat['name_category']?> </td>
            <?}?>
            <?}?>
            <td><a href="http://diplom/adminsi/catalog/edit/<?=$product['id']?>"> Редактировать</a> </td>
            <td><a href="http://diplom/adminsi/catalog/?delete=<?=$product['id']?> " class="btn btn-inverse-danger me-2" onclick="return confirm('Удалить?')" style="padding: 0.875rem 0.875rem;"><i class="mdi mdi mdi-delete"></i></a></td>
          </tr>
          <?}?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
function openForm() {
    document.getElementById("category_catalog").style.display = "block"; }
function closeForm() {
        document.getElementById("category_catalog").style.display = "none";
    }
function checkParams() {
    var value = document.querySelector('#name_category').value;
    console.log(value);
    if (value.length != 0) {
      document.querySelector('#category').disabled = false;
    } else {
      document.querySelector('#category').disabled = true;
  }
}

  </script>
