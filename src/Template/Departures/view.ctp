<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Departure'), ['action' => 'edit', $departure->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Departure'), ['action' => 'delete', $departure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departure->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departure'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departures view large-9 medium-8 columns content">
    <h3><?= h($departure->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $departure->has('action') ? $this->Html->link($departure->action->name, ['controller' => 'Actions', 'action' => 'view', $departure->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($departure->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($departure->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($departure->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($departure->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($departure->date) ?></td>
        </tr>
    </table>
</div>
