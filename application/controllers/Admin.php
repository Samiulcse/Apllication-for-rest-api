<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->have_session_user_data() === false) {
            redirect(base_url());
        }

    }

    private function have_session_user_data()
    {
        if ($this->session->has_userdata('username') && $this->session->has_userdata('id')) {
            return true;
        }
    }

    public function book()
    {
        $userid = 'User-ID:' . $this->session->userdata('id');
        $Authorization = 'Authorization:' . $this->session->userdata('token');

        $data['title'] = "All Books";

        $url = 'http://localhost/CodeigniterRESTAPI/book';

        $headers = [
            $userid,
            $Authorization,
            'Client-Service:frontend-client',
            'Auth-Key:simplerestapi',
            'Content-Type:application/x-www-form-urlencoded',
        ];

        $make_call = callAPI('GET', $url, false, $headers);

        $data['books']= json_decode($make_call, true);

        $this->load->view('backend/template/header', $data);
        $this->load->view('backend/master');
        $this->load->view('backend/allbooks',$data);
        $this->load->view('backend/template/footer');
    }


    public function index()
    {
        $data['title'] = "Admin Panel";

        $this->load->view('backend/template/header', $data);
        $this->load->view('backend/master');
        $this->load->view('backend/dashboard');
        $this->load->view('backend/template/footer');
    }


    public function logout()
    {
        $userid = 'User-ID:' . $this->session->userdata('id');
        $Authorization = 'Authorization:' . $this->session->userdata('token');
        $headers = [
            $userid,
            $Authorization,
            'Client-Service:frontend-client',
            'Auth-Key:simplerestapi',
            'Content-Type:application/x-www-form-urlencoded',
        ];

        $url = "http://localhost/CodeigniterRESTAPI/auth/logout/";

        $make_call = callAPI('POST', $url, false, $headers);

        $response = json_decode($make_call, true);

        if ($response['status'] === 200) {

            $session_data = array(
                'id',
                'token',
                'username'
            );

            $this->session->unset_userdata($session_data);

            return redirect(base_url());
        }

    }
}
