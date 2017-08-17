<!-- Modal -->
<div class="modal fade" id="modalCreateCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle Comentarios</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'api/category','method'=>'post','id'=>'FormCategory','files'=>true)) }}
        <div class="form-group">
          <div>
            <label for="type">TIPO</label>
            <input type="text" class="form-control" name="type" id="type" placeholder="CREAR">
          </div>
          <br>
          <ul for="valid" class="label label-danger label-lng" name="validCategory" id="validCategory"></ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="Guardar">Crear</button>
      </div>
      {{ Form::close()}}
    </div>
  </div>
</div>
