<!-- Modal -->
<div class="modal fade" id="modalCreateMark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle Comentarios</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'api/mark','method'=>'post','id'=>'FormMark','files'=>true)) }}
        <div class="form-group">
          <div>
            <label for="name">marca</label>
            <input type="text" name="name" class="form-control" id="name">
          </div>
        </div>
        <br>
        <ul for="valid" class="label label-danger label-lng" name="validMark" id="validMark"></ul>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="GUARDAR">Crear</button>
      </div>
        {{ Form::close()}}
    </div>
  </div>
</div>
</div>
