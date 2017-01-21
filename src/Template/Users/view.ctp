<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trips'), ['controller' => 'Trips', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trip'), ['controller' => 'Trips', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Payments') ?></h4>
        <?php if (!empty($user->payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Method Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Currency') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->payments as $payments): ?>
            <tr>
                <td><?= h($payments->id) ?></td>
                <td><?= h($payments->user_id) ?></td>
                <td><?= h($payments->action_id) ?></td>
                <td><?= h($payments->method_id) ?></td>
                <td><?= h($payments->amount) ?></td>
                <td><?= h($payments->currency) ?></td>
                <td><?= h($payments->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'action' => 'edit', $payments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payments', 'action' => 'delete', $payments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Trips') ?></h4>
        <?php if (!empty($user->trips)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Owner Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->trips as $trips): ?>
            <tr>
                <td><?= h($trips->id) ?></td>
                <td><?= h($trips->name) ?></td>
                <td><?= h($trips->owner_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Trips', 'action' => 'view', $trips->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Trips', 'action' => 'edit', $trips->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Trips', 'action' => 'delete', $trips->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trips->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Actions') ?></h4>
        <?php if (!empty($user->actions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Trip Id') ?></th>
                <th scope="col"><?= __('Type Id') ?></th>
                <th scope="col"><?= __('Owner Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Company') ?></th>
                <th scope="col"><?= __('Reservation') ?></th>
                <th scope="col"><?= __('Identifier') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Currency') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Start Name') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('Start Lng') ?></th>
                <th scope="col"><?= __('Start Lat') ?></th>
                <th scope="col"><?= __('End Name') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('End Lng') ?></th>
                <th scope="col"><?= __('End Lat') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->actions as $actions): ?>
            <tr>
                <td><?= h($actions->id) ?></td>
                <td><?= h($actions->trip_id) ?></td>
                <td><?= h($actions->type_id) ?></td>
                <td><?= h($actions->owner_id) ?></td>
                <td><?= h($actions->name) ?></td>
                <td><?= h($actions->company) ?></td>
                <td><?= h($actions->reservation) ?></td>
                <td><?= h($actions->identifier) ?></td>
                <td><?= h($actions->note) ?></td>
                <td><?= h($actions->price) ?></td>
                <td><?= h($actions->currency) ?></td>
                <td><?= h($actions->status) ?></td>
                <td><?= h($actions->start_name) ?></td>
                <td><?= h($actions->start_date) ?></td>
                <td><?= h($actions->start_lng) ?></td>
                <td><?= h($actions->start_lat) ?></td>
                <td><?= h($actions->end_name) ?></td>
                <td><?= h($actions->end_date) ?></td>
                <td><?= h($actions->end_lng) ?></td>
                <td><?= h($actions->end_lat) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Actions', 'action' => 'view', $actions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Actions', 'action' => 'edit', $actions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Actions', 'action' => 'delete', $actions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $actions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
