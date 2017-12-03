
<style>

  /*
   * Widget
   */
  .uploader
  {
    border: 4px solid #ccc;
    color: #000;
    text-align: center;
    vertical-align: middle;
    padding: 40px 0px;
    margin-bottom: 10px;
    font-size: 24px;
    cursor: default;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .uploader-active {
    border-color: #0B85A1;
  }

  .uploader div.or {
    font-size:18px;
    font-weight: bold;
    padding: 10px;
  }

  .uploader div.browser label {
    background-color: #5a7bc2;
    padding: 5px 15px;
    color: white;
    padding: 6px 0px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 2px;
    position: relative;
    overflow: hidden;
    display: block;
    width: 300px;
    margin: 20px auto 0px auto;

    box-shadow: 2px 2px 2px #888888;
  }

  .uploader div.browser span {
    cursor: pointer;
  }

  .uploader div.browser input {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    border: solid transparent;
    border-width: 0 0 100px 200px;
    opacity: .0;
    filter: alpha(opacity= 0);
    -o-transform: translate(250px,-50px) scale(1);
    -moz-transform: translate(-300px,0) scale(4);
    direction: ltr;
    cursor: pointer;
  }

  .uploader div.browser label:hover {
    background-color: #427fed;
  }

  /*
   * File list
   */
  #fileList {
    height: 300px;
    margin: 0px;
    padding: 0px;
    list-style-type: none;
    color: gray;

    font-size: 12px;

    overflow: auto;
  }

  #fileList .file {
    margin-bottom: 15px;
  }

  #fileList .info {
    height: 26px;
    display: block;
    overflow: hidden;

    line-height: 13px;
  }

  #fileList .filename {
    font-weight: bold;
  }

  #fileList .bar {
    border: solid 1px #C0C0C0;
    height: 12px;
    margin-top: 5px;
    padding: 1px;
  }

  #fileList .progress {
    height: 20px;
    background-color: #00CCFF;
  }

  #fileList span.success {
    color: #009900;
  }

  #fileList span.error {
    color: #990000;
  }
</style>
<h1>Adicionar fotos</h1>
<div class="row">
  <div class="col-md-6">
    <div class="left-column">
      <p id="lista"></p>
      <!-- D&D Markup -->
      <div id="imagens" class="uploader">
        <div>Arraste e solte imagens aqui</div>
        <div class="or">ou</div>
        <div class="browser">
          <label>
            <span>Clique para abrir o browser do navegador</span>
            <input type="file" name="imagens[]" multiple="multiple" title='Clique para adicionar imagens'>
          </label>
        </div>
      </div>
      <!-- /D&D Markup -->
    </div>
  </div>
  <div class="col-md-6">
    <div id="fileList">
      <!-- Files will be places here -->
    </div>
  </div>
</div>
<hr>
<div class="row">
  <form method="post" action="<?= base_url() ?>Teste/form_uploads" id="form">
    
    <button type="submit" class="btn btn-danger">Enviar</button>
  </form>
</div>

<script type="text/javascript">
  // Upload Plugin itself
  $('#imagens').dmUploader({
    url: '<?= base_url() ?>teste/receberFoto',
    dataType: 'html',
    allowedTypes: 'image/*',
    fileName: 'imagem',
    /*extFilter: 'jpg;png;gif',*/
    onInit: function () {
      add_log('Uploader inicializado :)');
    },
    onBeforeUpload: function (id) {
      add_log('Starting the upload of #' + id);

      update_file_status(id, 'uploading', 'Uploading...');
    },
    onNewFile: function (id, file) {
      add_log('New file added to queue #' + id);

      add_file(id, file);
    },
    onComplete: function () {
      add_log('All pending tranfers finished');
    },
    onUploadProgress: function (id, percent) {
      var percentStr = percent + '%';

      update_file_progress(id, percentStr);
    },
    onUploadSuccess: function (id, data) {
      add_log('Upload of file #' + id + ' completed');

      add_log('Id do arquivo recem upado = ' + data);
      
      $('#form').append('<input type="hidden" name="imgs[]" value="'+ data +'">');

      update_file_status(id, 'success', 'Upload Completo');

      update_file_progress(id, '100%');
    },
    onUploadError: function (id, message) {
      add_log('Failed to Upload file #' + id + ': ' + message);

      update_file_status(id, 'error', message);
    },
    onFileTypeError: function (file) {
      add_log('File \'' + file.name + '\' cannot be added: must be an image');

    },
    onFileSizeError: function (file) {
      add_log('File \'' + file.name + '\' cannot be added: size excess limit');
    },
    /*onFileExtError: function(file){
     $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' has a Not Allowed Extension');
     },*/
    onFallbackMode: function (message) {
      alert('Browser not supported(do something else here!): ' + message);
    }
  });
  //-- Some functions to work with our UI
  function add_log(message)
  {
    var template = '<li>[' + new Date().getTime() + '] - ' + message + '</li>';

    $('#debug').find('ul').prepend(template);
  }

  function add_file(id, file)
  {
    var template = '' +
            '<div class="file" id="uploadFile' + id + '">' +
            '<div class="info">' +
            '#1 - <span class="filename" title="Size: ' + file.size + 'bytes - Mimetype: ' + file.type + '">' + file.name + '</span><br /><small>Status: <span class="status">Waiting</span></small>' +
            '</div>' +
            '<div class="bar">' +
            '<div class="progress" style="width:0%"></div>' +
            '</div>' +
            '</div>';

    $('#fileList').prepend(template);
  }

  function update_file_status(id, status, message)
  {
    $('#uploadFile' + id).find('span.status').html(message).addClass(status);
  }

  function update_file_progress(id, percent)
  {
    $('#uploadFile' + id).find('div.progress').width(percent);
  }
</script>