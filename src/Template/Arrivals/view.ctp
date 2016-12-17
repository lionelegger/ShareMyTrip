<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Arrival'), ['action' => 'edit', $arrival->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Arrival'), ['action' => 'delete', $arrival->id], ['confirm' => __('Are you sure you want to delete # {0}?', $arrival->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Arrivals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Arrival'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="arrivals view large-9 medium-8 columns content">
    <h3><?= h($arrival->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $arrival->has('action') ? $this->Html->link($arrival->action->name, ['controller' => 'Actions', 'action' => 'view', $arrival->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($arrival->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($arrival->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($arrival->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($arrival->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($arrival->date) ?></td>
        </tr>
    </table>
</div>
