<h1>Análisis de muestra</h1>

<p><b>Muestra:</b> <?= h($sampleId) ?></p>

<?= $this->Form->create($entity) ?>
<?= $this->Form->control('germination_power', ['label' => 'Poder germinativo (%)', 'type' => 'number', 'step' => '0.01', 'min' => 0, 'max' => 100]) ?>
<?= $this->Form->control('purity', ['label' => 'Pureza (%)', 'type' => 'number', 'step' => '0.01', 'min' => 0, 'max' => 100]) ?>
<?= $this->Form->control('inert_materials', ['label' => 'Materiales inertes (opcional)', 'type' => 'textarea']) ?>
<?= $this->Form->button('Guardar análisis', ['class' => 'button outline btn-center']) ?>
<?= $this->Form->end() ?>

<p><?= $this->Html->link('Volver a la muestra', ['controller' => 'Samples', 'action' => 'view', $sampleId]) ?></p>
