<?php $userSession = $this->request->session()->read('Auth.User'); ?>
<?php $start_date = $this->Time->format($trip->date_start, 'd MMMM');?>
<?php $end_date = $this->Time->format($trip->date_end, 'd MMMM yyyy');?>
<div class="header-container color-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1 class="header-title"><?= $trip->name ?>
                    <!-- Show participating users only when not alone -->
                    <?php if (count($trip->users) >= 2) {
                        echo ("<small>with</small> "); }
                        echo ("<ul class='list-inline'>");
                            foreach ($trip->users as $user):
                                if ($user->id != $userSession['id']) {
                                    echo ("<li class='avatar label-bottom'>");
                                    if ($user->photo) {
                                        echo (" <img src='".$user->photo_dir."/".$user->photo."' class='avatar-img circle'>");
                                    } else {
                                        echo (" <img src='files/Users/avatars/avatar-".$user->avatar.".png' class='avatar-img'>");
                                    }
                                    echo (" <div class='label avatar-name'>".$user->first_name."</div>");
                                    echo ("</li>");
                                };
                            endforeach;
                        echo ("</ul>");
                    ?>
                </h1>
                <?php if ($start_date) {
                    echo "<div class='header-date'>";
                    echo $start_date;
                    if($end_date) {
                        echo " - ". $end_date;
                    }
                    echo "</div>";
                } ?>
            </div>
            <!--  Hide the Add action button when already "add" an action -->
            <?php if (!isset($edit) || $edit): ?>
            <div class="col-md-3 text-right">
                <?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span><span class="btn-text"><strong>'.__('Add an action').'</strong></span>', ['controller' => 'Actions', 'action' => 'add', $trip->id], ['class' => 'btn btn-default btn-lg btn-calltoaction', 'escape' => false]); ?>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>
