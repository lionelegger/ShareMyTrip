<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($actions->first()->trip->name, ['controller' => 'Trips', 'action' => 'view', $actions->first()->trip->id]) ?>
<? $this->Html->addCrumb('Map') ?>

<nav class="tripNav pull-right">
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Plan'), ['controller' => 'trips', 'action' => 'view', $actions->first()->trip->id]) ?></button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Map'), ['controller' => 'trips', 'action' => 'map', $actions->first()->trip->id]) ?></button>
    <button class="btn btn-primary" role="button">Budget</button>
</nav>

<h1><?= $actions->first()->trip->name ?> Budget</h1>

<?php $total = []; ?>
<?php
    foreach ($tripUsers as $user):
        $total[$user->id] = 0;
    endforeach;
?>
<pre><?= $total[1] ?></pre>
<?php if (!empty($actions)):

    echo "<table class='table table-hover table-striped'>";
    echo "    <tr>";
    echo "      <th>";
    echo "          Action name";
    echo "      </th>";

    foreach ($tripUsers as $user):
        echo "<th>";
        echo $user->first_name;
        echo "</th>";
    endforeach;

    echo "      <th>";
    echo "          TOTAL";
    echo "      </th>";
    echo "    </tr>";

    foreach ($actions as $action):
        $start_date = $this->Time->format($action->start_date, 'YYYY-MM-dd');
        $start_time = $this->Time->format($action->start_date, 'HH:mm');
        $end_date = $this->Time->format($action->end_date, 'YYYY-MM-dd');
        $end_time = $this->Time->format($action->end_date, 'HH:mm');

        echo "    <tr>";
        echo "        <td>";
        echo "<p class='text-muted'>".$start_date."</p>";
        echo '<h4>' . $this->Html->link($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) . '</h4>';
        echo "        </td>";

//        CONTENT
        foreach ($tripUsers as $user):
            echo "<td>";

            if (!empty($action->payments)):
                foreach ($action->payments as $payment):
                    if($payment->user_id == $user->id) {
                        echo "paid: " . $payment->amount . "<br/>";
                        $total[$payment->user_id] =+ $payment->amount;
                    }
                endforeach;
            endif;

            echo "</td>";
        endforeach;

        echo "      <td>";
        echo $action->price;
        echo "      </td>";
        echo "    </tr>";

    endforeach;

    echo "    <tr>";
    echo "      <td>";
    echo "          TOTAL";
    echo "      </td>";

    foreach ($tripUsers as $user):
        echo "<td>";
        echo "TOTAL " . $user->first_name . " = ". $total[$user->id];
        echo "</td>";
    endforeach;

    echo "      <td>";
    echo "          BIG TOTAL";
    echo "      </td>";
    echo "    </tr>";
    echo "</table>";

endif; ?>

<br/><br/><br/>
<h3>LAST ACTION :</h3>
<pre><?= $action ?></pre>






