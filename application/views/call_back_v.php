
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?=$title?></h4>

      <table class="table table-striped">
        <thead>
          <tr>
            <th> Имя </th>
            <th> Телефон </th>
            <th style="width: 300px;"> Сообщение </th>
            <th> </th>
            <th> </th>
          </tr>
        </thead>
        <tbody>
            <?foreach($call_back as $key=>$cb){?>
            <tr >
            <td> <?=$cb['name']?> </td>
            <td> <?=$cb['tel']?> </td>
            <td><div class="tree_point" style="width: 400px;"> <?=$cb['infofield']?> </td>
            <td><a href="http://diplom/adminsi/call_back/<?=$cb['id']?>"> Посмотреть</a> </td>
            <td><a href="http://diplom/adminsi/call_back/?delete=<?=$cb['id']?> " class="btn btn-inverse-danger me-2" onclick="return confirm('Удалить?')" style="padding: 0.875rem 0.875rem;"><i class="mdi mdi mdi-delete"></i></a></td>
          </tr>
          <?}?>
        </tbody>
      </table>
    </div>
  </div>
</div>
