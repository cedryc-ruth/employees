<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Desk Entity
 *
 * @property int $id
 * @property string $numero
 * @property string $nom
 *
 * @property \App\Model\Entity\Employee[] $employees
 */
class Desk extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'numero' => true,
        'nom' => true,
        'employees' => true,
    ];
}
