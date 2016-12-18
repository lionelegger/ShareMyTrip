<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Action'), ['action' => 'edit', $action->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Action'), ['action' => 'delete', $action->id], ['confirm' => __('Are you sure you want to delete # {0}?', $action->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trips'), ['controller' => 'Trips', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trip'), ['controller' => 'Trips', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Arrivals'), ['controller' => 'Arrivals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Arrival'), ['controller' => 'Arrivals', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departures'), ['controller' => 'Departures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departure'), ['controller' => 'Departures', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Participations'), ['controller' => 'Participations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Participation'), ['controller' => 'Participations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="actions view large-9 medium-8 columns content">
    <h3><?= h($action->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($action->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= h($action->company) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reservation') ?></th>
            <td><?= h($action->reservation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Trip') ?></th>
            <td><?= $action->has('trip') ? $this->Html->link($action->trip->name, ['controller' => 'Trips', 'action' => 'view', $action->trip->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($action->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $action->has('type') ? $this->Html->link($action->type->name, ['controller' => 'Types', 'action' => 'view', $action->type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($action->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($action->price) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Notes') ?></h4>
        <?= $this->Text->autoParagraph(h($action->notes)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Arrivals') ?></h4>
        <?php if (!empty($action->arrivals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($action->arrivals as $arrivals): ?>
            <tr>
                <td><?= h($arrivals->id) ?></td>
                <td><?= h($arrivals->longitude) ?></td>
                <td><?= h($arrivals->latitude) ?></td>
                <td><?= h($arrivals->date) ?></td>
                <td><?= h($arrivals->action_id) ?></td>
                <td><?= h($arrivals->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Arrivals', 'action' => 'view', $arrivals->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Arrivals', 'action' => 'edit', $arrivals->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Arrivals', 'action' => 'delete', $arrivals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $arrivals->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Departures') ?></h4>
        <?php if (!empty($action->departures)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($action->departures as $departures): ?>
            <tr>
                <td><?= h($departures->id) ?></td>
                <td><?= h($departures->longitude) ?></td>
                <td><?= h($departures->latitude) ?></td>
                <td><?= h($departures->date) ?></td>
                <td><?= h($departures->action_id) ?></td>
                <td><?= h($departures->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Departures', 'action' => 'view', $departures->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Departures', 'action' => 'edit', $departures->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Departures', 'action' => 'delete', $departures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departures->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Participations') ?></h4>
        <?php if (!empty($action->participations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($action->participations as $participations): ?>
            <tr>
                <td><?= h($participations->id) ?></td>
                <td><?= h($participations->user_id) ?></td>
                <td><?= h($participations->action_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Participations', 'action' => 'view', $participations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Participations', 'action' => 'edit', $participations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Participations', 'action' => 'delete', $participations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $participations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Payments') ?></h4>
        <?php if (!empty($action->payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Currency') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Method Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($action->payments as $payments): ?>
            <tr>
                <td><?= h($payments->id) ?></td>
                <td><?= h($payments->amount) ?></td>
                <td><?= h($payments->currency) ?></td>
                <td><?= h($payments->action_id) ?></td>
                <td><?= h($payments->date) ?></td>
                <td><?= h($payments->user_id) ?></td>
                <td><?= h($payments->method_id) ?></td>
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
</div>