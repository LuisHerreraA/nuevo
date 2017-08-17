<!-- Modal -->

  {{-- <div id="preloader2" class="window2" style="visibility: visible">  </div> --}}
<div class="modal fade"  id="modalEditCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog"  role="document">
    <div class="modal-content" >

      <div class="modal-header"  >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle Comentarios</h4>
      </div>
      <div class="modal-body"  >
        {{ Form::model(null,array('url'=>'api/category/','method'=>'PUT','id'=>'FormEditCategory','files'=>true)) }}
        <label for="type" id="preloader2" class="window" style="visibility: visible"></label>
        <input type="text" class="form-control" hidden="true" name="id" id="id">
        <div class="form-group window2"  style="visibility: hidden">
          <label for="type">TIPO</label>
          <input type="text" class="form-control" name='type' id="type" >
          <br>
          <ul for="valid" class="label label-danger label-lng" name="validCategory" id="validCategory"></ul>
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
