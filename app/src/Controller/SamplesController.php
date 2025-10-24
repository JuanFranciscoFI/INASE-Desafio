<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Text;

class SamplesController extends AppController
{

    public function index()
    {
        $samples = $this->fetchTable('Samples')
            ->find()
            ->orderDesc('id')
            ->all();

        $this->set(compact('samples'));
    }

    public function view(string $id)
    {
        $sample = $this->fetchTable('Samples')->get($id);

        $this->set(compact('sample'));
    }

    public function add()
    {   
        $Samples = $this->fetchTable('Samples');
        $sample = $Samples->newEmptyEntity();

        if ($this->request->is('post')) {
            $sample = $Samples->patchEntity($sample, $this->request->getData());

            $sample->id = Text::uuid();

            if ($Samples->save($sample)) {
                $this->Flash->success('Muestra creada.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('No se pudo crear la muestra.');
        }
        $this->set(compact('sample'));
    }

    public function edit(string $id)
    {
        $Samples = $this->fetchTable('Samples');
        $sample  = $Samples->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $sample = $Samples->patchEntity($sample, $this->request->getData());

            if ($Samples->save($sample)) {
                $this->Flash->success('¡La muestra fue actualizada correctamente!');
                return $this->redirect(['action' => 'view', $id]); // <- vuelve al detalle
            }

            $this->Flash->error('No se pudo actualizar la muestra. Intentalo nuevamente.');
        }

        $this->set(compact('sample'));
    }


    public function delete(string $id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sample = $this->fetchTable('Samples')->get($id);

        if ($this->fetchTable('Samples')->delete($sample)) {
            $this->Flash->success('La muestra fue eliminada.');
        } else {
            $this->Flash->error('No se pudo eliminar la muestra.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
