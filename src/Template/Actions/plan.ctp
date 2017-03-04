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
        $tomorrow = new Date();
        $tomorrow = $tomorrow->modify('+1 days');
        $tomorrow = $this->Time->format($tomorrow, 'YYYY-MM-dd');
        $start_date = $this->Time->format($action->start_date, 'YYYY-MM-dd');
        $start_time = $this->Time->format($action->start_date, 'HH:mm');
        $end_date = $this->Time->format($action->end_date, 'YYYY-MM-dd');
        $end_time = $this->Time->format($action->end_date, 'HH:mm');

//        echo ("start_date=".$start_date." / end_date=".$end_date);
        $current_date = $start_date;
//        echo (" / Tomorrow=".$tomorrow);


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
            echo "                <div class='line status-" . $action->status . "'>";
            if ($start_date != $end_date) {
                echo "                <div class='cut'></div>";
            }
            echo "                </div>";
            echo "                  <a href='actions/edit/".$action->id."'>";
            echo "                      <span class='map-icon map-icon-type-".$action->type_id." map-icon-status status-".$action->status."'></span>";
            echo "                  </a>";
            echo "                <div class='end'><span class='dotIcon status-".$action->status."'></span></div>";
            echo "            </div>";
            echo "            <div class='name clearfix'>";
            echo "                <div class='start'>".$action->start_name."</div>";
            echo "                <div class='end'>".$action->end_name."</div>";
            echo '                <h4 class="text-center">' . $this->Html->link($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) . '</h4>';
            echo "            </div>";
            echo "        </div>";
            echo "    </div>";
        $lastDate = $start_date;
    endforeach;
    echo "</div>";
endif; ?>
</div>



