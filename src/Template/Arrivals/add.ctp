<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Arrivals'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="arrivals form large-9 medium-8 columns content">
    <?= $this->Form->create($arrival) ?>
    <fieldset>
        <legend><?= __('Add Arrival') ?></legend>
        <?php
            echo $this->Form->input('longitude');
            echo $this->Form->input('latitude');
            echo $this->Form->input('date');
            echo $this->Form->input('action_id', ['options' => $actions]);
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
