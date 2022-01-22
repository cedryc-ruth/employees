<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car[]|\Cake\Collection\CollectionInterface $cars
 */
?>
<div class="cars index content">
    <h3><?= __('Echange de voitures') ?></h3>
    <div class="table-responsive">
        <?= $this->Form->create(null, [
            'url' => [
                'controller' => 'Cars',
                'action' => 'switchCars'
            ]
        ]) ?>
    <?php 
    $i = 0;
    foreach ($cars as $car): ?>
        <div style="border-bottom:1px dashed gray">
            <?= $this->Form->checkbox('carEmpId'.$i++,[
                'label' => false,
                'hiddenField' => false,
                'value' => $car->car_emp[0]->id ]) ?>
            <?= $car->employees[0]->first_name.' '.$car->employees[0]->last_name ?>
            (<?= h($car->model) ?>)
        </div>
    <?php endforeach; ?>
        <div style="text-align:center;margin:10px"><?= $this->Form->submit('Echanger') ?></div>
        <?= $this->Form->end() ?>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
