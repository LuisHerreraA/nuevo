<!-- Modal -->
<div class="modal fade" id="modalEditMark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle Comentarios</h4>
      </div>
      <div class="modal-body">
        {{ Form::model(null,array('url'=>'api/administrator/mark/','method'=>'PUT','id'=>'FormEditMark','files'=>true)) }}
        <label for="type" id="preloader2" class="loaderModalMark" style="visibility: visible"></label>
        <input type="text" class="form-control" hidden="true" name="id" id="id">
        <div class="form-group viewModalMark"  style="visibility: hidden">
          <label for="name">Marca</label>
          <input type="text" class="form-control" name='name' id="name">
          <br>
          <ul for="valid" class="label label-danger label-lng" name="validMark" id="validMark"></ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="update" >Editar</button>
      </div>
      {{ Form::close()}}
    </div>
  </div>
</div>
