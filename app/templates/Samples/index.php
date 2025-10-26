<!-- <h1>Muestras</h1> -->

<div style="display:flex; align-items:center; gap:12px;">
  <?= $this->Html->link('Nueva muestra', ['action' => 'add'], ['class' => 'button']) ?>
</div>

<table class="index">
  <thead>
    <tr>
      <th>Código/ID</th>
      <th style="text-align:center;">Precinto</th>
      <th style="text-align:center;">Empresa</th>
      <th style="text-align:center;">Especie</th>
      <th style="text-align:center;">Cantidad</th>
      <th style="width:120px; text-align:center;">Análisis</th>
      <th style="width:60px; text-align:center;">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($samples as $s): ?>
    <tr>
      <td><?= $this->Html->link(h($s->id), ['action' => 'view', $s->id]) ?></td>
      <td style="text-align:center;"><?= h($s->seal_number) ?></td>
      <td style="text-align:center;"><?= h($s->company) ?></td>
      <td style="text-align:center;"><?= h($s->species) ?></td>
      <td style="text-align:center;"><?= h($s->seed_quantity) ?></td>

      <td style="text-align:center;">
        <?= $this->Html->link('Ver', ['controller' => 'AnalysisResults', 'action' => 'view', $s->id]) ?>
      </td>

      <td style="text-align:center;">
        <?= $this->Form->postLink(
          '🗑️',
          ['action' => 'delete', $s->id],
          [
            'confirm' => '¿Eliminar esta muestra?',
            'escapeTitle' => false,
            'style' => 'background:transparent;border:none;font-size:18px;line-height:1;cursor:pointer;'
          ]
        ) ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
