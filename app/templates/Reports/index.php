<?php

$fmtPercent = fn($v) => $v === null ? '—' : rtrim(rtrim(number_format((float)$v, 2, ',', ''), '0'), ',') . ' %';
$fmtText    = fn($v) => trim((string)$v) === '' ? '—' : h($v);

$this->assign('title', 'Reporte de muestras');
?>
<style>
.card{background:#fff;border:1px solid #eaeaea;border-radius:10px;padding:16px}
.filters{display:flex;gap:12px;align-items:end;flex-wrap:wrap}
.filters .field{display:flex;flex-direction:column;gap:6px}
.filters label{font-size:13px;color:#6b7280}
.filters select{min-width:220px;padding:8px 10px;border:1px solid #dcdcdc;border-radius:8px}
.button.outline{background:#fff;color:#374151;border:1px solid #cfcfcf}
.button.outline:hover{background:#f7f7f7}
.table{width:100%;border-collapse:collapse;margin-top:18px}
.table th,.table td{padding:10px 12px;border-bottom:1px solid #efefef}
.table th{font-weight:600;color:#555;background:#fafafa}
.table td.center{text-align:center}
.empty{padding:24px;text-align:center;color:#6b7280}
</style>

<h1>Reporte de muestras</h1>

<div class="card" style="margin:14px 0 6px;">
  <?= $this->Form->create(null, ['type' => 'get', 'class' => 'filters']) ?>
    <div class="field">
      <label for="species">Especie</label>
      <?= $this->Form->select('species', $speciesOptions, [
        'id' => 'species',
        'empty' => '— Todas —',
        'value' => $filters['species'] ?? null,
      ]) ?>
    </div>

    <div style="margin-left:auto;display:flex;gap:8px">
      <?= $this->Form->button('Filtrar', ['class'=>'button']) ?>
      <?= $this->Html->link('Limpiar', ['controller'=>'Reports','action'=>'index'], ['class'=>'button outline']) ?>
    </div>
  <?= $this->Form->end() ?>
</div>

<?php if (!count($rows)): ?>
  <div class="card empty">No hay resultados para los filtros seleccionados.</div>
<?php else: ?>
  <table class="table">
    <thead>
      <tr>
        <th style="width:28%">Código de muestra</th>
        <th style="width:18%">Empresa</th>
        <th style="width:16%">Especie</th>
        <th class="center" style="width:14%">Poder germinativo</th>
        <th class="center" style="width:10%">Pureza</th>
        <th style="width:14%">Materiales inertes</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $q = $this->request->getQueryParams();
      foreach ($rows as $r):
        $ar = $r->analysis_result ?? null;
      ?>
        <tr>
          <td>
            <?= $this->Html->link(
              h($r->id),
              [
                'controller' => 'Samples',
                'action'     => 'view',
                $r->id,
                '?'          => ['from' => 'report'] + $q
              ]
            ) ?>
          </td>
          <td><?= $fmtText($r->company) ?></td>
          <td><?= $fmtText($r->species) ?></td>
          <td class="center"><?= $fmtPercent($ar?->germination_power) ?></td>
          <td class="center"><?= $fmtPercent($ar?->purity) ?></td>
          <td><?= $fmtText($ar?->inert_materials) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
