<? $this->Html->addCrumb('Trips'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Trip'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trips index large-9 medium-8 columns content">
    <h3><?= __('Trips') ?></h3>
    <div class="align-right">sort by :
        <ul class="list-inline">
            <li><?= $this->Paginator->sort('id') ?></li>
            <li><?= $this->Paginator->sort('name') ?></li>
            <li><?= $this->Paginator->sort('owner_id') ?></li>
        </ul>
    </div>
    <?php foreach ($trips as $trip): ?>
        <div class="box">
            <div class="row">
                <div class="trip clearfix">
                    <div class="col-md-12 mainContent">
                        <h2 class="trip-title"><?= $this->Html->link(h($trip->name), ['action' => 'view', $trip->id]) ?></h2>
                        <ul class="list-inline pull-right">
                            <ul class="list-inline pull-right">
                                <?php foreach ($trip->users as $users): ?>
                                    <li><span class="label label-default"><?= h($users->first_name) ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        </ul>
                        <div class="actions">
                            <?//= $this->Html->link(__('Edit'), ['action' => 'edit', $trip->id], ['class' => 'btn btn-default']) ?>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#tripParticipants-<?= $trip->id ?>">
                                <span class="glyphicon glyphicon-cog"></span> Trip Settings
                            </button>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $trip->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete # {0}?', $trip->id)]) ?>
                        </div>
                        <small>trip id: <?= $this->Number->format($trip->id) ?></small>
                        <small>Owner id: <?= $this->Number->format($trip->owner_id) ?></small>
                        <div class="clearfix">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="tripParticipants-<?= $trip->id ?>" ng-controller="tripParticipantsCtrl" ng-init="init(<?= $trip->id ?>)">
            <div class="modal-dialog" role="document">
                <div class="hidden" id="tripId"><?= $trip->id ?></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title">Edit <?= $trip->name ?> (<?= $trip->id ?>)</h2>
                    </div>
                    <h4 class="modal-body">Friends that share this trip</h4>
                    <form class="form-horizontal" method="post" accept-charset="utf-8">
                        <div class="modal-body">
                            <div class="form-group" ng-repeat="user in currentTrip.trip.users" id="tripUser-{{user._joinData.id}}">
                                <label class="col-sm-9 text-right control-label">{{user.first_name}}</label>
                                <button type="button" id="tripDeleteUser-{{user._joinData.id}}" class="btn btn-danger col-sm-2" ng-click="tripDeleteUser(user._joinData.id)">Delete {{user._joinData.id}}</button>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" method="post" accept-charset="utf-8">
                        <div class="modal-body">
                            <div class="form-group" id="tripAddUser-form">
                                <label for="email" class="col-sm-2 control-label">email</label>
                                <div class="col-sm-7">
                                    <input class="form-control" id="email" placeholder="Enter friend's email address" ng-model="userToGet.email">
                                </div>
                                <button type="button" id="tripAddUser" class="btn btn-default col-sm-2" ng-click="tripAddUser()">Add</button>
                            </div>
                            <div class="form-message col-md-offset-2 text-info"></div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:history.go(0)" class="btn btn-primary" role="button">Close</a>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    <?php endforeach; ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
