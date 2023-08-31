<?php

class Profile extends MY_Controller{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_profile');
    }
    public function index()
    {
        $this->form_validation->set_rules('name','Name','required');

        if($this->form_validation->run() != false){
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $ins_arr = array(
                'name' =>$name,
                'email' =>$email,
                'subject' =>$subject,
                'message' =>$message
            );

            $this->M_profile->insert($ins_arr);

            //Email
            $htm="<!DOCTYPE html>
            <html lang='en'>
            <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Contact Message</title>
            </head>
            <body>
              <p>Name : $name</p>
              <p>Email : $email</p>
              <p>Subject : $subject</p>
              <p>Message : $message</p>
            </body>
            </html>";
            $this->load->library('email');
            $config['charset'] = 'utf-8';
            $this->email->initialize($config);
            $this->email->from('ahammedshamseer666@gmail.com', 'Shamseer');
            $this->email->to('shamseertt29@gmail.com');
            $this->email->subject("A new contact message from $name");
            $this->email->message($htm);
            if(! $this->email->send()){
                echo $this->email->print_debugger(); die;
            }

            $this->session->set_flashdata('success','Your message saved successfully! Thank you.');

            redirect(base_url('#contact'));
        }
        $this->load->view('frontend/index');
    }
}