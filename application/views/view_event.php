<div class="container">
    <div class="row">
        <div class="col-4">
            <label>Event Title : <b><?= $event->event_name ?></b></label>
        </div>
        <div class="col-4">
            <label>Dates : <b><?= $event->start_date ?> to <?= $event->end_date ?></b></label>
        </div>
        <div class="col-4">
            <label>Recurrence : <b><?= $event->repeat_type == "Repeat_By_Days" ? $event->repeat_by_every . ' ' . $event->repeat_by_day : $event->repeat_by_number . ' ' . $event->repeat_by_weekdays . ' of the ' . $event->repeat_by_duration ?></b></label>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h6>Event Dates --<span> Total Recurrence Event : <?= count($edates) ?></span></h6>
        </div>
        <div class="col-12">
            <div class="">
                <table class="table table-bordered table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Day Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($edates as $edate) {
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $edate->event_date ?></td>
                                <td><?= $edate->event_day ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">
                                Total Recurrence Event : 
                            </th>
                            <th><?= count($edates) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>   
</div>

