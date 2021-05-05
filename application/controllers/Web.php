<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Maindb');
        $this->load->library(array('form_validation', 'user_agent', 'session'));
        $this->load->helper('form', 'url');
    }

    public function index() {
        $this->load->view('header');
        $data['events'] = $this->Maindb->get_events();
        $data['err_msg'] = $this->session->flashdata('msg');
        $data['success_msg'] = $this->session->flashdata('success_msg');
        $this->load->view('add_event', $data);
        $this->load->view('footer');
    }

    public function save_event() {
        $this->form_validation->set_rules('event_name', 'Event Title', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('repeat_type', 'Recurrence', 'required');
        $this->form_validation->set_rules('event_name', 'Event Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', 'Required Fields are Mandatory');
            redirect(base_url());
        } else {
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $repeat_type = $this->input->post('repeat_type');
            $repeat_by_every = $this->input->post('repeat_by_every');
            $repeat_by_day = $this->input->post('repeat_by_day');
            $repeat_by_number = $this->input->post('repeat_by_number');
            $repeat_by_weekdays = $this->input->post('repeat_by_weekdays');
            $repeat_by_duration = $this->input->post('repeat_by_duration');
            $to_date = strtotime($start_date);
            $from_date = strtotime($end_date);
            if ($to_date >= $from_date) {
                $this->session->set_flashdata('msg', 'End Date must be a date after Start Date');
                redirect(base_url());
            } else {
                $array = [
                    'event_name' => $this->input->post('event_name'),
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'repeat_type' => $repeat_type,
                    'repeat_by_every' => $repeat_by_every,
                    'repeat_by_day' => $repeat_by_day,
                    'repeat_by_number' => $repeat_by_number,
                    'repeat_by_weekdays' => $repeat_by_weekdays,
                    'repeat_by_duration' => $repeat_by_duration,
                ];
                $qry = $this->Maindb->insert('event_list', $array);
                if ($qry > 0) {
                    if ($repeat_type == "Repeat_By_Days") {
                        $duration = 0;
                        if ($repeat_by_every == 'Every') {
                            $duration = 1;
                        } elseif ($repeat_by_every == 'Every Other') {
                            $duration = 2;
                        } elseif ($repeat_by_every == 'Every Third') {
                            $duration = 3;
                        } else {
                            $duration = 4;
                        }
                        $duration_type = '';
                        if ($repeat_by_day == "Day") {
                            $duration_type = ' days';
                        } elseif ($repeat_by_day == "Week") {
                            $duration_type = ' weeks';
                        } elseif ($repeat_by_day == "Month") {
                            $duration_type = ' months';
                        } else {
                            $duration_type = ' years';
                        }
                        $dates = array();
                        $add_days = "+" . $duration . $duration_type;
                        $curr_date = $to_date;
                        while ($curr_date <= $from_date) {
//                            $dates[] = date('Y-m-d', $curr_date);
                            $insert_date = [
                                'event_list_id' => $qry,
                                'event_date' => date('Y-m-d', $curr_date),
                                'event_day' => date('l', $curr_date),
                            ];
                            $this->Maindb->insert('event_dates', $insert_date);
                            $curr_date = strtotime($add_days, $curr_date);
                        }
//                        var_dump($dates); // Dates Of Repeat By Every Day
                    } else {
                        if ($repeat_by_duration == "Month") {
                            $add_days = '1 month';
                        } elseif ($repeat_by_duration == "3 Months") {
                            $add_days = '+3 months';
                        } elseif ($repeat_by_duration == "4 Months") {
                            $add_days = '+4 months';
                        } elseif ($repeat_by_duration == "6 Months") {
                            $add_days = '+6 months';
                        } else {
                            $add_days = '+1 year';
                        }
                        $dates = array();
                        $curr_date = $to_date;
                        $rule = '';
                        $rule = $repeat_by_number . ' ' . $repeat_by_weekdays . ' ';
                        while ($curr_date <= $from_date) {
                            $dates[] = date('Y-m-d', strtotime($rule . date('Y-m', $curr_date)));
                            $insert_date = [
                                'event_list_id' => $qry,
                                'event_date' => date('Y-m-d', strtotime($rule . date('Y-m', $curr_date))),
                                'event_day' => date('l', strtotime($rule . date('Y-m', $curr_date))),
                            ];
                            $this->Maindb->insert('event_dates', $insert_date);
                            $curr_date = strtotime($add_days, $curr_date);
                        }
//                        var_dump($dates); // Dates Of Repeat on the First Sunday of the Year
                    }
                    $this->session->set_flashdata('success_msg', 'Event Added Successfully');
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('msg', 'Error Occurred! Try Again!!');
                    redirect(base_url());
                }
            }
        }
    }

    public function view_event($event_id) {
        $chk = $this->Maindb->check_event($event_id);
        if ($chk > 0) {
            $data['event'] = $this->Maindb->get_event_detail($event_id);
            $data['edates'] = $this->Maindb->get_event_dates($event_id);
            $this->load->view('view_event', $data);
        } else {
            echo 'No Record Found';
        }
    }

    public function edit_event($event_id) {
        $chk = $this->Maindb->check_event($event_id);
        if ($chk > 0) {
            $data['event'] = $this->Maindb->get_event_detail($event_id);
            $this->load->view('edit_event', $data);
        } else {
            echo 'No Record Found';
        }
    }

    public function update_event($event_id) {
        $this->form_validation->set_rules('event_name', 'Event Title', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('repeat_type', 'Recurrence', 'required');
        $this->form_validation->set_rules('event_name', 'Event Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', 'Required Fields are Mandatory');
            redirect(base_url());
        } else {
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $repeat_type = $this->input->post('repeat_type');
            $repeat_by_every = $this->input->post('repeat_by_every');
            $repeat_by_day = $this->input->post('repeat_by_day');
            $repeat_by_number = $this->input->post('repeat_by_number');
            $repeat_by_weekdays = $this->input->post('repeat_by_weekdays');
            $repeat_by_duration = $this->input->post('repeat_by_duration');
            $to_date = strtotime($start_date);
            $from_date = strtotime($end_date);
            if ($to_date >= $from_date) {
                $this->session->set_flashdata('msg', 'End Date must be a date after Start Date');
                redirect(base_url());
            } else {

                $array = [
                    'event_name' => $this->input->post('event_name'),
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'repeat_type' => $repeat_type,
                    'repeat_by_every' => $repeat_by_every,
                    'repeat_by_day' => $repeat_by_day,
                    'repeat_by_number' => $repeat_by_number,
                    'repeat_by_weekdays' => $repeat_by_weekdays,
                    'repeat_by_duration' => $repeat_by_duration,
                ];
                $qry = $this->Maindb->update('event_list', ['event_list_id' => $event_id], $array);
                if ($qry > 0) {
                    $qry = $this->Maindb->delete('event_dates', ['event_list_id' => $event_id]);
                    if ($repeat_type == "Repeat_By_Days") {
                        $duration = 0;
                        if ($repeat_by_every == 'Every') {
                            $duration = 1;
                        } elseif ($repeat_by_every == 'Every Other') {
                            $duration = 2;
                        } elseif ($repeat_by_every == 'Every Third') {
                            $duration = 3;
                        } else {
                            $duration = 4;
                        }
                        $duration_type = '';
                        if ($repeat_by_day == "Day") {
                            $duration_type = ' days';
                        } elseif ($repeat_by_day == "Week") {
                            $duration_type = ' weeks';
                        } elseif ($repeat_by_day == "Month") {
                            $duration_type = ' months';
                        } else {
                            $duration_type = ' years';
                        }
                        $dates = array();
                        $add_days = "+" . $duration . $duration_type;
                        $curr_date = $to_date;
                        while ($curr_date <= $from_date) {
//                            $dates[] = date('Y-m-d', $curr_date);
                            $insert_date = [
                                'event_list_id' => $event_id,
                                'event_date' => date('Y-m-d', $curr_date),
                                'event_day' => date('l', $curr_date),
                            ];
                            $this->Maindb->insert('event_dates', $insert_date);
                            $curr_date = strtotime($add_days, $curr_date);
                        }
//                        var_dump($dates); // Dates Of Repeat By Every Day
                    } else {
                        if ($repeat_by_duration == "Month") {
                            $add_days = '1 month';
                        } elseif ($repeat_by_duration == "3 Months") {
                            $add_days = '+3 months';
                        } elseif ($repeat_by_duration == "4 Months") {
                            $add_days = '+4 months';
                        } elseif ($repeat_by_duration == "6 Months") {
                            $add_days = '+6 months';
                        } else {
                            $add_days = '+1 year';
                        }
                        $dates = array();
                        $curr_date = $to_date;
                        $rule = '';
                        $rule = $repeat_by_number . ' ' . $repeat_by_weekdays . ' ';
                        while ($curr_date <= $from_date) {
                            $dates[] = date('Y-m-d', strtotime($rule . date('Y-m', $curr_date)));
                            $insert_date = [
                                'event_list_id' => $event_id,
                                'event_date' => date('Y-m-d', strtotime($rule . date('Y-m', $curr_date))),
                                'event_day' => date('l', strtotime($rule . date('Y-m', $curr_date))),
                            ];
                            $this->Maindb->insert('event_dates', $insert_date);
                            $curr_date = strtotime($add_days, $curr_date);
                        }
//                        var_dump($dates); // Dates Of Repeat on the First Sunday of the Year
                    }
                    $this->session->set_flashdata('success_msg', 'Event Updated Successfully');
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('msg', 'Error Occurred! Try Again!!');
                    redirect(base_url());
                }
            }
        }
    }

    function delete_event($event_id) {
        $chk = $this->Maindb->check_event($event_id);
        if ($chk > 0) {
            $qry = $this->Maindb->delete('event_dates', ['event_list_id' => $event_id]);
            if ($qry) {
                $qry2 = $this->Maindb->delete('event_list', ['event_list_id' => $event_id]);
                if ($qry2) {
                    $this->session->set_flashdata('success_msg', 'Entry Deleted Successfully');
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('msg', 'Error Occurred! Try Again!!');
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('msg', 'Error Occurred! Try Again!!');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('msg', 'Error Occurred! Try Again!!');
            redirect(base_url());
        }
    }

}
