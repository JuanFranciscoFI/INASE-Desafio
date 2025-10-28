<?php
$emptyBadge = $this->Html->tag('span', 'Sin dato', ['class' => 'empty-pill']);

$fmtPercent = function ($v) use ($emptyBadge) {
    if ($v === null || $v === '') return $emptyBadge;
    $n = number_format((float)$v, 2, ',', '');
    $n = rtrim(rtrim($n, '0'), ',');
    return $n . ' %';
};

$fmtText = function ($v) use ($emptyBadge) {
    return trim((string)$v) === '' ? $emptyBadge : h($v);
};

$this->assign('title', 'Reporte de muestras');

echo $this->Html->css('report', ['block' => true]);

$q = $this->request->getQueryParams();
unset($q['page']);

$this->Paginator->options(['url' => ['?' => $q]]);
?>

<div class="report-page">

  <div class="card" style="margin:14px 0 6px;">
    <?= $this->Form->create(null, ['type' => 'get', 'class' => 'filters']) ?>
      <div class="field select-with-icon">
        <label for="species" class="sr-only">Filtrar por especie</label>
        <?= $this->Form->select('species', $speciesOptions, [
          'id'    => 'species',
          'empty' => 'Filtrar por especie…',
          'value' => $filters['species'] ?? null,
        ]) ?>
      </div>

      <div style="margin-left:auto;display:flex;gap:8px">
        <?= $this->Form->button('Filtrar', ['class' => 'button btn-center']) ?>
        <?= $this->Html->link(
              'Limpiar',
              ['controller' => 'Reports', 'action' => 'index'],
              ['class' => 'button outline btn-center']
        ) ?>
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
          <th style="width:14%">Poder germinativo</th>
          <th style="width:10%">Pureza</th>
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
                ['controller' => 'Samples', 'action' => 'view', $r->id, '?' => ['from' => 'report'] + $q]
              ) ?>
            </td>
            <td><?= $fmtText($r->company) ?></td>
            <td><?= $fmtText($r->species) ?></td>
            <td><?= $fmtPercent($ar?->germination_power) ?></td>
            <td><?= $fmtPercent($ar?->purity) ?></td>
            <td><?= $fmtText($ar?->inert_materials) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="paginator">
      <ul class="pagination">
        <?= $this->Paginator->first('« Primero') ?>
        <?= $this->Paginator->prev('‹ Anterior') ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('Siguiente ›') ?>
        <?= $this->Paginator->last('Último »') ?>
      </ul>
      <p class="counter">
        <?= $this->Paginator->counter('{{current}} de {{count}} (pág. {{page}} / {{pages}})') ?>
      </p>
    </div>
  <?php endif; ?>

</div>
