<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><?=$title?></h4>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> Номер заказа </th>
                <th> Имя </th>
                <th> Телефон </th>
                <th> Почта </th>
                <th> Сумма </th>
                <th>  </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?foreach($zakaz as $key=>$item){?>
                <td>
                  <?=$item['id']?>
                </td>
                <td>
                <a href="http://diplom/adminsi/zakaz/<?=$item['id']?>"><?=$item['name']?></a>
                </td>
                <td>
                  <?=$item['tel']?>
                </td>
                <td>
                  <?=$item['email']?>
                </td>
                <td>
                  <?=$item['total_price']?>
                </td>
                <td><a href="http://diplom/adminsi/zakaz/?delete=<?=$item['id']?> " class="btn btn-inverse-danger me-2" onclick="return confirm('Удалить?')" style="padding: 0.875rem 0.875rem;"><i class="mdi mdi mdi-delete"></i></a></td>
              </tr>
              <?}?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
