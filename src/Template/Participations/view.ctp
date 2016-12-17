<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Participation'), ['action' => 'edit', $participation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Participation'), ['action' => 'delete', $participation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $participation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Participations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Participation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="participations view large-9 medium-8 columns content">
    <h3><?= h($participation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $participation->has('user') ? $this->Html->link($participation->user->id, ['controller' => 'Users', 'action' => 'view', $participation->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $participation->has('action') ? $this->Html->link($participation->action->name, ['controller' => 'Actions', 'action' => 'view', $participation->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($participation->id) ?></td>
        </tr>
    </table>
</div>
