<div class="actions form">
    <?= $this->Form->create($action) ?>
    <fieldset>
        <div class="row">
            <div class="col-md-6 text-center col-md-offset-3">
                <div class="clearfix">
                    <?php
                    if ($edit) {
                        $initCat = $action->type->category_id;
                    } else {
                        $initCat = 1;
                    }
                    ?>
                    <div class="btn-group" role="group" data-toggle="buttons" ng-init='category=<?=$initCat?>'>
                        <?php
                        $status = '';
                        foreach ($allCategories as $category):
                            if ($edit) {
                                if ($action->type->category_id == $category->id) {$status = ' active';}
                            }
                            echo ("<label class='btn btn-default ".$status."' ng-click='category=".$category->id."'>");
                            echo (  "<input type='radio' name='categories' autocomplete='off' ".$status.">".$category->name);
                            echo ("</label>");
                            $status = '';
                        endforeach;
                        ?>
                    </div>
                </div>
                <br/>
                <div class="clearfix">
                    <ul class="btn-group map-icon-btn" name="type_id" id="type-id">
                        <?php
                            $active = '';
                            foreach ($allTypes as $type):
                                if ($action->type_id == $type->id) {$active = 'active';}
                                $status = 'status-0';
                                if ($action->type_id == $type->id) {$status = 'status-'.$action->status;}
                                echo "<div class='map-icon-button' ng-show='category==".$type->category_id."'>";
                                echo "  <li class='map-icon map-icon-type-".$type->id." map-icon-status ".$status." ".$active."' value='".$type->id."'></li>";
                                echo "  <div class='map-icon-name'>".$type->name."</div>";
                                echo "</div>";
                                $active = '';
                            endforeach;
                        ?>
                        <select class="hidden" id="type-id" name="type_id"><option></option></select>
                    </ul>
                </div>
                <br/>

                <?php //echo $this->Form->input('type_id', ['onchange' => "updateTypeId()"], ['options' => $types]); ?>
            </div>
        </div>
        <div class="row text-right">
            <div class="col-md-3">
                <?php
                $start_datetime = '';
                if ($action->start_date) {
                    $start_datetime = $action->start_date->i18nFormat('yyyy-MM-dd HH:mm');
                }
                ?>
                <div class='input-group date' id='datetimepickerStart'>
                    <input type='text' class='form-control' id='start_date' name='start_date' placeholder='Enter starting date' value='<?=$start_datetime?>' />
                    <span class='input-group-addon'>
                        <span class='glyphicon glyphicon-calendar'></span>
                    </span>
                </div>
            </div>

            <div class="col-md-3 pull-right col-md-9">
                <?php
                $end_datetime = '';
                if ($action->end_date) {
                    $end_datetime = $action->end_date->i18nFormat('yyyy-MM-dd HH:mm');
                }
                ?>
                <div class='input-group date' id='datetimepickerEnd'>
                    <input type='text' class='form-control' id='end_date' name='end_date' placeholder='Enter ending date' value='<?=$end_datetime?>' />
                    <span class='input-group-addon'>
                        <span class='glyphicon glyphicon-calendar'></span>
                    </span>
                </div>

            </div>
        </div>

        <script type="text/javascript">
            $(function () {
                $('#datetimepickerStart').datetimepicker({
                    format: 'YYYY-MM-DD hh:mm'
                });
                $('#datetimepickerEnd').datetimepicker({
                    format: 'YYYY-MM-DD hh:mm',
                    useCurrent: false //Important! See issue #1075
                });
                $("#datetimepickerStart").on("dp.change", function (e) {
                    $('#datetimepickerEnd').data("DateTimePicker").minDate(e.date);
                });
                $("#datetimepickerEnd").on("dp.change", function (e) {
                    $('#datetimepickerStart').data("DateTimePicker").maxDate(e.date);
                });
            });
        </script>

        <div class="row">
            <div class="col-md-12">
                <?php include_once("googleMap.ctp"); ?>
            </div>
        </div>

        <div class="clearfix"><br/></div>

        <div class="row">
            <div class="col-md-4">
                <?php
                echo $this->Form->input('name');
                echo $this->Form->input('company');
                echo $this->Form->input('reservation');
                echo $this->Form->input('identifier');
                ?>
            </div>
            <div class="col-md-8">
                <?php
                $this->Form->input('trip_id', ['value' => '$trip_id', 'class' => 'hidden', 'label' => false]);
                // echo $this->Form->input('owner_id'); don't need since we add the authUser as the owner_id in ActionsController
                // echo $this->Form->input('status'); don't need since it will be calculated automatically depending of the payments and price
                echo $this->Form->input('note', ['class' => 'col-md-12']);
                ?>
            </div>
        </div>
        <?php
        echo "<div class='box col-md-4'>";
            echo "<h4>Price</h4>";
            echo "<p class='help-block'>Please fill the total price for all participants</p>";
            echo $this->Form->input('price', ['ng-model' => 'action.price']);
            echo $this->Form->input('currency');
            echo $this->Form->checkbox('private');
            echo " Private";
        echo "<div class='clearfix'>&nbsp;</div></div";
        ?>
    </fieldset>



    <hr><hr>
    <div class="debug PUT_hidden">
        <?php
        echo $this->Form->input('start_name');
//        echo $this->Form->input('start_date', ['ng-model' => 'action.start_date']);
        echo $this->Form->input('start_lng');
        echo $this->Form->input('start_lat');
        echo $this->Form->input('end_name');
//        echo $this->Form->input('end_date', ['ng-model' => 'action.end_date']);
        echo $this->Form->input('end_lng');
        echo $this->Form->input('end_lat');
        ?>
    </div>
    <hr><hr>

    <?= $this->Form->button(__('Submit Action'),
        [
            'class' => 'btn btn-lg btn-primary pull-right',
            'ng-click' => 'updateStatus('.$action->id.')'
        ]
    ) ?>
    <?= $this->Form->end() ?>
</div>




