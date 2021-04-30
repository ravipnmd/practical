<div class="container">
    <div class="row card mt-5 ">
        <div class="col-12 pt-2 text-center">
            <h3>Event Listing</h3>
            <?php if ($err_msg != "") { ?> 
                <div class="alert alert-danger text-center" role="alert"><?= $err_msg ?></div>
            <?php } ?>
            <?php if ($success_msg != "") { ?> 
                <div class="alert alert-success text-center" role="alert"><?= $success_msg ?></div>
            <?php } ?>
        </div>
        <div class="col-12">
            <h5>Add Event</h5>

            <form method="post" action="<?= base_url('Web/save_event') ?>">
                <div class="row mb-1">
                    <div class="col-3">
                        <label>Event Title : </label>
                    </div>
                    <div class="col-4">
                        <input type="text" name="event_name" class="form-control" required/>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3">
                        <label>Start Date : </label>
                    </div>
                    <div class="col-4">
                        <input type="date" name="start_date" class="form-control" required/>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3">
                        <label>End Date : </label>
                    </div>
                    <div class="col-4">
                        <input type="date" name="end_date" class="form-control" required/>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3">
                        <label>Recurrence : </label>
                    </div>
                    <div class="col-2">
                        <input type="radio" name="repeat_type" value="Repeat_By_Days" id="Repeat_By_Days" required />
                        <label for="Repeat_By_Days">Repeat</label>
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_every" class="form-control">
                            <option value="Every">Every</option>
                            <option value="Every Other">Every Other</option>
                            <option value="Every Third">Every Third</option>
                            <option value="Every Fourth">Every Fourth</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_day" class="form-control">
                            <option value="Day">Day</option>
                            <option value="Week">Week</option>
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3">
                    </div>
                    <div class="col-2">
                        <input type="radio" name="repeat_type" value="Repeat_By_Dates" id="Repeat_By_Dates" required/>
                        <label for="Repeat_By_Dates">Repeat on the</label>
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_number" class="form-control">
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                            <option value="Third">Third</option>
                            <option value="Fourth">Fourth</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_weekdays" class="form-control">
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="col-1">
                        of the
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_duration" class="form-control">
                            <option value="Month">Month</option>
                            <option value="3 Months">3 Months</option>
                            <option value="4 Months">4 Months</option>
                            <option value="6 Months">6 Months</option>
                            <option value="Year">Year</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 offset-3">
                        <input type="submit" class="btn btn-info" value="Submit" name="Submit" />
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row card mt-3">
        <div class="col-12 pt-2">
            <h5>Event List</h5>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-striped table-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Dates</th>
                        <th>Occurrence</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event) { ?>
                        <tr>
                            <td><?= $event->event_list_id ?></td>
                            <td><?= $event->event_name ?></td>
                            <td><?= $event->start_date . ' to ' . $event->end_date ?></td>
                            <td><?= $event->repeat_type == "Repeat_By_Days" ? $event->repeat_by_every . ' ' . $event->repeat_by_day : $event->repeat_by_number . ' ' . $event->repeat_by_weekdays . ' of the ' . $event->repeat_by_duration ?></td>
                            <td>
                                <a href="javascript:;" onclick="view_event('<?= $event->event_list_id ?>')" class="btn btn-sm btn-success">View</a>
                                <a href="javascript:;" onclick="edit_event('<?= $event->event_list_id ?>')" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= base_url('Web/delete_event/' . $event->event_list_id) ?>" onclick="return confirm('Are You Sure To Delete This Entry?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

