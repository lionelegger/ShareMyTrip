<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Action'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Trips'), ['controller' => 'Trips', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trip'), ['controller' => 'Trips', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Arrivals'), ['controller' => 'Arrivals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Arrival'), ['controller' => 'Arrivals', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departures'), ['controller' => 'Departures', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Departure'), ['controller' => 'Departures', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Participations'), ['controller' => 'Participations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participation'), ['controller' => 'Participations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="actions index large-9 medium-8 columns content">
    <h3><?= __('Actions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reservation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('trip_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actions as $action): ?>
            <tr>
                <td><?= $this->Number->format($action->id) ?></td>
                <td><?= h($action->name) ?></td>
                <td><?= h($action->company) ?></td>
                <td><?= h($action->reservation) ?></td>
                <td><?= $action->has('trip') ? $this->Html->link($action->trip->name, ['controller' => 'Trips', 'action' => 'view', $action->trip->id]) : '' ?></td>
                <td><?= $this->Number->format($action->price) ?></td>
                <td><?= h($action->currency) ?></td>
                <td><?= $action->has('type') ? $this->Html->link($action->type->name, ['controller' => 'Types', 'action' => 'view', $action->type->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $action->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $action->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $action->id], ['confirm' => __('Are you sure you want to delete # {0}?', $action->id)]) ?>
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
