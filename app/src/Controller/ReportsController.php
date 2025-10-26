<?php
declare(strict_types=1);

namespace App\Controller;

class ReportsController extends AppController
{
    public function index()
    {
        $Samples = $this->fetchTable('Samples');

        $query = $Samples->find()
            ->contain(['AnalysisResults'])
            ->orderAsc('Samples.id');

        $species = $this->request->getQuery('species');
        if ($species) {
            $query->where(['Samples.species' => $species]);
        }

        $rows = $query->all();

        $speciesOptions = $Samples->find()
            ->select(['species'])
            ->distinct()
            ->orderAsc('species')
            ->all()
            ->combine('species', 'species')
            ->toArray();

        $this->set(compact('rows', 'speciesOptions'));
        $this->set('filters', ['species' => $species]);
    }
}
