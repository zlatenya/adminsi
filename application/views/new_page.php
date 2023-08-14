<h3 class="page-title mb-4"><?=$title?></h3>
    <form method="post" class="forms-sample" enctype="multipart/form-data">
      <div style="margin-top:20px; margin-bottom:20px;">
           <?=$this->session->flashdata('error_page');?>
        </div>
      <div class="form-group">
        <label for="page_title">Заголовок страницы :</label>
        <input type="text" class="form-control" id="page_title" name="page_title" placeholder="Заголовок" value="<?=(isset($page['title']) ? $page['title'] : '')?>">
      </div>
      <div class="form-group">
        <label for="page_type">Компонент страницы: </label><br>
        <div class="btn-group">
          <select id="type_page" name="type_page" class="form-control" style="padding: 1rem 1rem;">
            <?$type_p ="";
            if(isset($page['type'])){
                foreach($type_page as $key=>$type){
                    if($type['id'] == $page['type']){
                      $type_p=$type['type_page'];
                    }
                }
              }
              //echo($category_product);?>
            <option value="<?=(isset($page['type']) ? $page['type'] : '')?>"><?=(isset($page['type']) ? $type_p : '')?></option>
            <?if(isset($type_page)){
            foreach($type_page as $ke=>$type){?>
            <option value="<?=$type['id']?>"><?=$type['type_page']?></option>
            <?}?>
            <?}?>
          </select>
        </div>
        </div>
        <!--выводить если компонент страницы равен каталогу-->
        <div class="form-group wrap_category" id="wrap_category" style="<?=( (isset($page['type']) AND $type_p=='Каталог')?'display:block':'' )?>">
          <label for="category">Категория товаров: </label><br>
          <select name="category[]" multiple="multiple" name="category" id="category">
            <?$cat_p = explode(",", $page['category_product']);
            print_r($cat_p);
            if(isset($category_catalog)){
            foreach($category_catalog as $key=>$cat){
              if(isset($page['category_product']) AND in_array($cat['id'],$cat_p)){?>
                <option selected="selected" value="<?=$cat['id']?>"><?=$cat['name_category']?></option>
              <?}else{?>
            <option value="<?=$cat['id']?>"><?=$cat['name_category']?></option><?}?>
            <?}?>
            <?}?>
          </select>
        </div>
        <div class="form-group wrap_url_input" id="wrap_url_input" style="<?=( (isset($page['type']) AND $type_p=='Главная')?'display:none':'' )?>">
          <label for="page_url">Адрес страницы (url) :</label>
          <input type="text" class="form-control" name="page_url" placeholder="Адрес страницы" id="page_url" value="<?=(isset($page['url']) ? $page['url'] : '')?>">
        </div>

        <div class="form-group">
          <label for="full_text">Сожержимое страницы </label>
          <textarea id="editor" name="full_text"><?=(isset($page['full_text']) ? $page['full_text'] : '')?></textarea>
        </div>

        <button type="submit" name="page" class="btn btn-gradient-primary me-2 mt-3">Сохранить</button>

      </form>
      <script>

              document.getElementById('type_page').onchange = function() {
                var value = type_page.value;
                if(value==2){
                  document.getElementById('wrap_category').style.display = 'block';
                }else{
                  document.getElementById('wrap_category').style.display = 'none';
                }
                if(value==5){
                  document.getElementById('wrap_url_input').style.display = 'none';
                }else{
                  document.getElementById('wrap_url_input').style.display = 'block';
                }
            }

            CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                 // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                 toolbar: {
                     items: [
                         'exportPDF','exportWord', '|',
                         'findAndReplace', 'selectAll', '|',
                         'heading', '|',
                         'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                         'bulletedList', 'numberedList', 'todoList', '|',
                         'outdent', 'indent', '|',
                         'undo', 'redo',
                         '-',
                         'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                         'alignment', '|',
                         'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                         'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                         'textPartLanguage', '|',
                         'sourceEditing'
                     ],
                     shouldNotGroupWhenFull: true
                 },
                 // Changing the language of the interface requires loading the language file using the <script> tag.
                 // language: 'es',
                 list: {
                     properties: {
                         styles: true,
                         startIndex: true,
                         reversed: true
                     }
                 },
                 // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                 heading: {
                     options: [
                         { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                         { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                         { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                         { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                         { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                         { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                         { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                     ]
                 },
                 // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                 placeholder: 'Welcome to CKEditor 5!',
                 // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                 fontFamily: {
                     options: [
                         'default',
                         'Arial, Helvetica, sans-serif',
                         'Courier New, Courier, monospace',
                         'Georgia, serif',
                         'Lucida Sans Unicode, Lucida Grande, sans-serif',
                         'Tahoma, Geneva, sans-serif',
                         'Times New Roman, Times, serif',
                         'Trebuchet MS, Helvetica, sans-serif',
                         'Verdana, Geneva, sans-serif'
                     ],
                     supportAllValues: true
                 },
                 // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                 fontSize: {
                     options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                     supportAllValues: true
                 },
                 // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                 // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                 htmlSupport: {
                     allow: [
                         {
                             name: /.*/,
                             attributes: true,
                             classes: true,
                             styles: true
                         }
                     ]
                 },
                 // Be careful with enabling previews
                 // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                 htmlEmbed: {
                     showPreviews: true
                 },
                 // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                 link: {
                     decorators: {
                         addTargetToExternalLinks: true,
                         defaultProtocol: 'https://',
                         toggleDownloadable: {
                             mode: 'manual',
                             label: 'Downloadable',
                             attributes: {
                                 download: 'file'
                             }
                         }
                     }
                 },
                 // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                 mention: {
                     feeds: [
                         {
                             marker: '@',
                             feed: [
                                 '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                 '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                 '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                 '@sugar', '@sweet', '@topping', '@wafer'
                             ],
                             minimumCharacters: 1
                         }
                     ]
                 },
                 // The "super-build" contains more premium features that require additional configuration, disable them below.
                 // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                 removePlugins: [
                     // These two are commercial, but you can try them out without registering to a trial.
                     // 'ExportPdf',
                     // 'ExportWord',
                     'CKBox',
                     'CKFinder',
                     'EasyImage',
                     // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                     // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                     // Storing images as Base64 is usually a very bad idea.
                     // Replace it on production website with other solutions:
                     // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                     // 'Base64UploadAdapter',
                     'RealTimeCollaborativeComments',
                     'RealTimeCollaborativeTrackChanges',
                     'RealTimeCollaborativeRevisionHistory',
                     'PresenceList',
                     'Comments',
                     'TrackChanges',
                     'TrackChangesData',
                     'RevisionHistory',
                     'Pagination',
                     'WProofreader',
                     // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                     // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                     'MathType',
                     // The following features are part of the Productivity Pack and require additional license.
                     'SlashCommand',
                     'Template',
                     'DocumentOutline',
                     'FormatPainter',
                     'TableOfContents'
                 ]
             });
      </script>
