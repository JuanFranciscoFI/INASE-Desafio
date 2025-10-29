<h1>Resultados</h1>

<?= $this->Flash->render() ?>

<?= $this->Form->create($analysis, [
    'url'       => ['action' => 'edit', $analysis->sample_id ?? $sampleId],
    'method'    => 'patch',
    'id'        => 'analysisForm',
    'novalidate'=> true
]) ?>

<?php
echo $this->Form->control('germination_power', [
    'label'    => 'Poder germinativo (%)',
    'type'     => 'number',
    'step'     => '0.01',
    'min'      => '0',
    'max'      => '100',
    'disabled' => true,
    'empty'    => '—',
]);

echo $this->Form->control('purity', [
    'label'    => 'Pureza (%)',
    'type'     => 'number',
    'step'     => '0.01',
    'min'      => '0',
    'max'      => '100',
    'disabled' => true,
    'empty'    => '—',
]);

echo $this->Form->control('inert_materials', [
    'label'    => 'Materiales inertes',
    'type'     => 'textarea',
    'rows'     => 3,
    'disabled' => true,
    'empty'    => '—',
]);
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-top:12px;">
  <div>
    <?= $this->Html->link('Volver', ['controller' => 'Samples', 'action' => 'index'], [
      'class' => 'button outline btn-center'
    ]) ?>
  </div>

  <div style="display:flex; gap:8px;">
    <button type="button" id="editBtn"   class="button btn-brand btn-center">Editar</button>
    <button type="submit" id="saveBtn"   class="button btn-brand btn-center" style="display:none;">Guardar cambios</button>
    <button type="button" id="cancelBtn" class="button outline btn-center"   style="display:none;">Cancelar</button>
  </div>
</div>

<?= $this->Form->end() ?>

<?= $this->Html->scriptBlock(<<<'JS'
(function(){
  const form      = document.getElementById('analysisForm');
  const inputs    = Array.from(form.querySelectorAll('input, textarea, select'));
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
