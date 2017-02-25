<? use Cake\I18n\Time; ?>
<!-- TODO: PLAN should only show the actions in which the logged user is participating -->
<!-- TODO: Add the participants list when not an action made with all (as a bubble hint on hover for example) -->

<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($trip->name, ['controller' => 'Trips', 'action' => 'view', $trip->id]) ?>

<?= $this->Html->link(__('Add Action'), ['controller' => 'Actions', 'action' => 'add', $trip->id], ['class' => 'btn btn-lg btn-danger']) ?>

<nav class="tripNav pull-right">
    <button class="btn btn-primary" role="button">Plan</button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Map'), ['controller' => 'trips', 'action' => 'map', $trip->id]) ?></button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Budget'), ['controller' => 'actions', 'action' => 'trip', $trip->id]) ?></button>

</nav>

<pre><?= $trip ?></pre>

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

