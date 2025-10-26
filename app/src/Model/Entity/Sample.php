<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Sample extends Entity
{
    protected array $_accessible = [
        'seal_number'   => true,
        'company'       => true,
        'species'       => true,
        'seed_quantity' => true,
        'analysis_result' => true,


        'id' => false,
        '*'  => false,
    ];
}
