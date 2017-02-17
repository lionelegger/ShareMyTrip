<form class="actions form" method="post" accept-charset="utf-8">
    <? use Cake\I18n\Time; ?>
    <fieldset>
        <div class="row">
            <div class="col-md-6 text-center col-md-offset-3">
                <!-- CATEGORY -->
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
                <!-- TYPE_ID -->
                <div class="clearfix">
                    <ul class="btn-group map-icon-btn" name="type_id" id="type-id" ng-model='action.type_id'>
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
                    </ul>
                </div>
            </div>
        </div>
        <!-- START_DATE -->
        <div class="row text-right">
            <div class="col-md-4 col-md-8">
                <?php
                $start_date = '';
                $start_time = '';
                if ($action->start_date) {
                    $start_date = $action->start_date->i18nFormat('yyyy-MM-dd');
                    $start_time = $action->start_date->i18nFormat('HH:mm');
                }
                ?>
                <div class="row">
                    <div class="col-md-7">
                        <div class='input-group' id='datepickerStart'>
                            <input type='text' class='form-control' id='start_date' name='start_date' placeholder='YYYY-MM-DD' value='<?=$start_date?>'/>
                            <span class='input-group-addon'>
                            <span class='glyphicon glyphicon-calendar'></span>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class='input-group' id='timepickerStart'>
                            <input type='text' class='form-control' id='start_time' name='start_time' placeholder='HH:MM' value='<?=$start_time?>'/>
                            <span class='input-group-addon'>
                            <span class='glyphicon glyphicon-time'></span>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END_DATE -->
            <div class="col-md-4 pull-right col-md-8">
                <?php
                $end_date = '';
                $end_time = '';
                if ($action->end_date) {
                    $end_date = $action->end_date->i18nFormat('yyyy-MM-dd');
                    $end_time = $action->end_date->i18nFormat('HH:mm');
                }
                ?>
                <div class="row">
                    <div class="col-md-7">
                        <div class='input-group' id='datepickerEnd'>
                            <input type='text' class='form-control' id='end_date' name='end_date' placeholder='YYYY-MM-DD' value='<?=$end_date?>'/>
                            <span class='input-group-addon'>
                            <span class='glyphicon glyphicon-calendar'></span>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class='input-group' id='timepickerEnd'>
                            <input type='text' class='form-control' id='end_time' name='end_time' placeholder='HH:MM' value='<?=$end_time?>'/>
                            <span class='input-group-addon'>
                            <span class='glyphicon glyphicon-time'></span>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(function () {
                $('#datepickerStart').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#timepickerStart').datetimepicker({
                    format: 'HH:mm'
                });
                $('#datepickerEnd').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false //Important! See issue #1075
                });
                $('#timepickerEnd').datetimepicker({
                    format: 'HH:mm'
                });
                $("#datetimepickerStart").on("dp.change", function (e) {
                    $('#datepickerEnd').data("DateTimePicker").minDate(e.date);
                });
                $("#datepickerEnd").on("dp.change", function (e) {
                    $('#datepickerStart').data("DateTimePicker").maxDate(e.date);
                });
            });
        </script>

        <div class="row">
            <div class="col-md-12">
                <?php include_once("googleMap.ctp"); ?>
            </div>
        </div>

        <div class="clearfix"><br/></div>
        <div class="clearfix"><br/></div>

        <div class="row">
            <div class="col-md-12 form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-sm-1 control-label">Name</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="name" placeholder="Action name" ng-model="action.name">
                    </div>
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-md-4 form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Company</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="company" placeholder="" ng-model="action.company">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Reservation</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="reservation" placeholder="" ng-model="action.reservation">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Identifier</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="identifier" placeholder="" ng-model="action.identifier">
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-md-offset-1 form-horizontal">
                <div class="form-group">
                    <label for="note" class="col-sm-1 control-label">Notes</label>
                    <div class="col-sm-11">
                        <textarea class="form-control" id="note" rows="6" ng-model="action.note"></textarea>
                    </div>
                </div>
            </div>
        </div>






        <?php
/*        echo "<div class='box col-md-4'>";
            echo "<h4>Price</h4>";
            echo "<p class='help-block'>Please fill the total price for all participants</p>";
            echo $this->Form->input('price', ['ng-model' => 'action.price']);
            echo $this->Form->input('currency', ['ng-model' => 'action.currency']);
            echo $this->Form->checkbox('private', ['ng-model' => 'action.private']);
            echo " Private";
        echo "<div class='clearfix'>&nbsp;</div></div";
        */?>
    </fieldset>

    <!--<hr><hr>-->
    <div class="debug hidden">
        <?php
        echo $this->Form->input('start_name', ['ng-model' => 'action.start_name']);
        echo $this->Form->input('start_lng', ['ng-model' => 'action.start_lng']);
        echo $this->Form->input('start_lat', ['ng-model' => 'action.start_lat']);
        echo $this->Form->input('end_name', ['ng-model' => 'action.end_name']);
        echo $this->Form->input('end_lng', ['ng-model' => 'action.end_lng']);
        echo $this->Form->input('end_lat', ['ng-model' => 'action.end_lat']);
        ?>
    </div>

    <?php include_once("participants.ctp"); ?>

</form>




