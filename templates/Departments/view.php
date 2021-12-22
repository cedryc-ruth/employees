<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->dept_no], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->dept_no], ['confirm' => __('Are you sure you want to delete # {0}?', $department->dept_no), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Departments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Department'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="departments view content">
            <h3><?= h($department->dept_no) ?></h3>

            <div class="card" style="width: 18rem;">
                <?= $this->Html->image("department/".$department->picture,[
                        "alt"=> h($department->dept_name),
                        "width"=>300,
                        "class"=>"card-img-top"
                ]) ?>
                <div class="card-body">
                    <h5 class="card-title"><?= h($department->dept_name) ?></h5>
                </div>
            </div>
            <table>
                <tr>
                    <th><?= __('Dept No') ?></th>
                    <td><?= h($department->dept_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dept Name') ?></th>
                    <td><?= h($department->dept_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Employee\'s list') ?></th>
                    <td><p><?= ($department->nbEmployees ?? '0'). __(' employees') ?></p>
                    <?php
                    $liste = '';

                    for($i=0;$i<10;$i++): 
                        $employee = $department->employees[$i];
                        $liste .= "$employee->first_name $employee->last_name, ";
                    endfor;

                    $liste = substr($liste,0,-1);
                    $liste .= "...";    ?>
                        <p><?= $liste ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
