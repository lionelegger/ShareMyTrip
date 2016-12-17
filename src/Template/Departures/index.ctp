<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Departure'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departures index large-9 medium-8 columns content">
    <h3><?= __('Departures') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('longitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('latitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('action_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departures as $departure): ?>
            <tr>
                <td><?= $this->Number->format($departure->id) ?></td>
                <td><?= $this->Number->format($departure->longitude) ?></td>
                <td><?= $this->Number->format($departure->latitude) ?></td>
                <td><?= h($departure->date) ?></td>
                <td><?= $departure->has('action') ? $this->Html->link($departure->action->name, ['controller' => 'Actions', 'action' => 'view', $departure->action->id]) : '' ?></td>
                <td><?= h($departure->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $departure->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departure->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departure->id)]) ?>
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
