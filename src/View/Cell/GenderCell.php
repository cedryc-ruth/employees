<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Gender cell
 */
class GenderCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $women = $this->fetchTable('Employees')->find()
            ->where(['gender'=>'F']);
        $totalWomen = $women->count();

        $men = $this->fetchTable('Employees')->find()
            ->where(['gender'=>'M']);
        $totalMen = $men->count();
        
        $totalEmployees = ($totalMen+$totalWomen);

        $pctMen = $totalMen/$totalEmployees;
        $pctWomen = $totalWomen/$totalEmployees;

        $this->set(compact('pctMen','pctWomen'));
    }
}
