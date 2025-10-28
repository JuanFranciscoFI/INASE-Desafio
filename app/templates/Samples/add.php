<h1>Nueva muestra</h1>

<?= $this->Form->create($sample) ?>
  <?= $this->Form->control('seal_number', ['label' => 'Número de precinto']) ?>
  <?= $this->Form->control('company', ['label' => 'Empresa']) ?>
  <?= $this->Form->control('species', ['label' => 'Especie']) ?>
  <?= $this->Form->control('seed_quantity', ['label' => 'Cantidad de semillas', 'type' => 'number', 'min' => 0]) ?>

<div class="form-actions split">
  <?= $this->Html->link('Volver', ['action' => 'index'], [
    'class' => 'button outline btn-center'
  ]) ?>
  <?= $this->Form->button('Guardar', [
    'class' => 'button btn-brand btn-center'
  ]) ?>
</div>
<?= $this->Form->end() ?>
