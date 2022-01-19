<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car[]|\Cake\Collection\CollectionInterface $cars
 */
?>
<div class="cars index content">
    <h3><?= __('Echange de voiture') ?></h3>
    <div class="table-responsive">
        <?= $this->Form->create() ?>
        
    <?php
     $i=0;
     foreach ($carEmps as $carEmp): ?>
        <div style="border-bottom:1px dashed gray;padding-top:5px;">
            <span><?= $this->Form->checkbox('carEmpIds'.$i++,[
                'value' => $carEmp->id,
                'hiddenField' => false,
            ]); ?></span>
            <span><?= h($carEmp->employee->first_name) ?> <?= h($carEmp->employee->last_name) ?></span>
            <span>(<?= h($carEmp->car->model) ?>)</span>
        </div>
    <?php endforeach; ?>
        
        <div style="margin-top:10px;text-align:center">
            <?= $this->Form->button(__('Echanger')) ?>
        </div>
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
