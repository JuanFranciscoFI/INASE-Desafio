<?php
declare(strict_types=1);

namespace App\Controller;

class ReportsController extends AppController
{
    public function index()
    {
        $q = $this->request->getQueryParams();
        $species = isset($q['species']) && $q['species'] !== '' ? $q['species'] : null;

        $Samples = $this->fetchTable('Samples');

        $query = $Samples->find()
            ->contain(['AnalysisResults'])
            ->order(['Samples.id' => 'DESC']);

        if ($species !== null) {
            $query->where(['Samples.species' => $species]);
        }

        $this->paginate = [
            'limit' => 10,
            'maxLimit' => 100,
            'sortableFields' => [
                'Samples.id',
                'Samples.company',
                'Samples.species',
            ],
        ];

        $rows = $this->paginate($query);

        $speciesOptions = $Samples->find()
            ->select(['species'])
            ->distinct(['species'])
            ->orderAsc('species')
            ->all()
            ->extract('species')
            ->combine(fn($v) => $v, fn($v) => $v)
            ->toArray();

        $filters = ['species' => $species];

        $this->set(compact('rows', 'speciesOptions', 'filters'));
    }

}
