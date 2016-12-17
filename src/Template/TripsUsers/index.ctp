<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Trips User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Trips'), ['controller' => 'Trips', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trip'), ['controller' => 'Trips', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tripsUsers index large-9 medium-8 columns content">
    <h3><?= __('Trips Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('trip_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tripsUsers as $tripsUser): ?>
            <tr>
                <td><?= $tripsUser->has('trip') ? $this->Html->link($tripsUser->trip->name, ['controller' => 'Trips', 'action' => 'view', $tripsUser->trip->id]) : '' ?></td>
                <td><?= $tripsUser->has('user') ? $this->Html->link($tripsUser->user->id, ['controller' => 'Users', 'action' => 'view', $tripsUser->user->id]) : '' ?></td>
                <td><?= $this->Number->format($tripsUser->id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tripsUser->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tripsUser->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tripsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tripsUser->id)]) ?>
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
