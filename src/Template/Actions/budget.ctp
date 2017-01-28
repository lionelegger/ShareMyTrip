<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($actions->first()->trip->name, ['controller' => 'actions', 'action' => 'plan', $actions->first()->trip->id]) ?>
<? $this->Html->addCrumb('Budget') ?>


<?php $userSession = $this->request->session()->read('Auth.User') ?>

<nav class="tripNav pull-right">
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Plan'), ['controller' => 'actions', 'action' => 'plan', $actions->first()->trip->id]) ?></button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Map'), ['controller' => 'actions', 'action' => 'map', $actions->first()->trip->id]) ?></button>
    <button class="btn btn-primary" role="button">Budget</button>
</nav>
<h1><?= $actions->first()->trip->name ?> Budget</h1>
<?php $total = [];
$globalPaid = 0;
$globalBalance = 0;
?>
<?php
    $totalUsers = count($tripUsers);
    foreach ($tripUsers as $user):
        $totalPaid[$user->id] = 0;
        $totalBalance[$user->id] = 0;
    endforeach;
?>
<h3><?= $totalUsers ?> Users</h3>
<?php if (!empty($actions)):

    echo "<table class='table table-hover table-striped table-responsive'>";
    echo "    <tr>";
    echo "      <th>";
    echo "          <h3>Action</h3>";
    echo "      </th>";

    foreach ($tripUsers as $user):
        echo "<th>";
        if ($user->id == $userSession['id']){echo ("<h3 class='text-danger'>");} else {echo ("<h3>");}
        echo $user->first_name;
        if ($user->id == $userSession['id']){echo ("</h3>");}
        echo "</th>";
    endforeach;

    echo "      <th>";
    echo "          <h3>TOTAL</h3>";
    echo "      </th>";
    echo "    </tr>";

    foreach ($actions as $action):
        $start_date = $this->Time->format($action->start_date, 'YYYY-MM-dd');
        $start_time = $this->Time->format($action->start_date, 'HH:mm');
        $end_date = $this->Time->format($action->end_date, 'YYYY-MM-dd');
        $end_time = $this->Time->format($action->end_date, 'HH:mm');
        $nbParticipationsAction = count($action->users);

        echo "    <tr>";
        echo "        <td>";
        echo "<p class='text-muted'>".$start_date."</p>";
        echo '<h4>' . $this->Html->link($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) . '</h4>';
        echo "        </td>";

//        CONTENT
        // a cell <TD> is created for each participant of the trip (even if they don't participate to any action)
        foreach ($tripUsers as $tripUser):
            echo "<td>";

            // The current user need to participate in the action
            foreach ($action->users as $user):
                if($user->id == $tripUser->id) {

                    $totalCell = 0;
                    $n=0;
                    echo ("Paid: ");

                    // Show only when payments have been made
                    if (!empty($action->payments)):

                        // The payments has to be done by the current user
                        foreach ($action->payments as $payment):
                            if($payment->user_id == $user->id) {
                                $totalCell = $totalCell + $payment->amount;
                                if ($n>0) {
                                    echo (" + ");
                                }
                                echo $payment->amount;
                                $totalColumn = $totalPaid[$payment->user_id];
                                $totalPaid[$payment->user_id] = $payment->amount + $totalColumn;
                                $n++;
                            }
                        endforeach;

                    endif;

                    // show total amount paid for this cell
                    echo (" = ". $totalCell);

                    if ($nbParticipationsAction > 0) {
                        $balanceCell = $totalCell - ($action->price / $nbParticipationsAction);
                        echo "<br/>Balance is: <span class='badge'>" . $balanceCell . "</span>";
                        $totalBalance[$user->id] = $totalBalance[$user->id] + $balanceCell;
                    }

                }
            endforeach;

            echo "</td>";
        endforeach;

        echo "      <td>";
        echo $action->price . " [".$nbParticipationsAction." part.]";
        echo "      </td>";
        echo "    </tr>";

    endforeach;

    echo "    <tr>";
    echo "      <td>";
    echo "          TOTAL";
    echo "      </td>";

    foreach ($tripUsers as $user):
        echo "<td>";
        echo "TOTAL paid by " . $user->first_name . " = ". $totalPaid[$user->id];
        echo "<br/>TOTAL balance for " . $user->first_name . " = <span class='badge'>". $totalBalance[$user->id] . "</span>";
        echo "</td>";
    endforeach;

    echo "      <td>";
    foreach ($tripUsers as $user):
        $globalPaid = $globalPaid + $totalPaid[$user->id];
        $globalBalance = $globalBalance + $totalBalance[$user->id];
    endforeach;
    echo "          BIG TOTAL paid = ". $globalPaid;
    echo "          <br/>BIG TOTAL balance = <span class='badge'>". $globalBalance . "</span>";
    echo "      </td>";
    echo "    </tr>";
    echo "</table>";

endif; ?>








