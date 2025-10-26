<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SamplesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('samples');
        $this->setPrimaryKey('id');

        $this->hasOne('AnalysisResults', [
            'foreignKey' => 'sample_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('id')->maxLength('id', 36)
            ->requirePresence('id', 'create')->notEmptyString('id');

        $validator->scalar('seal_number')->maxLength('seal_number', 50)
            ->requirePresence('seal_number', 'create')->notEmptyString('seal_number');

        $validator->scalar('company')->maxLength('company', 150)
            ->requirePresence('company', 'create')->notEmptyString('company');

        $validator->scalar('species')->maxLength('species', 100)
            ->requirePresence('species', 'create')->notEmptyString('species');

        $validator->integer('seed_quantity')
            ->greaterThanOrEqual('seed_quantity', 0)
            ->requirePresence('seed_quantity', 'create')->notEmptyString('seed_quantity');

        return $validator;
    }
}
