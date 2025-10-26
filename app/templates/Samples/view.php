<?php
$qp = $this->request->getQueryParams();

$backTarget = ($this->request->getQuery('from') === 'report')
    ? [
        'controller' => 'Reports',
        'action'     => 'index',
        '?'          => array_intersect_key($qp, array_flip(['species'])) // reenviamos filtros conocidos
      ]
    : ['controller' => 'Samples', 'action' => 'index'];
?>

<h1>Detalle de muestra</h1>

<?= $this->Form->create($sample, [
    'url'    => ['action' => 'edit', $sample->id, '?' => $qp], // preserva query params al enviar
    'method' => 'patch',
    'id'     => 'sampleForm'
]) ?>

<?php
echo $this->Form->control('seal_number', [
    'label'    => 'Número de precinto',
    'disabled' => true,
]);
echo $this->Form->control('company', [
    'label'    => 'Empresa',
    'disabled' => true,
]);
echo $this->Form->control('species', [
    'label'    => 'Especie',
    'disabled' => true,
]);
echo $this->Form->control('seed_quantity', [
    'label'    => 'Cantidad de semillas',
    'disabled' => true,
]);
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-top:12px;">
  <div>
    <?= $this->Html->link('Volver', $backTarget, ['class' => 'button']) ?>
  </div>

  <div style="display:flex; gap:8px;">
    <button type="button" id="editBtn"   class="button button-primary">Editar</button>
    <button type="submit" id="saveBtn"   class="button" style="display:none;">Guardar cambios</button>
    <button type="button" id="cancelBtn" class="button" style="display:none;">Cancelar</button>
  </div>
</div>

<?= $this->Form->end() ?>

<?= $this->Html->scriptBlock(<<<JS
(function(){
  const form      = document.getElementById('sampleForm');
  const inputs    = Array.from(form.querySelectorAll('input, select, textarea'));
  const editBtn   = document.getElementById('editBtn');
  const saveBtn   = document.getElementById('saveBtn');
  const cancelBtn = document.getElementById('cancelBtn');

  function setDisabled(disabled){
    inputs.forEach(el => {
      if (el.type !== 'hidden' && el.name !== '_method') el.disabled = disabled;
    });
    editBtn.style.display   = disabled ? '' : 'none';
    saveBtn.style.display   = disabled ? 'none' : '';
    cancelBtn.style.display = disabled ? 'none' : '';
  }

  editBtn.addEventListener('click', () => setDisabled(false));
  cancelBtn.addEventListener('click', () => { form.reset(); setDisabled(true); });

  setDisabled(true);
})();
JS) ?>
