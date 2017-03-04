<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($actions->first()->trip->name, ['controller' => 'actions', 'action' => 'plan', $actions->first()->trip->id]) ?>
<? $this->Html->addCrumb('Budget') ?>

<?php // Navigation
$this->start('navigation');
echo $this->element('Layout/navigation', [
    "trip_id" => $actions->first()->trip->id,
    "active_budget" => true
]);
echo $this->fetch('navigation');
$this->end();


include_once ('include/header.ctp');

$total = [];
$globalPaid = 0;
$globalBalance = 0;
$lastDate = '';

$totalUsers = count($tripUsers);
foreach ($tripUsers as $user):
    $totalPaid[$user->id] = 0;
    $totalBalance[$user->id] = 0;
endforeach;

if (!empty($actions)) {

    echo "<table class='table table-hover table-striped responsive-table table-budget'>";
    echo "<thead>";
    echo "    <tr>";
    echo "      <th style='min-width:300px'>";
    echo "          <h3>Actions</h3>";
    echo "      </th>";

    foreach ($tripUsers as $user):
        echo "<th>";
        echo "<div class='avatar'>";
        echo "  <img src='".$user->photo_dir."/".$user->photo."' class='avatar-img' />";
        echo "  <div class='avatar-name'>";
        echo $user->first_name." ".$user->last_name;
        echo "  </div>";
        echo "</div>";

        if ($user->id == $userSession['id']) {
            echo("<h3 class='text-danger'>");
        } else {
            echo("<h3>");
        }
        echo("</h3>");

        echo "</th>";
    endforeach;

    echo "      <th>";
    echo "          <h3>TOTAL</h3>";
    echo "      </th>";
    echo "    </tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($actions as $action) {
        $start_date = $this->Time->format($action->start_date, 'YYYY-MM-dd');
        $start_time = $this->Time->format($action->start_date, 'HH:mm');
        $end_date = $this->Time->format($action->end_date, 'YYYY-MM-dd');
        $end_time = $this->Time->format($action->end_date, 'HH:mm');
        $nbParticipationsAction = count($action->users);

        if ($start_date != $lastDate || $start_date == '') {
            echo "    <tr class='date-separation'><td class='no-padding-sm date' colspan='".($totalUsers + 2)."'>".$start_date."</td></tr>";
        }

        echo "    <tr>";
        echo "        <td class='no-padding-sm'>";
        echo "        <div class='action short'>";
        echo "            <div class='time clearfix'>";
        echo "                <div class='start'>" . $start_time . "</div>";
        echo "                <div class='end'>" . $end_time . "</div>";
        echo "            </div>";
        echo "            <div class='icons clearfix'>";
        echo "                <div class='start'><span class='dotIcon status-" . $action->status . "'></span></div>";
        echo "                <div class='line status-" . $action->status . "'>";
        if ($start_date != $end_date) {
            echo "                <div class='cut'></div>";
        }
        echo "                </div>";
        echo "                  <a href='actions/edit/" . $action->id . "'>";
        echo "                      <span class='map-icon map-icon-type-" . $action->type_id . " map-icon-status status-" . $action->status . "'></span>";
        echo "                  </a>";
        echo "                <div class='end'><span class='dotIcon status-" . $action->status . "'></span></div>";
        echo "            </div>";
        echo "            <div class='name clearfix'>";
        echo "                <div class='start'>" . $action->start_name . "</div>";
        echo "                <div class='end'>" . $action->end_name . "</div>";
        echo '                <h4 class="text-center">' . $this->Html->link($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) . '</h4>';
        echo "            </div>";
        echo "        </div>";
        echo "        </td>";

//        CONTENT
        // a cell <TD> is created for each participant of the trip (even if they don't participate to any action)
        foreach ($tripUsers as $tripUser) {
            echo "<td data-title='" . $tripUser->first_name . "' valign='middle'>";

            $cellEmpty = true;
            // The current user need to participate in the action
            foreach ($action->users as $user) {
                if ($user->id == $tripUser->id) {

                    $totalCell = 0;
                    $n = 0;
                    $tipPayment = '';

                    // Show only when payments have been made
                    if (!empty($action->payments)) {

                        // The payments has to be done by the current user
                        foreach ($action->payments as $payment) {
                            if ($payment->user_id == $user->id) {
                                $totalCell = $totalCell + $payment->amount;
                                $detailPayment = '';
                                if (!empty($payment->date) OR !empty($payment->method_id)) {
                                    $detailPayment = " [";
                                    $payment_date = $payment->date->i18nFormat('yyyy-MM-dd');

                                    if (!empty($payment_date)) {
                                        $detailPayment .= $payment_date;
                                    }
                                    if (!empty($payment_date) AND !empty($payment->method_id)) {
                                        $detailPayment .= " | ";
                                    }
                                    if (!empty($payment->method_id)) {
                                        $detailPayment .= $payment->method_id;
                                    }
                                    $detailPayment .= "]";
                                }
                                $tipPayment .= "<div class='tipPayment'>" . $payment->amount . ' ' . $payment->currency . $detailPayment . "</div>";
                                $totalColumn = $totalPaid[$payment->user_id];
                                $totalPaid[$payment->user_id] = $payment->amount + $totalColumn;
                                $n++;
                            }
                        }
                    }

                    // show total amount paid for this cell
                    ?>
                    <h4>
                        <?php if ($n>1) { ?>
                            <a href="#" data-toggle="tooltip" data-placement="top" data-html="true" title="<?=$tipPayment?>"><?=$totalCell?></a>
                        <?php } else { ?>
                            <?=$totalCell?>
                        <?php } ?>
                    </h4>
                    <?php
//                    echo (" = <a data-toggle='popover' title='Popover title' data-placement='top' data-content='some amazing content. It very engaging. Right?'>". $totalCell . "</a>");

                    if ($nbParticipationsAction > 0) {
                        $balanceCell = $totalCell - ($action->price / $nbParticipationsAction);
//                        echo "<br/>Balance is: <span class='badge'>" . $balanceCell . "</span>";
                        $totalBalance[$user->id] = $totalBalance[$user->id] + $balanceCell;
                        $totalBalance[$user->id] = round($totalBalance[$user->id], 2);
                    }
                    $cellEmpty = false;
                }
            }
            // if not participating, add an space character to render well on small displays
            if ($cellEmpty) {
                echo ("&nbsp;");
            }
            echo "</td>";
        }

        echo "      <td data-title='Total'>";
        echo "        <h3>" . $action->price . " " . $action->currency . "</h3>[" . $nbParticipationsAction . " part.]";
        echo "      </td>";
        echo "    </tr>";

        $lastDate = $start_date;

    }

    echo "    <tr>";
    echo "      <td>";
    echo "          <h3>TOTAL</h3>";
    echo "      </td>";

    foreach ($tripUsers as $user) {
        echo "<td data-title='".$user->first_name."'>";
        echo "<h3><strong>" . $totalPaid[$user->id] . "</strong></h3>";
        echo "TOTAL balance for " . $user->first_name . " = <span class='badge'>" . $totalBalance[$user->id] . "</span>";
        echo "</td>";
    }

    echo "      <td data-title='ALL'>";
    foreach ($tripUsers as $user) {
        $globalPaid = $globalPaid + $totalPaid[$user->id];
        $globalBalance = $globalBalance + $totalBalance[$user->id];
    }
    echo "<h2>" . $globalPaid . "</h2>";
    echo "BIG TOTAL balance = <span class='badge'>" . $globalBalance . "</span>";
    echo "      </td>";
    echo "    </tr>";
    echo "</tbody>";
    echo "</table>";
}
?>

<script>
    $(function () {
        $("[data-toggle=tooltip]").tooltip();
    })
</script>






