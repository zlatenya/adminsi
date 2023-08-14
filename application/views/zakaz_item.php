<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?=$title?></h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th> ID товара</th>
            <th> Название товара </th>
            <th> Количество </th>
            <th> Стоимость </th>
            <th> </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?foreach($items as $key=>$product){?>
            <td class="py-1">
              <?=$product['id_product']?>
            </td>
            <td> <?=$product['name_product']?> </td>
              <td> <?=$product['qty_product']?> </td>
              <td> <?=$product['price_product']?> </td>
          </tr>
          <?}?>
        </tbody>
      </table>
    </div>
  </div>
</div>
