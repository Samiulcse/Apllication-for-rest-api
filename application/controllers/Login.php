<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->have_session_user_data()) {
            redirect(base_url('admin'));
        }

    }

    private function have_session_user_data()
    {
        if ($this->session->has_userdata('username') && $this->session->has_userdata('id')) {
            return true;
        }
    }

    public function index()
    {
        $data['title'] = "User Login";

        $this->load->view('backend/login/header', $data);
        $this->load->view('backend/login/login');
        $this->load->view('backend/login/footer');

    }

    public function login_validation()
    {

        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|xss_clean|required',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run()) {

            $user_name = $this->input->post('username');
            $user_pass = $this->input->post('password');

            $data_array = array(
                "username" => $user_name,
                "password" => $user_pass
            );
            $headers = [
                'Client-Service:frontend-client',
                'Auth-Key:simplerestapi',
                'Content-Type:application/x-www-form-urlencoded',
            ];


            $url = "http://localhost/CodeigniterRESTAPI/auth/login/";

            $make_call  = callAPI('POST', $url, http_build_query($data_array), $headers);

            $response = json_decode($make_call, true);

            if ($response) {
                $this->set_session_data_user_info($response,$user_name);
                echo json_encode(['redirect' => base_url('admin')]);
            } else {
                $error_message['login_error'] = "Username or Password didn't match";
                echo json_encode(['error' => $error_message]);
            }

        } else {

            $errors['user_name'] = form_error('user_name') ? form_error('user_name') : '';
            $errors['user_pass'] = form_error('user_pass') ? form_error('user_pass') : '';
            echo json_encode(['error' => $errors]);

        }

    }

    // set session data
    private function set_session_data_user_info($response,$user_name)
    {
        $response['username']=$user_name;
        $this->session->set_userdata($response);
        return true;
    }

}
