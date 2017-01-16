<? use Cake\I18n\Time; ?>

<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($trip->name, ['controller' => 'Trips', 'action' => 'view', $trip->id]) ?>

<?= $this->Html->link(__('Add Action'), ['controller' => 'Actions', 'action' => 'add', $trip->id], ['class' => 'btn btn-lg btn-danger']) ?>

<nav class="tripNav pull-right">
    <button class="btn btn-primary" role="button">Plan</button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Map'), ['controller' => 'trips', 'action' => 'map', $trip->id]) ?></button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Budget'), ['controller' => 'actions', 'action' => 'trip', $trip->id]) ?></button>

</nav>

<h1><?= $trip->name ?>
    <small>with
        <?php foreach ($trip->users as $users): ?>
            <?= h($users->first_name) ?>
        <?php endforeach; ?>
    </small>
</h1>

<?php $lastDate = '' ?>
<?php if (!empty($trip->actions)):
    $firstRow=true;
    foreach ($trip->actions as $action):
        $start_date = $this->Time->format($action->start_date, 'YYYY-MM-dd');
        $start_time = $this->Time->format($action->start_date, 'HH:mm');
        $end_date = $this->Time->format($action->end_date, 'YYYY-MM-dd');
        $end_time = $this->Time->format($action->end_date, 'HH:mm');
        if ($start_date != $lastDate || $start_date == '') {
            if ($firstRow==false) {echo "</div>";}
            echo "<div class='row' style='border-top: 1px solid red;'>";
            echo "    <div class='col-md-2'>";
            echo $start_date;
            echo "    </div>";
            $firstRow=false;
        }
            echo "    <div class='col-md-3'>";

            echo '<h4>' . $this->Html->link($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) . '</h4>';
            echo $start_time . ' ' . $action->start_name;
            echo ' &#8594; ';
            echo $end_time . ' ' . $action->end_name;
            echo "    </div>";
        $lastDate = $start_date;
    endforeach;
    echo "</div>";
endif; ?>
<br><br>

<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?/*= __('Actions') */?></li>
        <li><?/*= $this->Html->link(__('Edit Trip'), ['action' => 'edit', $trip->id]) */?> </li>
        <li><?/*= $this->Form->postLink(__('Delete Trip'), ['action' => 'delete', $trip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trip->id)]) */?> </li>
        <li><?/*= $this->Html->link(__('List Trips'), ['action' => 'index']) */?> </li>
        <li><?/*= $this->Html->link(__('New Trip'), ['action' => 'add']) */?> </li>
        <li><?/*= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) */?> </li>
        <li><?/*= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add', $trip->id]) */?> </li>
        <li><?/*= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) */?> </li>
        <li><?/*= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) */?> </li>
    </ul>
</nav>
-->
<!--
<?php /*if (!empty($trip->actions)): */?>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col"><?/*= __('Id') */?></th>
        <th scope="col"><?/*= __('Trip Id') */?></th>
        <th scope="col"><?/*= __('Type Id') */?></th>
        <th scope="col"><?/*= __('Owner Id') */?></th>
        <th scope="col"><?/*= __('Name') */?></th>
        <th scope="col"><?/*= __('Company') */?></th>
        <th scope="col"><?/*= __('Reservation') */?></th>
        <th scope="col"><?/*= __('Identifier') */?></th>
        <th scope="col"><?/*= __('Note') */?></th>
        <th scope="col"><?/*= __('Price') */?></th>
        <th scope="col"><?/*= __('Currency') */?></th>
        <th scope="col"><?/*= __('Start Name') */?></th>
        <th scope="col"><?/*= __('Start Date') */?></th>
        <th scope="col"><?/*= __('Start Lng') */?></th>
        <th scope="col"><?/*= __('Start Lat') */?></th>
        <th scope="col"><?/*= __('End Name') */?></th>
        <th scope="col"><?/*= __('End Date') */?></th>
        <th scope="col"><?/*= __('End Lng') */?></th>
        <th scope="col"><?/*= __('End Lat') */?></th>
        <th scope="col" class="actions"><?/*= __('Actions') */?></th>
    </tr>
    <?php /*foreach ($trip->actions as $actions): */?>
    <tr>
        <td><?/*= h($actions->id) */?></td>
        <td><?/*= h($actions->trip_id) */?></td>
        <td><?/*= h($actions->type_id) */?></td>
        <td><?/*= h($actions->owner_id) */?></td>
        <td><?/*= h($actions->name) */?></td>
        <td><?/*= h($actions->company) */?></td>
        <td><?/*= h($actions->reservation) */?></td>
        <td><?/*= h($actions->identifier) */?></td>
        <td><?/*= h($actions->note) */?></td>
        <td><?/*= h($actions->price) */?></td>
        <td><?/*= h($actions->currency) */?></td>
        <td><?/*= h($actions->start_name) */?></td>
        <td><?/*= h($actions->start_date) */?></td>
        <td><?/*= h($actions->start_lng) */?></td>
        <td><?/*= h($actions->start_lat) */?></td>
        <td><?/*= h($actions->end_name) */?></td>
        <td><?/*= h($actions->end_date) */?></td>
        <td><?/*= h($actions->end_lng) */?></td>
        <td><?/*= h($actions->end_lat) */?></td>
        <td class="actions">
            <?/*= $this->Html->link(__('View'), ['controller' => 'Actions', 'action' => 'view', $actions->id]) */?>
            <?/*= $this->Html->link(__('Edit'), ['controller' => 'Actions', 'action' => 'edit', $actions->id]) */?>
            <?/*= $this->Form->postLink(__('Delete'), ['controller' => 'Actions', 'action' => 'delete', $actions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $actions->id)]) */?>
        </td>
    </tr>
    <?php /*endforeach; */?>
</table>
<?php /*endif; */?>


<hr>

<div class="related">
    <h4><?/*= __('Related Users') */?></h4>
    <?php /*if (!empty($trip->users)): */?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th scope="col"><?/*= __('Id') */?></th>
            <th scope="col"><?/*= __('Email') */?></th>
            <th scope="col"><?/*= __('First Name') */?></th>
            <th scope="col"><?/*= __('Last Name') */?></th>
            <th scope="col"><?/*= __('Password') */?></th>
            <th scope="col"><?/*= __('Picture') */?></th>
            <th scope="col" class="actions"><?/*= __('Actions') */?></th>
        </tr>
        <?php /*foreach ($trip->users as $users): */?>
        <tr>
            <td><?/*= h($users->id) */?></td>
            <td><?/*= h($users->email) */?></td>
            <td><?/*= h($users->first_name) */?></td>
            <td><?/*= h($users->last_name) */?></td>
            <td><?/*= h($users->password) */?></td>
            <td><?/*= h($users->picture) */?></td>
            <td class="actions">
                <?/*= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) */?>
                <?/*= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) */?>
                <?/*= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) */?>
            </td>
        </tr>
        <?php /*endforeach; */?>
    </table>
    <?php /*endif; */?>
</div>

-->
