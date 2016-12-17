<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $action->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $action->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['action' => 'index']) ?></li>
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
<div class="actions form large-9 medium-8 columns content">
    <?= $this->Form->create($action) ?>
    <fieldset>
        <legend><?= __('Edit Action') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('company');
            echo $this->Form->input('reservation');
            echo $this->Form->input('notes');
            echo $this->Form->input('trip_id', ['options' => $trips]);
            echo $this->Form->input('price');
            echo $this->Form->input('currency');
            echo $this->Form->input('type_id', ['options' => $types]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
