<?php $userSession = $this->request->session()->read('Auth.User'); ?>

<div class="header-container color-primary">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="header-title"><?= $trip->name ?>
                    <!-- Show participating users only when not alone -->
                    <?php if (count($trip->users) >= 2) {
                        echo ("<small>with</small> "); }
                        echo ("<ul class='list-inline'>");
                            foreach ($trip->users as $user):
                                if ($user->id != $userSession['id']) {
                                    echo ("<li class='avatar label-bottom'>");
                                    echo (" <img src='".$user->photo_dir."/".$user->photo."' class='avatar-img'>");
                                    echo (" <div class='label avatar-name'>".$user->first_name."</div>");
                                    echo ("</li>");
                                };
                            endforeach;
                        echo ("</ul>");
                    ?>
                </h1>
            </div>
            <div class="col-sm-4 text-right">
                <?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span><span class="btn-text"><strong>'.__('Add Action').'</strong></span>', ['controller' => 'Actions', 'action' => 'add', $trip->id], ['class' => 'btn btn-default btn-lg btn-calltoaction', 'escape' => false]); ?>
            </div>
        </div>
    </div>
</div>
