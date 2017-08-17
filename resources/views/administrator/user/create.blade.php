<!-- Modal -->
<div class="modal fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle Comentarios</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'api/category','method'=>'post','id'=>'FormUser','files'=>true)) }}
        <div class="form-group">
          <div>
            <label for="name">NOMBRE</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="nombre...">
          </div>
          <div>
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div>
            <label for="password2">confirme contraseña</label>
            <input type="password2" class="form-control" name="password2" id="password2">
          </div>
          <div>
            <label for="email">CORREO</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="email...">
          </div>
          <div>
            <label for="role_id">ROL</label>
            <select id='role_id' name='role_id' class="form-control">
              <<option value="1">ADMINISTRADOR</option>
              <option value="2">ADMINISTRATIVO</option>
            </select>
          </div>
          <br>
          <ul for="valid" class="label label-danger label-lng" name="valid" id="valid"></ul>
          <br>
          <ul for="clave" class="label label-danger label-lng" name="clave" id="clave"></ul>
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
