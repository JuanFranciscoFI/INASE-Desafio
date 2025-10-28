<?php
$this->assign('title', 'Resultados');
?>

<h1>Resultados</h1>

<div class="card" style="border:1px solid #eee;border-radius:10px;padding:16px;max-width:980px">
  <p style="margin:0 0 14px;color:#6b7280">
    No tenés análisis cargados aún para esta muestra.
  </p>

  <div style="display:flex;gap:8px">
    <?= $this->Html->link(
      'Cargar',
      ['action' => 'edit', $sample->id],
      ['class' => 'button outline btn-center']
    ) ?>
    <?= $this->Html->link(
      'Volver',
      ['controller' => 'Samples', 'action' => 'index'],
      ['class' => 'button outline btn-center']
    ) ?>
  </div>
</div>
