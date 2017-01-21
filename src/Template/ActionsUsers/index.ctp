<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Actions User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="actionsUsers index large-9 medium-8 columns content">
    <h3><?= __('Actions Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('action_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actionsUsers as $actionsUser): ?>
            <tr>
                <td><?= $this->Number->format($actionsUser->id) ?></td>
                <td><?= $actionsUser->has('action') ? $this->Html->link($actionsUser->action->name, ['controller' => 'Actions', 'action' => 'view', $actionsUser->action->id]) : '' ?></td>
                <td><?= $actionsUser->has('user') ? $this->Html->link($actionsUser->user->id, ['controller' => 'Users', 'action' => 'view', $actionsUser->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $actionsUser->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $actionsUser->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $actionsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $actionsUser->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
