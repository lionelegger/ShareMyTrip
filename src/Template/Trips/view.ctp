<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($trip->name, ['controller' => 'Trips', 'action' => 'view', $trip->id]) ?>
<? $this->Html->addCrumb('Plan') ?>

<?= $this->Html->link(__('Add Action'), ['controller' => 'Actions', 'action' => 'add', $trip->id], ['class' => 'btn btn-lg btn-danger']) ?>

<nav class="tripNav pull-right">
    <button class="btn btn-primary" role="button">Plan</button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Map'), ['action' => 'map', $trip->id]) ?></button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Cost'), ['action' => 'map', $trip->id]) ?></button>
</nav>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Trip'), ['action' => 'edit', $trip->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Trip'), ['action' => 'delete', $trip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trip->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Trips'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trip'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add', $trip->id]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>

<div class="trips view large-9 medium-8 columns content">
    <h3><?= h($trip->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($trip->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($trip->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Actions') ?></h4>
        <?php if (!empty($trip->actions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Company') ?></th>
                <th scope="col"><?= __('Reservation') ?></th>
                <th scope="col"><?= __('Notes') ?></th>
                <th scope="col"><?= __('Trip Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Currency') ?></th>
                <th scope="col"><?= __('Type Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($trip->actions as $actions): ?>
            <tr>
                <td><?= h($actions->id) ?></td>
                <td><?= h($actions->name) ?></td>
                <td><?= h($actions->company) ?></td>
                <td><?= h($actions->reservation) ?></td>
                <td><?= h($actions->notes) ?></td>
                <td><?= h($actions->trip_id) ?></td>
                <td><?= h($actions->price) ?></td>
                <td><?= h($actions->currency) ?></td>
                <td><?= h($actions->type_id) ?></td>
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
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($trip->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Picture') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($trip->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->first_name) ?></td>
                <td><?= h($users->last_name) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->picture) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
