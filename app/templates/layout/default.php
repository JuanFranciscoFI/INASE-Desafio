<?php
/**
 * @var \App\View\AppView $this
 */
$cakeDescription = 'INASE';
$controller = $this->getRequest()->getParam('controller');
$isSamples   = $controller === 'Samples';
$isReports   = $controller === 'Reports';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= h($cakeDescription) ?><?= $this->fetch('title') ? ' – ' . h($this->fetch('title')) : '' ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'inase']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
  <nav class="top-nav">
    <div class="top-nav-inner">
      <div class="brand">
        <a href="<?= $this->Url->build('/') ?>" style="color:inherit; text-decoration:none;">INASE</a>
        <span class="brand-badge">Lab</span>
      </div>
      <div class="spacer"></div>
      <div class="top-nav-links">
        <?= $this->Html->link(
              'Muestras',
              ['controller' => 'Samples', 'action' => 'index'],
              ['class' => $isSamples ? 'active' : '']
            ) ?>
        <?= $this->Html->link(
              'Reporte',
              ['controller' => 'Reports', 'action' => 'index'],
              ['class' => $isReports ? 'active' : '']
            ) ?>
      </div>
    </div>
  </nav>

  <main class="main">
    <div class="container">
      <?= $this->Flash->render() ?>
      <?= $this->fetch('content') ?>
    </div>
  </main>

  <footer class="site-footer">
    © <?= date('Y') ?> INASE — Instituto Nacional de Semillas
  </footer>
</body>
</html>
