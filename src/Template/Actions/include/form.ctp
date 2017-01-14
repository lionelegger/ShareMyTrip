<div class="actions form large-9 medium-8 columns content">
    <?= $this->Form->create($action) ?>
    <fieldset>
        <?php
        $this->Form->input('trip_id', ['value' => '$trip_id', 'class' => 'hidden', 'label' => false]);
        echo $this->Form->input('type_id', ['options' => $types]);
        // echo $this->Form->input('owner_id'); don't need since we add the authUser as the owner_id in ActionsController
        echo $this->Form->input('name');
        echo $this->Form->input('company');
        echo $this->Form->input('reservation');
        echo $this->Form->input('identifier');
        echo $this->Form->input('note');
        echo $this->Form->input('price');
        echo $this->Form->input('currency');
        echo $this->Form->input('start_name');
        echo $this->Form->input('start_date', ['empty' => true]);
        echo $this->Form->input('start_lng');
        echo $this->Form->input('start_lat');
        echo $this->Form->input('end_name');
        echo $this->Form->input('end_date', ['empty' => true]);
        echo $this->Form->input('end_lng');
        echo $this->Form->input('end_lat');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
