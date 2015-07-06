<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Conteúdo</legend>


<!-- Select Basic -->
<div class="control-group">
    <label class="control-label" for="type_id">Tipo</label>
    <div class="controls">
        <div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="type_id">
            <button class="btn btn-default dropdown-toggle " data-toggle="dropdown" type="button">
                <span class="selected-label">Tipo</span>
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li data-value="Option one"><a href="#">Option one</a></li>
                <li data-value="Option two"><a href="#">Option two</a></li>
            </ul>
            <input class="hidden hidden-field" name="type_id" readonly="readonly" aria-hidden="true" type="text">
        </div>
    </div>
</div>


<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="datepub">Data</label>
  <div class="controls">
    <input id="datepub" name="datepub" placeholder="" class=" form-control" type="text">
    <p class="help-block">data da publicação</p>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="new"></label>
  <div class="controls">
    <button id="new" name="new" class="btn btn-primary">novo</button>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="activate"></label>
  <div class="controls">
    <button id="activate" name="activate" class="btn btn-primary">ativar</button>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="deactivate"></label>
  <div class="controls">
    <button id="deactivate" name="deactivate" class="btn btn-primary">desativar</button>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="save"></label>
  <div class="controls">
    <button id="save" name="save" class="btn btn-primary">salvar</button>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="delete"></label>
  <div class="controls">
    <button id="delete" name="delete" class="btn btn-primary">apagar</button>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
    <label class="control-label" for="status">status</label>
    <div class="controls">
        <div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="status">
            <button class="btn btn-default dropdown-toggle " data-toggle="dropdown" type="button">
                <span class="selected-label">status</span>
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li data-value="Option one"><a href="#">Option one</a></li>
                <li data-value="Option two"><a href="#">Option two</a></li>
            </ul>
            <input class="hidden hidden-field" name="status" readonly="readonly" aria-hidden="true" type="text">
        </div>
    </div>
</div>

<!-- Select Basic -->
<div class="control-group">
    <label class="control-label" for="photo_id">Foto</label>
    <div class="controls">
        <div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="photo_id">
            <button class="btn btn-default dropdown-toggle " data-toggle="dropdown" type="button">
                <span class="selected-label">Foto</span>
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li data-value="Option one"><a href="#">Option one</a></li>
                <li data-value="Option two"><a href="#">Option two</a></li>
            </ul>
            <input class="hidden hidden-field" name="photo_id" readonly="readonly" aria-hidden="true" type="text">
        </div>
    </div>
</div>

<!-- Select Basic -->
<div class="control-group">
    <label class="control-label" for="document_id">Documento</label>
    <div class="controls">
        <div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="document_id">
            <button class="btn btn-default dropdown-toggle " data-toggle="dropdown" type="button">
                <span class="selected-label">Documento</span>
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li data-value="Option one"><a href="#">Option one</a></li>
                <li data-value="Option two"><a href="#">Option two</a></li>
            </ul>
            <input class="hidden hidden-field" name="document_id" readonly="readonly" aria-hidden="true" type="text">
        </div>
    </div>
</div>

<!-- Select Basic -->
<div class="control-group">
    <label class="control-label" for="folder_id">Pasta</label>
    <div class="controls">
        <div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="folder_id">
            <button class="btn btn-default dropdown-toggle " data-toggle="dropdown" type="button">
                <span class="selected-label">Arquivo</span>
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li data-value="Option one"><a href="#">Option one</a></li>
                <li data-value="Option two"><a href="#">Option two</a></li>
            </ul>
            <input class="hidden hidden-field" name="folder_id" readonly="readonly" aria-hidden="true" type="text">
        </div>
    </div>
</div>

<!-- Select Basic -->
<div class="control-group">
    <label class="control-label" for="album_id">Galeria</label>
    <div class="controls">
        <div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="album_id">
            <button class="btn btn-default dropdown-toggle " data-toggle="dropdown" type="button">
                <span class="selected-label">Galeria</span>
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li data-value="Option one"><a href="#">Option one</a></li>
                <li data-value="Option two"><a href="#">Option two</a></li>
            </ul>
            <input class="hidden hidden-field" name="album_id" readonly="readonly" aria-hidden="true" type="text">
        </div>
    </div>
</div>

<!-- Prepended text-->
<div class="control-group">
    <label class="control-label" for="title">Título</label>
    <div class="controls">
        <div class="input-group">
            <span class="input-group-addon">pt</span>
            <input id="title" name="title" class=" form-control" placeholder="" type="text">
        </div>
        
    </div>
</div>

<!-- Prepended text-->
<div class="control-group">
    <label class="control-label" for="title_en">Title</label>
    <div class="controls">
        <div class="input-group">
            <span class="input-group-addon">en</span>
            <input id="title_en" name="title_en" class=" form-control" placeholder="" type="text">
        </div>
        
    </div>
</div>

<!-- Prepended text-->
<div class="control-group">
    <label class="control-label" for="description">Descrição</label>
    <div class="controls">
        <div class="input-group">
            <span class="input-group-addon">pt</span>
            <input id="description" name="description" class=" form-control" placeholder="" type="text">
        </div>
        
    </div>
</div>

<!-- Prepended text-->
<div class="control-group">
    <label class="control-label" for="description_en">Description</label>
    <div class="controls">
        <div class="input-group">
            <span class="input-group-addon">en</span>
            <input id="description_en" name="description_en" class=" form-control" placeholder="" type="text">
        </div>
        
    </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="body">Corpo</label>
  <div class="controls">
    <textarea class="form-control" id="body" name="body">default text</textarea>
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="body_en">Body</label>
  <div class="controls">
    <textarea class="form-control" id="body_en" name="body_en">default text</textarea>
  </div>
</div>

</fieldset>
</form>
