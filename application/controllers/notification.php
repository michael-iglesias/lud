<?php

class Notification extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('Sendgrid');
        $this->load->library('twilio');
        $this->load->model('notification_model');
    }
    
    public function send() {
        $pending_notifications = $this->notification_model->getPendingNotifications();
        
        // Iterate through notifications and send to designated audience
        foreach($pending_notifications as $notification_row) {
            if($notification_row['ncron_notification_type'] == 'general') {
                // Determine whether resident/unit/building/community
                if($notification_row['ncron_target'] == 'resident') {
                    $tenant = $this->notification_model->getTenantNotificationInfo($notification_row['tnt_id']);
                    // If General Email == YES Send email notification
                    if($tenant[0]['general_email'] == 'yes') {
                        $email['type'] = $notification_row['ncron_notification_type'];
                        $email['to'] = $tenant[0]['tnt_email'];
                        $email['subject'] = $notification_row['ncron_subject'];
                        $email['details'] = $notification_row['ncron_body'];
                        $this->sendgrid->send_mail($email);
                    }
                    // If General SMS == YES Send SMS Notification
                    if($tenant[0]['general_sms'] == 'yes') {
                        $from = '9543027665';
                        $to = $tenant[0]['tnt_phone'];
                        $message = $notification_row['ncron_body'];

                        $response = $this->twilio->sms($from, $to, $message);
                        if($response->IsError)
                            echo 'Error: ' . $response->ErrorMessage;
                        else
                            echo 'Sent message to ' . $to;
                    }

                } elseif($notification_row['ncron_target'] == 'community') {
                    // send to the Entire Community
                    $resident_list = $this->notification_model->getTenantList();
                    // Iterate through resident list and send notifications
                    foreach($resident_list as $row) {
                        // If General Email == YES Send email notification
                        if($row['general_email'] == 'yes') {
                            $email['type'] = '';
                            $email['to'] = $row['tnt_email'];
                            $email['subject'] = $notification_row['ncron_subject'];
                            $email['details'] = $notification_row['ncron_body'];
                            $this->sendgrid->send_mail($email);
                        }
                        // If General SMS == YES Send SMS Notification
                        if($row['general_sms'] == 'yes') {
                            $from = '9543027665';
                            $to = $row['tnt_phone'];
                            $message = $notification_row['ncron_body'];

                            $response = $this->twilio->sms($from, $to, $message);
                        }
                    }
                } elseif($notification_row['ncron_target'] == 'unit') {
                    // Send to specified unit
                    $unit_tenants = $this->notification_model->getUnitTenants($notification_row['tun_id']);
                    foreach($unit_tenants as $row) {
                        // If General Email == YES Send email notification
                        if($row['general_email'] == 'yes') {
                            $email['type'] = '';
                            $email['to'] = $row['tnt_email'];
                            $email['subject'] = $notification_row['ncron_subject'];
                            $email['details'] = $notification_row['ncron_body'];
                            $this->sendgrid->send_mail($email);
                        }
                        // If General SMS == YES Send SMS Notification
                        if($row['general_sms'] == 'yes') {
                            $from = '9543027665';
                            $to = $row['tnt_phone'];
                            $message = $notification_row['ncron_body'];

                            $response = $this->twilio->sms($from, $to, $message);
                        }
                    }

                } elseif($notification_row['ncron_target'] == 'building') {
                    // Send to Building
                    $building_tenants = $this->notification_model->getBuildingTenants($notification_row['tow_id']);

                    foreach($building_tenants as $row) {
                        // If General Email == YES Send email notification
                        if($row['general_email'] == 'yes') {
                            $email['type'] = '';
                            $email['to'] = $row['tnt_email'];
                            $email['subject'] = $notification_row['ncron_subject'];
                            $email['details'] = $notification_row['ncron_body'];
                            $this->sendgrid->send_mail($email);
                        }
                        // If General SMS == YES Send SMS Notification
                        if($row['general_sms'] == 'yes') {
                            $from = '9543027665';
                            $to = $row['tnt_phone'];
                            $message = $notification_row['ncron_body'];

                            $response = $this->twilio->sms($from, $to, $message);
                        }
                    }

                } // ***END {if/elseif}
            } elseif ($notification_row['ncron_notification_type'] == 'package_delivery') {
                $tenant = $this->notification_model->getTenantNotificationInfo($notification_row['tnt_id']);
                    // If General Email == YES Send email notification
                    if($tenant[0]['package_email'] == 'yes') {
                        $email['type'] = $notification_row['ncron_notification_type'];
                        $email['to'] = $tenant[0]['tnt_email'];
                        $email['subject'] = $notification_row['ncron_subject'];
                        $email['details'] = $notification_row['ncron_body'];
                        $this->sendgrid->send_mail($email);
                    }
                    // If General SMS == YES Send SMS Notification
                    if($tenant[0]['package_sms'] == 'yes') {
                        $from = '9543027665';
                        $to = $tenant[0]['tnt_phone'];
                        $message = strip_tags( $notification_row['ncron_body'] );
                        
                        $response = $this->twilio->sms($from, $to, $message);
                        if($response->IsError)
                            echo 'Error: ' . $response->ErrorMessage;
                        else
                            echo 'Sent message to ' . $to;
                    }
            }
            
            // Update Notification status to SENT
            $this->notification_model->updateNotificationDelivered($notification_row['ncron_id']);
            
        } // ***END {foreach} $pending_notifications as $row
        echo 'success';
    } // ***END send();
    
}