<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class AnalysisResult extends Entity
{
    protected array $_accessible = [
        'sample_id'         => true,

        'germination_power' => true,
        'purity'            => true,
        'inert_materials'   => true,

        'sample'            => true,

        'id' => false,
        '*'  => false,
    ];

    protected array $_hidden = [];
    protected array $_virtual = [];
}
