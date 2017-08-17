<!-- Modal -->
<div class="modal fade" id="modalEditProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle Comentarios</h4>
      </div>
      <div class="modal-body">
        {{ Form::model(null,array('url'=>'api/administrator/product/','method'=>'PUT','id'=>'FormEditProduct','files'=>true)) }}
          <div class="form-group" hidden="true">
            <label for="id">id</label>
            <input type="text" class="form-control"name="id" id="id">
          </div>
          <div class="form-group viewEditProduct" style="visibility: hidden">
            <label for="name">Nombre</label>
            <input type="text" class="form-control"name="name" id="edit">
          </div>
            <label for="type" id="preloader2" class="loaderEditProduct" style="visibility: visible"></label>
          <div class="form-group viewEditProduct" style="visibility: hidden">
            <label for="description">Descripcion</label>
            <input type="text" class="form-control"name="description" id="description" >
          </div>
          <div class="form-group viewEditProduct" style="visibility: hidden">
            <label for="mark_id" >Marca</label>
            <select name="mark_id" id="mark_id" class="form-control">
            </select>
          </div>
          <div class="Form-group viewEditProduct" style="visibility: hidden">
            <label for="category_id">Categoria</label>
            <select name="category_id" id="category_id" class="form-control">
            </select>
            <br>
            <ul for="valid" class="label label-danger label-lng" name="valid" id="valid"></ul>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary update" id="update">Editar</button>
      </div>
      {{ Form::close()}}
    </div>
  </div>
</div>
