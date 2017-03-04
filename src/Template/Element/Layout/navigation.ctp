<?php
if ($userSession = $this->request->session()->read('Auth.User'));

// MENU TRIPS
if (isset($active_trips)) {
    echo ("<li class='active'>");
    } else {
    echo ("<li>");
}
echo $this->Html->link('<span class="glyphicon glyphicon-globe"></span> Trips', ['controller' => 'Trips', 'action' => 'index'], ['escape' => false]);
echo ("</li>");

// PLAN, MAP and BUDGET only disabled when no trip is defined
// MENU PLAN
if (isset($active_plan)) {
    echo ("<li class='active'>");
    echo ("<a href='javascript:void(0)'><span class='glyphicon glyphicon-calendar'></span> Plan</a>");
} elseif (isset($disabled_plan)) {
    echo ("<li class='disabled'>");
    echo ("<a href='javascript:void(0)'><span class='glyphicon glyphicon-calendar'></span> Plan</a>");
} else {
    echo ("<li>");
    echo $this->Html->link('<span class="glyphicon glyphicon-calendar"></span> Plan', ['controller' => 'Actions', 'action' => 'plan', $trip_id], ['escape' => false]);
}
echo ("</li>");

// MENU MAP
if (isset($active_map)) {
    echo ("<li class='active'>");
    echo ("<a href='javascript:void(0)'><span class='glyphicon glyphicon-map-marker'></span> Map</a>");
} elseif (isset($disabled_map)) {
    echo ("<li class='disabled'>");
    echo ("<a href='javascript:void(0)'><span class='glyphicon glyphicon-map-marker'></span> Map</a>");
} else {
    echo ("<li>");
    echo $this->Html->link('<span class="glyphicon glyphicon-map-marker"></span> Map', ['controller' => 'Actions', 'action' => 'map', $trip_id], ['escape' => false]);
}
echo ("</li>");

// MENU BUDGET
if (isset($active_budget)) {
    echo ("<li class='active'>");
    echo ("<a href='javascript:void(0)'><span class='glyphicon glyphicon-piggy-bank'></span> Budget</a>");
} elseif (isset($disabled_budget)) {
    echo ("<li class='disabled'>");
    echo ("<a href='javascript:void(0)'><span class='glyphicon glyphicon-piggy-bank'></span> Budget</a>");
} else {
    echo ("<li>");
    echo $this->Html->link('<span class="glyphicon glyphicon-piggy-bank"></span> Budget', ['controller' => 'Actions', 'action' => 'budget', $trip_id], ['escape' => false]);
}
echo ("</li>");

// MENU USER
if (isset($active_user)) {
    echo ("<li class='active visible-xs-block'>");
} else {
    echo ("<li class='visible-xs-block'>");
}
echo $this->Html->link('<span class="glyphicon glyphicon-user"></span> '.$userSession['first_name'].' '.$userSession['last_name'], ['controller' => 'Users', 'action' => 'edit', $userSession['id']], ['escape' => false]);
echo ("</li>");

?>
