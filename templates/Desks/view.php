<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Desk $desk
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Desk'), ['action' => 'edit', $desk->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Desk'), ['action' => 'delete', $desk->id], ['confirm' => __('Are you sure you want to delete # {0}?', $desk->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Desks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Desk'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="desks view content">
            <h3><?= h($desk->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Numero') ?></th>
                    <td><?= h($desk->numero) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($desk->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($desk->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Employees') ?></h4>
                <?php if (!empty($desk->employees)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Emp No') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Gender') ?></th>
                            <th><?= __('Hire Date') ?></th>
                            <th><?= __('Xss') ?></th>
                            <th><?= __('Desk Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($desk->employees as $employees) : ?>
                        <tr>
                            <td><?= h($employees->emp_no) ?></td>
                            <td><?= h($employees->birth_date) ?></td>
                            <td><?= h($employees->first_name) ?></td>
                            <td><?= h($employees->last_name) ?></td>
                            <td><?= h($employees->email) ?></td>
                            <td><?= h($employees->password) ?></td>
                            <td><?= h($employees->gender) ?></td>
                            <td><?= h($employees->hire_date) ?></td>
                            <td><?= h($employees->xss) ?></td>
                            <td><?= h($employees->desk_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employees->emp_no]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employees->emp_no]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $employees->emp_no], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->emp_no)]) ?>
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
