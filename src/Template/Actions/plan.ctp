<?
use Cake\I18n\Time;
use Cake\I18n\Date;

$userSession = $this->request->session()->read('Auth.User');

// Breadcrumb
$this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']);
$this->Html->addCrumb($trip->name, ['controller' => 'actions', 'action' => 'plan', $trip->id]);
$this->Html->addCrumb('Plan');

// Navigation
$this->start('navigation');
if ($actions->isEmpty()) {
    echo $this->element('Layout/navigation', [
        "trip_id" => $trip->id,
        "active_plan" => true,
        "disabled_map" => true,
        "disabled_budget" => true
    ]);
} else {
    echo $this->element('Layout/navigation', [
        "trip_id" => $trip->id,
        "active_plan" => true
    ]);
}
echo $this->fetch('navigation');
$this->end();

include_once ('include/header.ctp');
?>


<?php $lastDate = '' ?>
<div class="actions">
<?php if (!empty($actions)):
    $firstRow=true;
    foreach ($actions as $action):
//        $tomorrow = new Date();
//        $tomorrow = $tomorrow->modify('+1 days');
//        $tomorrow = $this->Time->format($tomorrow, 'YYYY-MM-dd');
//        echo (" / Tomorrow=".$tomorrow);
//        echo ("start_date=".$start_date." / end_date=".$end_date);


        $start_year = $this->Time->format($action->start_date, 'YYYY');
        $start_date = $this->Time->format($action->start_date, 'd MMM');
        $start_date_title = $this->Time->format($action->start_date, 'd MMMM');
        // if start_time is 12:00:01, we don't show the time
        $start_time = $this->Time->format($action->start_date, 'HH:mm:ss');
        if($start_time == '12:00:01') {
            $start_time = '';
        } else {
            $start_time = $this->Time->format($action->start_date, 'HH:mm');
        }

        $end_date = $this->Time->format($action->end_date, 'd MMM');
        $end_date_short = $this->Time->format($action->end_date, 'd MMM');
        // if end_time is 12:00:01, we don't show the time
        $end_time = $this->Time->format($action->end_date, 'HH:mm:ss');
        if($end_time == '12:00:01') {
            $end_time = '';
        } else {
            $end_time = $this->Time->format($action->end_date, 'HH:mm');
        }


        $current_date = $start_date;

        // When no end_name and no end_time, then action with only 1 dot
        $startIsEnd = false;
        if (!$action->end_name && !$action->end_date) {
            $startIsEnd = true;
        }

        // When end_date is not same day as start_date, then make a break in the line
        $isSameDay = true;
        if ($start_date != $end_date && $end_date != '') {
            $isSameDay=false;
        }


        if ($start_date != $lastDate || ($start_date == '' && $firstRow==true)) {
            if ($firstRow==false) {echo "</div>";}
            echo "<div class='row actions-day'>";
            echo "    <div class='col-md-2 text-center'>";
            if ($start_date == '' && $firstRow==true) {
                echo "      <div class='actions-date'>Before/After</div>";
            } else {
                echo "      <div class='actions-date'>".$start_date_title."</div>";
            }
            echo "    </div>";
            $firstRow=false;
        }
            if (!$startIsEnd) {echo "<div class='col-md-3'>";} else {echo "<div class='col-md-2'>";}
            if ($startIsEnd) {
                echo "        <div class='action start-end'>";
            } else {
                echo "        <div class='action'>";
            }
            echo "            <div class='time clearfix'>";
            if ($start_time) { echo "                <div class='start'>".$start_time."</div>"; }
            if ($end_time) { echo "<div class='end'>".$end_time."</div>"; }
            echo "            </div>";
            echo "            <div class='icons clearfix'>";
            echo "                <div class='start'><span class='dotIcon status-".$action->status."'></span></div>";
            if (!$startIsEnd) {
                echo "<div class='line status-" . $action->status . "'>";
                if (!$isSameDay) {
                    echo "<div class='cut'>".$end_date_short."</div>";
                }
                echo "</div>";
            }
            echo "                  <a href='actions/edit/".$action->id."'>";
            echo "                      <span class='map-icon map-icon-type-".$action->type_id." map-icon-status status-".$action->status."'></span>";
            echo "                  </a>";
            if (!$startIsEnd) {echo "                <div class='end'><span class='dotIcon status-".$action->status."'></span></div>";}
            echo "            </div>";
            echo "            <div class='name clearfix'>";
            if ($action->start_name) { echo "                <div class='start'>".$action->start_name."</div>"; }
            if ($action->end_name || $action->start_name) {echo "<div class='end'>".$action->end_name."</div>";}
            echo '                <div class="action-name text-center">' . $this->Html->link($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) . '</div>';
            echo "            </div>";
            echo "        </div>";
            echo "    </div>";
        $lastDate = $start_date;
    endforeach;
    echo "</div>";
endif; ?>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>



