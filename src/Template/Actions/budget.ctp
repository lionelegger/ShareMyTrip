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
$totalTrip = 0;

$totalUsers = count($tripUsers);
foreach ($tripUsers as $user):
    $totalPaid[$user->id] = 0;
    $totalBalance[$user->id] = 0;
    $totalTripCost[$user->id] = 0;
endforeach;

if (!empty($actions)) {

    echo "<table class='table table-hover table-striped responsive-table table-budget'>";
    echo "<thead>";
    echo "    <tr>";
    echo "      <th style='min-width:300px; width: 500px;'>";
    echo "          <h3>Actions</h3>";
    echo "      </th>";

    foreach ($tripUsers as $user):
        if ($user->id == $userSession['id']) {
            echo("<th class='currentUser'>");
        } else {
            echo("<th>");
        }
        echo("<div class='avatar'>");
        if ($user->photo) {
            echo "  <img src='".$user->photo_dir."/".$user->photo."' class='avatar-img circle' />";
        } else {
            echo "  <img src='files/Users/avatars/avatar-".$user->avatar.".png' class='avatar-img' />";
        }

        echo "  <div class='avatar-name'>";
        echo $user->first_name;
        echo "  </div>";
        echo "</div>";

        echo "</th>";
    endforeach;

    echo "      <th class='price'>";
    echo "          <h3>PRICE</h3>";
    echo "      </th>";
    echo "    </tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($actions as $action) {

        $start_date = $this->Time->format($action->start_date, 'd MMMM');
        // if start_time is 12:00:01, we don't show the time
        $start_time = $this->Time->format($action->start_date, 'HH:mm:ss');
        if($start_time == '12:00:01') {
            $start_time = '';
        } else {
            $start_time = $this->Time->format($action->start_date, 'HH:mm');
        }

        $end_date = $this->Time->format($action->end_date, 'd MMMM');
        $end_date_short = $this->Time->format($action->end_date, 'd MMM');
        // if end_time is 12:00:01, we don't show the time
        $end_time = $this->Time->format($action->end_date, 'HH:mm:ss');
        if($end_time == '12:00:01') {
            $end_time = '';
        } else {
            $end_time = $this->Time->format($action->end_date, 'HH:mm');
        }

        // When no end_name and no end_time, then action with only 1 dot
        $startIsEnd = false;
        if ($action->end_name=='' && $end_time=='') {
            $startIsEnd = true;
        }

        // When end_date is not same day as start_date, then make a break in the line
        $isSameDay = true;
        if ($start_date != $end_date && $end_date != '') {
            $isSameDay=false;
        }

        $nbParticipationsAction = count($action->users);

        if ($start_date != $lastDate || $start_date == '') {
//            echo "    <tr class='date-separation'><td class='no-padding-sm date' colspan='".($totalUsers + 2)."'>".$start_date."</td></tr>";
            echo "    <tr class='date-separation'>";
            echo "        <td class='no-padding-sm date'>".$start_date."</td>";
            foreach ($tripUsers as $user) {
                echo "<td class='hidden-xs'></td>";
            }
            echo "<td class='hidden-xs'></td>";
            echo "</tr>";
        }

        echo "    <tr>";
        echo "        <td class='no-padding-sm'>";
        echo " <a class='action-link' href='actions/edit/" . $action->id . "'>";
        if ($startIsEnd) {
            echo "        <div class='action start-end'>";
        } else {
            echo "        <div class='action'>";
        }
        echo "            <div class='time clearfix'>";
        if ($start_time) { echo "<div class='start'>".$start_time."</div>"; }
        if ($end_time) { echo "<div class='end'>".$end_time."</div>"; }
        echo "            </div>";
        echo "            <div class='icons clearfix'>";
        echo "                <div class='start'><span class='dotIcon status-" . $action->status . "'></span></div>";
        if (!$startIsEnd) {
            echo "<div class='line status-" . $action->status . "'>";
            if (!$isSameDay) {
                echo "<div class='cut'>".$end_date_short."</div>";
            }
            echo "</div>";
        }
        echo "<span class='map-icon map-icon-type-" . $action->type_id . " map-icon-status status-" . $action->status . "'></span>";
        if (!$startIsEnd) {echo "<div class='end'><span class='dotIcon status-" . $action->status . "'></span></div>";}
        echo "            </div>";
        echo "            <div class='name clearfix'>";
        if ($action->start_name) {echo "                <div class='start'>" . $action->start_name . "</div>";}
        if ($action->end_name || $action->start_name) {echo "                <div class='end'>" . $action->end_name . "</div>";}
/*        echo '                <div class="action-name text-center">' . $this->Html->link($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) . '</div>';*/
        echo '                <div class="action-name text-center">' . $action->name . '</div>';
        echo "            </div>";
        echo "        </div> <!-- end of action -->";
        echo "  </a>";
        echo "    </td>";

//        CONTENT
        // a cell <TD> is created for each participant of the trip (even if they don't participate to any action)
        foreach ($tripUsers as $tripUser) {
            if ($tripUser->id == $userSession['id']) {
                echo "<td data-title='" . $tripUser->first_name . "' valign='middle' class='currentUser'>";
            } else {
                echo "<td data-title='" . $tripUser->first_name . "' valign='middle'>";
            }

            $isParticipating = false;
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
                                // Payment details hidden (because cannot get the payment method name)
                                /*
                                if (!empty($payment->date) OR !empty($payment->method_id)) {
                                    $detailPayment = " [";
                                    $payment_date = $payment->date->i18nFormat('d MMM');
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
                                */
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
                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-html="true" title="<?=$tipPayment?>"><?=$totalCell?></a>
                        <?php } else { ?>
                            <?=$totalCell . "&thinsp;<small>" . $action->currency ."</small>" ?>
                        <?php } ?>
                    </h4>
                    <?php
//                    echo (" = <a data-toggle='popover' title='Popover title' data-placement='top' data-content='some amazing content. It very engaging. Right?'>". $totalCell . "</a>");

                    if ($nbParticipationsAction > 0) {
                        // Balance (per participant)
                        $balanceCell = $totalCell - ($action->price / $nbParticipationsAction);
//                      echo "<br/>Balance is: <span class='badge'>" . $balanceCell . "</span>";
                        $totalBalance[$user->id] = $totalBalance[$user->id] + $balanceCell;
                        $totalBalance[$user->id] = round($totalBalance[$user->id], 0);
                        // Trip cost (per participant)
                        $actionCostPerParticipant = $action->price / $nbParticipationsAction;
                        $totalTripCost[$user->id] = $totalTripCost[$user->id] + $actionCostPerParticipant;
                        $totalTripCost[$user->id] = round($totalTripCost[$user->id], 0);

                    }
                    $isParticipating = true;
                }
            }
            // if not participating, add an space character to render well on small displays
            if (!$isParticipating) {
                echo ("<span class='glyphicon glyphicon-remove text-lightgrey'></span>");
            }
            echo "</td>";
        }


        if ($action->price) {
            echo "      <td data-title='Price' class='price'>";
            echo "        <h4><strong>" . $action->price . "</strong>";
            echo "&nbsp;<small>" . $action->currency . "</small>";
        } else {
            echo "        <td class='hidden-xs price'>&nbsp;</td>";
        }
        echo "</h4>";
        $totalTrip = $totalTrip + $action->price;
