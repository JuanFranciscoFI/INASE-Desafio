<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class AnalysisResultsController extends AppController
{

    public function add(string $sampleId)
    {
        $Analysis = $this->fetchTable('AnalysisResults');
        $Samples  = $this->fetchTable('Samples');

        $sample = $Samples->find()->where(['id' => $sampleId])->first();
        if (!$sample) {
            throw new NotFoundException('Muestra no encontrada.');
        }

        if ($Analysis->exists(['sample_id' => $sampleId])) {
            return $this->redirect(['action' => 'edit', $sampleId]);
        }

        $entity = $Analysis->newEmptyEntity();
        $entity->sample_id = $sampleId;

        if ($this->request->is('post')) {
            $entity = $Analysis->patchEntity($entity, $this->request->getData());
            $entity->sample_id = $sampleId;

            if ($Analysis->save($entity)) {
                $this->Flash->success('Análisis guardado.');
                return $this->redirect(['action' => 'view', $sampleId]);
            }

            $this->Flash->error('No se pudo guardar el análisis.');
        }

        $this->set(compact('entity', 'sample', 'sampleId'));
        return $this->render('edit');
    }

    public function view(string $sampleId)
    {
        $Samples = $this->fetchTable('Samples');
        $Analysis = $this->fetchTable('AnalysisResults');

        $sample = $Samples->find()->where(['id' => $sampleId])->first();
        if (!$sample) {
            throw new NotFoundException('Muestra no encontrada.');
        }

        $analysis = $Analysis->find()->where(['sample_id' => $sampleId])->first();

        if (!$analysis) {
            $this->set(compact('sample'));
            return $this->render('empty');
        }

        $this->set(compact('analysis', 'sample'));
    }

    public function edit(string $sampleId)
    {
        $Samples  = $this->fetchTable('Samples');
        $Analysis = $this->fetchTable('AnalysisResults');

        $sample = $Samples->find()->where(['id' => $sampleId])->first();
        if (!$sample) {
            throw new NotFoundException('Muestra no encontrada.');
        }

        $analysis = $Analysis->find()->where(['sample_id' => $sampleId])->first()
            ?? $Analysis->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $analysis = $Analysis->patchEntity($analysis, $this->request->getData());
            $analysis->sample_id = $sampleId;

            if ($Analysis->save($analysis)) {
                $this->Flash->success('¡Los resultados fueron guardados correctamente!');
                return $this->redirect(['action' => 'edit', $sampleId]);
            }

            $this->Flash->error('No se pudieron guardar los resultados.');
        }

        $this->set(compact('analysis', 'sample', 'sampleId'));
        return $this->render('edit');
    }
}
