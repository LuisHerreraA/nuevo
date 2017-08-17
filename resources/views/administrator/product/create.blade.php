<!-- Modal -->
<div class="modal fade" id="modalCreateProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle Producto</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'api/product','method'=>'post','id'=>'FormProduct','files'=>true)) }}
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control"name="name" id="edit" placeholder="Ingrese Nombre">
          </div>
          <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" class="form-control"name="description" id="description" placeholder="Ingrese Decripcion">
          </div>
          <div class="form-group">
            <label for="mark_id">Marca</label>
            <select name="mark_id" id="mark_id" class="form-control">
            </select>
          </div>
          <div class="form-group">
            <label for="category_id">Categoria</label>
            <select name="category_id" id="category_id" class="form-control">
            </select>
          </div>
          <br>
          <ul for="valid" class="label label-danger label-lng" name="valid" id="valid2"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="Guardar">Crear</button>
      </div>
      {{ Form::close()}}
    </div>
  </div>
</div>
