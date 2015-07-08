<div id="apagarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">confirmação</h3>
  </div>
  <div class="modal-body">
    <p>Tem certeza que quer apagar esse registro?</p>
  </div>
  <div class="modal-footer">
    <button id="#apagar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <a id="apagar" class="btn btn-danger" href="<?php echo $l->gen('apagar');?>/<?php echo $conteudo[$info['identificador']]; ?>">Apagar</a>
  </div>
</div>
