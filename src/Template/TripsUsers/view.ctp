<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Trips User'), ['action' => 'edit', $tripsUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Trips User'), ['action' => 'delete', $tripsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tripsUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Trips Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trips User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trips'), ['controller' => 'Trips', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trip'), ['controller' => 'Trips', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tripsUsers view large-9 medium-8 columns content">
    <h3><?= h($tripsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Trip') ?></th>
            <td><?= $tripsUser->has('trip') ? $this->Html->link($tripsUser->trip->name, ['controller' => 'Trips', 'action' => 'view', $tripsUser->trip->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $tripsUser->has('user') ? $this->Html->link($tripsUser->user->id, ['controller' => 'Users', 'action' => 'view', $tripsUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tripsUser->id) ?></td>
        </tr>
    </table>
</div>
