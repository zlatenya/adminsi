
    <a href="/adminsi/page/edit/0" class="btn btn-gradient-primary btn-fw mb-3">Создать страницу</a>


    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?=$title?></h4>
            <ul class="styled">
                  <?foreach($page as $key=>$p){
                    if(empty($p['parent_id'])){?>
                  <li>
                    <big><?=$p['title']?></big>
                    <p><a href="http://diplom/adminsi/page/edit/?parent_id=<?=$p['id']?>&id=0"> Добавить подраздел</a> |
                    <a href="http://diplom/adminsi/page/edit/<?=$p['id']?>"> Редактировать</a> |
                    <a href="http://diplom/adminsi/page/?delete=<?=$p['id']?> " onclick="return confirm('Удалить?')">Удалить </a>
                  </li><hr />
                  <?}?>
                  <ul class="styled_1">
                  <?foreach($page as $key=>$pg){//перебор страниц для поиска родителя
                    if($p['parent_id']==$pg['id']){?>
                      <li>
                      <?=$pg['title']?>
                        <p><!--a href="http://diplom/adminsi/page/edit/?parent_id=<?=$pg['id']?>&id=0"> Добавить подраздел</a-->
                        <a href="http://diplom/adminsi/page/edit/?parent_id=<?=$pg['parent_id']?>&id=<?=$pg['id']?>"> Редактировать</a> |
                      <a href="http://diplom/adminsi/page/?delete=<?=$pg['id']?> " onclick="return confirm('Удалить?')">Удалить </a></p>
                      </li><hr />
                    <?}?>
                  <?}?>
                </ul>
                  <?}?>
              </ul>
            </div>
          </div>
        </div>
      </div>
