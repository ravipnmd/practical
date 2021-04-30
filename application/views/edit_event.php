<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="post" action="<?= base_url('Web/update_event/' . $event->event_list_id) ?>">
                <div class="row mb-1">
                    <div class="col-3">
                        <label>Event Title : </label>
                    </div>
                    <div class="col-4">
                        <input type="text" name="event_name" class="form-control" value="<?= $event->event_name ?>" required/>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3">
                        <label>Start Date : </label>
                    </div>
                    <div class="col-4">
                        <input type="date" name="start_date" class="form-control"  value="<?= $event->start_date ?>"  required/>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3">
                        <label>End Date : </label>
                    </div>
                    <div class="col-4">
                        <input type="date" name="end_date" class="form-control"  value="<?= $event->end_date ?>"  required/>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3">
                        <label>Recurrence : </label>
                    </div>
                    <div class="col-2">
                        <input type="radio" name="repeat_type" value="Repeat_By_Days" <?= $event->repeat_type == 'Repeat_By_Days' ? 'checked' : '' ?> id="repeat" required />
                        <label for="repeat">Repeat</label>
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_every" class="form-control">
                            <option value="Every" <?= $event->repeat_by_every == 'Every' ? 'selected' : '' ?>>Every</option>
                            <option value="Every Other"  <?= $event->repeat_by_every == 'Every Other' ? 'selected' : '' ?>>Every Other</option>
                            <option value="Every Third"  <?= $event->repeat_by_every == 'Every Third' ? 'selected' : '' ?>>Every Third</option>
                            <option value="Every Fourth"  <?= $event->repeat_by_every == 'Every Fourth' ? 'selected' : '' ?>>Every Fourth</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_day" class="form-control">
                            <option value="Day" <?= $event->repeat_by_day == 'Day' ? 'selected' : '' ?>>Day</option>
                            <option value="Week" <?= $event->repeat_by_day == 'Week' ? 'selected' : '' ?>>Week</option>
                            <option value="Month" <?= $event->repeat_by_day == 'Month' ? 'selected' : '' ?>>Month</option>
                            <option value="Year" <?= $event->repeat_by_day == 'Year' ? 'selected' : '' ?>>Year</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3">
                    </div>
                    <div class="col-2">
                        <input type="radio" name="repeat_type" value="Repeat_By_Dates" <?= $event->repeat_type == 'Repeat_By_Dates' ? 'checked' : '' ?> id="repeat" required/>
                        <label for="repeat">Repeat on the</label>
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_number" class="form-control">
                            <option value="First" <?= $event->repeat_by_number == 'First' ? 'selected' : '' ?>>First</option>
                            <option value="Second" <?= $event->repeat_by_number == 'Second' ? 'selected' : '' ?>>Second</option>
                            <option value="Third" <?= $event->repeat_by_number == 'Third' ? 'selected' : '' ?>>Third</option>
                            <option value="Fourth" <?= $event->repeat_by_number == 'Fourth' ? 'selected' : '' ?>>Fourth</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_weekdays" class="form-control">
                            <option value="Sunday" <?= $event->repeat_by_weekdays == 'Sunday' ? 'selected' : '' ?>>Sunday</option>
                            <option value="Monday" <?= $event->repeat_by_weekdays == 'Monday' ? 'selected' : '' ?>>Monday</option>
                            <option value="Tuesday" <?= $event->repeat_by_weekdays == 'Tuesday' ? 'selected' : '' ?>>Tuesday</option>
                            <option value="Wednesday" <?= $event->repeat_by_weekdays == 'Wednesday' ? 'selected' : '' ?>>Wednesday</option>
                            <option value="Thursday" <?= $event->repeat_by_weekdays == 'Thursday' ? 'selected' : '' ?>>Thursday</option>
                            <option value="Friday" <?= $event->repeat_by_weekdays == 'Friday' ? 'selected' : '' ?>>Friday</option>
                            <option value="Saturday" <?= $event->repeat_by_weekdays == 'Saturday' ? 'selected' : '' ?>>Saturday</option>
                            <option value="Sunday" <?= $event->repeat_by_weekdays == 'Sunday' ? 'selected' : '' ?>>Sunday</option>
                        </select>
                    </div>
                    <div class="col-1">
                        of the
                    </div>
                    <div class="col-2">
                        <select name="repeat_by_duration" class="form-control">
                            <option value="Month" <?= $event->repeat_by_weekdays == 'Month' ? 'selected' : '' ?>>Month</option>
                            <option value="3 Months" <?= $event->repeat_by_weekdays == '3 Months' ? 'selected' : '' ?>>3 Months</option>
                            <option value="4 Months" <?= $event->repeat_by_weekdays == '4 Months' ? 'selected' : '' ?>>4 Months</option>
                            <option value="6 Months" <?= $event->repeat_by_weekdays == '6 Months' ? 'selected' : '' ?>>6 Months</option>
                            <option value="Year" <?= $event->repeat_by_weekdays == 'Year' ? 'selected' : '' ?>>Year</option>
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

</div>