//        echo "[" . $nbParticipationsAction . " participants]";
        echo "      </td>";
        echo "    </tr>";

        $lastDate = $start_date;
    }

    // Balance calculation
    foreach ($tripUsers as $user) {
        $globalPaid = $globalPaid + $totalPaid[$user->id];
        $globalBalance = $globalBalance + $totalBalance[$user->id];
    }

    echo "    <tr class='sum'>";
    echo "      <td>";
    echo "          <h3><strong>TOTAL paid</strong></h3>";
    echo "      </td>";

    foreach ($tripUsers as $user) {
        if ($user->id == $userSession['id']) {
            echo "<td data-title='" . $user->first_name . "' class='currentUser'>";
        } else {
            echo "<td data-title='" . $user->first_name . "'>";
        }
        echo "<h3><strong>" . $totalPaid[$user->id] . "</strong>&thinsp;<small>".$trip->currency."</small></h3>";
        echo "</td>";
    }

    echo "      <td data-title='ALL' class='price'>";
    echo "<h3><strong>" . $globalPaid."</strong>&thinsp;<small>".$trip->currency."</small></h3>";
    echo "      </td>";
    echo "    </tr>";


    // TRIP COST
    echo "    <tr class='total'>";
    echo "      <td>";
    echo "          <h3 class='help-block'>TOTAL trip</h3>";
    echo "      </td>";

    foreach ($tripUsers as $user) {
        if ($user->id == $userSession['id']) {
        echo "<td data-title='".$user->first_name."' class='currentUser'>";
        } else {
            echo "<td data-title='" . $user->first_name . "'>";
        }
        echo "<h3 class='help-block'><strong>" . $totalTripCost[$user->id] . "</strong>&thinsp;<small>".$trip->currency."</small></h3>";
        echo "</td>";
    }

    echo "      <td data-title='ALL' class='price'>";
    echo "<h3 class='help-block'><strong>".$totalTrip."</strong>&thinsp;<small>".$trip->currency."</small></h3>";
    echo "      </td>";
    echo "    </tr>";


    // STILL TO PAY
    echo "<tr class='balance'>";
    echo "    <td>";
    echo "          <h3><strong>Still to pay</strong></h3>";
    echo "    </td>";
    foreach ($tripUsers as $user) {
        // stillToPay is the inverse of totalBalance
        $stillToPay[$user->id] = 0 - $totalBalance[$user->id];

        if ($user->id == $userSession['id']) {
        echo "<td data-title='".$user->first_name."' class='currentUser'>";
        } else {
            echo "<td data-title='" . $user->first_name . "'>";
        }

        echo "<h2>";
        if ($stillToPay[$user->id] < 0) {
            echo "<span class='label label-default'>".$stillToPay[$user->id]."<small class='text-normal'>&thinsp;".$trip->currency."</small></span>";
        } else if ($stillToPay[$user->id] == 0) {
            echo "<span class='label label-success'>".$stillToPay[$user->id]."<small class='text-normal'>&thinsp;".$trip->currency."</small></span>";
        } else if ($totalPaid[$user->id] == 0) {
            echo "<span class='label label-danger'>".$stillToPay[$user->id]."<small class='text-normal'>&thinsp;".$trip->currency."</small></span>";
        } else {
            echo "<span class='label label-warning'>".$stillToPay[$user->id]."<small class='text-normal'>&thinsp;".$trip->currency."</small></span>";
        };
        echo "</h2>";
        echo "</td>";
    }
    echo "<td data-title='Full trip' class='price'><h2>";
    // globalToPay is the inverse of globalBalance
    $globalToPay = 0 - $globalBalance;
    if ($globalToPay > 0) {
        echo "<span class='label label-warning'>".$globalToPay."<small class='text-normal'>&thinsp;".$trip->currency."</small></span>";
    } else if ($globalToPay == 0) {
        echo "<span class='label label-success'>".$globalToPay."<small class='text-normal'>&thinsp;".$trip->currency."</small></span>";
    } else if ($globalToPay == -$totalTrip) {
        echo "<span class='label label-danger'>".$globalToPay."<small class='text-normal'>&thinsp;".$trip->currency."</small></span>";
    } else {
        echo "<span class='label label-default'>".$globalToPay."<small class='text-normal'>&thinsp;".$trip->currency."</small></span>";
    }
    echo "</h2></td>";
    echo "</tr>";
    echo "</tbody>";
    echo "</table>";
}
?>
<?php include_once ("include/status-legend.ctp") ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script>
    $(function () {
        $("[data-toggle=tooltip]").tooltip();
    })
</script>






