<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Termos</legend>

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

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="name">Termo</label>
  <div class="controls">
    <input id="name" name="name" placeholder="" class=" form-control" type="text">
    
  </div>
</div>


<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="url">Url</label>
  <div class="controls">
    <input id="url" name="url" placeholder="" class=" form-control" type="text">
    
  </div>
</div>

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

<!-- Select Basic -->
<div class="control-group">
    <label class="control-label" for="parent_id">pai</label>
    <div class="controls">
        <div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="parent_id">
            <button class="btn btn-default dropdown-toggle " data-toggle="dropdown" type="button">
                <span class="selected-label">pai</span>
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li data-value="Option one"><a href="#">Option one</a></li>
                <li data-value="Option two"><a href="#">Option two</a></li>
            </ul>
            <input class="hidden hidden-field" name="parent_id" readonly="readonly" aria-hidden="true" type="text">
        </div>
    </div>
</div>

</fieldset>
</form>
