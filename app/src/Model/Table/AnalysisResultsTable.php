<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AnalysisResultsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('analysis_results');
        $this->setPrimaryKey('sample_id');

        $this->belongsTo('Samples', [
            'foreignKey' => 'sample_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->decimal('germination_power')->requirePresence('germination_power', 'create')->notEmptyString('germination_power')
            ->decimal('purity')->requirePresence('purity', 'create')->notEmptyString('purity')
            ->allowEmptyString('inert_materials');

        return $validator;
    }
}
