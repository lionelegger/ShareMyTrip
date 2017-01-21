<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Actions User'), ['action' => 'edit', $actionsUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Actions User'), ['action' => 'delete', $actionsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $actionsUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Actions Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Actions User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="actionsUsers view large-9 medium-8 columns content">
    <h3><?= h($actionsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $actionsUser->has('action') ? $this->Html->link($actionsUser->action->name, ['controller' => 'Actions', 'action' => 'view', $actionsUser->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $actionsUser->has('user') ? $this->Html->link($actionsUser->user->id, ['controller' => 'Users', 'action' => 'view', $actionsUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($actionsUser->id) ?></td>
        </tr>
    </table>
</div>
