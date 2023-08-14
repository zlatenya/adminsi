
<a href="/adminsi/account/edit/0" class="btn btn-gradient-primary btn-fw mb-3 mt-3">Создать пользователя</a>

<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><?=$title?></h4>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> Логин </th>
                <th> Полное имя </th>
                <th> </th>
                <th> </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?foreach($accounts as $key=>$account){?>
                <td>
                  <?=$account['login']?>
                </td>
                <td> <?=$account['full_name']?> </td>
                <td><a href="http://diplom/adminsi/account/edit/<?=$account['id']?>"> Редактировать</a> </td>
                <td><a href="http://diplom/adminsi/account/?delete=<?=$account['id']?> " class="btn btn-inverse-danger me-2" onclick="return confirm('Удалить?')" style="padding: 0.875rem 0.875rem;"><i class="mdi mdi mdi-delete"></i></a></td>
              </tr>
              <?}?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
