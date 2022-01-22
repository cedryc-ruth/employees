<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Car'), ['action' => 'edit', $car->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Car'), ['action' => 'delete', $car->id], ['confirm' => __('Are you sure you want to delete # {0}?', $car->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cars'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Car'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cars view content">
            <h3><?= h($car->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Registration Number') ?></th>
                    <td><?= h($car->registration_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Model') ?></th>
                    <td><?= h($car->model) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($car->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Car Emp') ?></h4>
                <?php if (!empty($car->car_emp)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Emp No') ?></th>
                            <th><?= __('Car Id') ?></th>
                            <th><?= __('Receipt Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($car->car_emp as $carEmp) : ?>
                        <tr>
                            <td><?= h($carEmp->id) ?></td>
                            <td><?= h($carEmp->emp_no) ?></td>
                            <td><?= h($carEmp->car_id) ?></td>
                            <td><?= h($carEmp->receipt_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CarEmp', 'action' => 'view', $carEmp->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CarEmp', 'action' => 'edit', $carEmp->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'CarEmp', 'action' => 'delete', $carEmp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carEmp->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
