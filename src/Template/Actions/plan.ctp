<? use Cake\I18n\Time; ?>
<!-- TODO: PLAN should only show the actions in which the logged user is participating -->
<!-- TODO: Add the participants list when not an action made with all (as a bubble hint on hover for example) -->

<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($trip->name, ['controller' => 'actions', 'action' => 'plan', $trip->id]) ?>
<? $this->Html->addCrumb('Plan') ?>

<div class="container clearfix">
    <?= $this->Html->link(__('Add Action'), ['controller' => 'Actions', 'action' => 'add', $trip->id], ['class' => 'btn btn-lg btn-danger']) ?>

    <nav class="tripNav pull-right">
        <button class="btn btn-primary" role="button">Plan</button>
        <button class="btn btn-default" role="button"><?= $this->Html->link(__('Map'), ['controller' => 'actions', 'action' => 'map', $trip->id]) ?></button>
        <button class="btn btn-default" role="button"><?= $this->Html->link(__('Budget'), ['controller' => 'actions', 'action' => 'budget', $trip->id]) ?></button>
    </nav>
    <h1><?= $trip->name ?>
        <small>with
            <?php foreach ($trip->users as $users): ?>
                <?= h($users->first_name) ?>
            <?php endforeach; ?>
        </small>
    </h1>
</div>

<?php $lastDate = '' ?>
<div class="actions">
<?php if (!empty($actions)):
    $firstRow=true;
    foreach ($actions as $action):
        $start_date = $this->Time->format($action->start_date, 'YYYY-MM-dd');
        $start_time = $this->Time->format($action->start_date, 'HH:mm');
        $end_date = $this->Time->format($action->end_date, 'YYYY-MM-dd');
        $end_time = $this->Time->format($action->end_date, 'HH:mm');
        if ($start_date != $lastDate || $start_date == '') {
            if ($firstRow==false) {echo "</div>";}
            echo "<div class='row actions-day'>";
            echo "    <div class='col-md-2 text-center'>";
            echo "      <div class='actions-date'>".$start_date."</div>";
            echo "    </div>";
            $firstRow=false;
        }
            echo "    <div class='col-md-3'>";
            echo "        <div class='action'>";
            echo "            <div class='time clearfix'>";
            echo "                <div class='start'>".$start_time."</div>";
            echo "                <div class='end'>".$end_time."</div>";
            echo "            </div>";
            echo "            <div class='icons clearfix'>";
            echo "                <div class='start'><span class='dotIcon status-".$action->status."'></span></div>";
            echo "                <div class='line status-".$action->status."'></div>";
            echo "                  <a href='actions/edit/".$action->id."'>";
            echo "                      <span class='map-icon map-icon-type-".$action->type_id." map-icon-status status-".$action->status."'></span>";
            echo "                  </a>";
            echo "                <div class='end'><span class='dotIcon status-".$action->status."'></span></div>";
            echo "            </div>";
            echo "            <div class='name clearfix'>";
            echo "                <div class='start'>".$action->start_name."</div>";
            echo "                <div class='end'>".$action->end_name."</div>";
            echo "            </div>";
            echo '            <h4 class="text-center">' . $this->Html->link($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) . '</h4>';
            echo "        </div>";
            echo "    </div>";
        $lastDate = $start_date;
    endforeach;
    echo "</div>";
endif; ?>
</div>

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
