<div class="actions form">
    <?= $this->Form->create($action) ?>
    <fieldset>
        <?php
        $this->Form->input('trip_id', ['value' => '$trip_id', 'class' => 'hidden', 'label' => false]);
        echo $this->Form->input('type_id', ['onchange' => "updateTypeId()"], ['options' => $types]);
        // echo $this->Form->input('owner_id'); don't need since we add the authUser as the owner_id in ActionsController
        // echo $this->Form->input('status'); don't need since it will be calculated automatically depending of the payments and price
        echo $this->Form->input('name');
        echo $this->Form->input('company');
        echo $this->Form->input('reservation');
        echo $this->Form->input('identifier');
        echo $this->Form->input('note');
        echo $this->Form->input('start_name');
        echo $this->Form->input('start_date', ['empty' => true]);
        echo $this->Form->input('start_lng');
        echo $this->Form->input('start_lat');
        echo $this->Form->input('end_name');
        echo $this->Form->input('end_date', ['empty' => true]);
        echo $this->Form->input('end_lng');
        echo $this->Form->input('end_lat');
        echo "<div class='box col-md-4'>";
            echo "<h4>Price</h4>";
            echo "<p class='help-block'>Please fill the total price for all participants</p>";
            echo $this->Form->input('price');
            echo $this->Form->input('currency');
        echo "<div class='clearfix'>&nbsp;</div></div";
        ?>
    </fieldset>

    <?= $this->Form->button(__('Submit Action'),
        ['class' => 'btn btn-lg btn-primary pull-right']
    ) ?>

    <?= $this->Form->end() ?>
</div>
