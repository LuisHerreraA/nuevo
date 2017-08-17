<!-- Modal -->
<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle Comentarios</h4>
      </div>
      <div class="modal-body">
        {{ Form::model(null,array('url'=>'api/administrator/user','method'=>'PUT','id'=>'FormEditUser','files'=>true)) }}
        <div class="form-group">
          <div class="form-group" hidden="true">
            <label for="id">id</label>
            <input type="text" class="form-control"name="id" id="id">
          </div>
          <div class="form-group window2" style="visibility: hidden">
            <label for="name">NOMBRE</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="nombre...">
          </div>
          <label for="type" id="preloader2" class="window" style="visibility: visible"></label>
          <div class="form-group window2" style="visibility: hidden">
            <label for="email">CORREO</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="email...">
          </div>
          <div class="form-group window2" style="visibility: hidden">
            <label for="role_id">ROL</label>
            <select id='role_id' name='role_id' class="form-control">
              <option value="1">ADMINISTRADOR</option>
              <option value="2">ADMINISTRATIVO</option>
            </select>
          </div>
          <br>
          <ul for="valid" class="label label-danger label-lng" name="valid" id="valid"></ul>
          <ul for="clave" class="label label-danger label-lng" name="clave" id="clave"></ul>
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
