<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Participations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="participations form large-9 medium-8 columns content">
    <?= $this->Form->create($participation) ?>
    <fieldset>
        <legend><?= __('Add Participation') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('action_id', ['options' => $actions]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
