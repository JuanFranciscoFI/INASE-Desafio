<?php
declare(strict_types=1);

namespace App\Controller;

class AnalysisResultsController extends AppController
{
    public function add(string $sampleId)
    {
        $Analysis = $this->fetchTable('AnalysisResults');
        $Samples  = $this->fetchTable('Samples');

        if ($Analysis->exists(['sample_id' => $sampleId])) {
            return $this->redirect(['action' => 'edit', $sampleId]);
        }

        $Samples->get($sampleId);

        $entity = $Analysis->newEmptyEntity();
        $entity->sample_id = $sampleId;

        if ($this->request->is('post')) {
            $entity = $Analysis->patchEntity($entity, $this->request->getData());
            $entity->sample_id = $sampleId;
            if ($Analysis->save($entity)) {
                $this->Flash->success('Análisis guardado.');
                return $this->redirect(['controller' => 'Samples', 'action' => 'view', $sampleId]);
            }
            $this->Flash->error('No se pudo guardar el análisis.');
        }

        $this->set(compact('entity', 'sampleId'));
        $this->render('edit');
    }

    public function view(string $sampleId)
    {
        $Table = $this->fetchTable('AnalysisResults');

        $analysis = $Table->find()->where(['sample_id' => $sampleId])->first();
        if (!$analysis) {
            $analysis = $Table->newEmptyEntity();
            $analysis->sample_id = $sampleId;
        }

        $this->set(compact('analysis'));
    }

    public function edit(string $sampleId)
    {
        $Table = $this->fetchTable('AnalysisResults');

        $analysis = $Table->find()->where(['sample_id' => $sampleId])->first()
            ?? $Table->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $analysis = $Table->patchEntity($analysis, $this->request->getData());
            $analysis->sample_id = $sampleId;

            if ($Table->save($analysis)) {
                $this->Flash->success('¡Los resultados fueron guardados correctamente!');
                return $this->redirect(['action' => 'view', $sampleId]);
            }

            $this->Flash->error('No se pudieron guardar los resultados.');
        }

        $this->set(compact('analysis'));
        return $this->render('view');
    }

}
