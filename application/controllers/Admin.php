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

    public function index()
    {
        $data['title'] = "Admin Panel";

        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['dashboard'] = $this->load->view('backend/dashboard', '', true);
        $data['footer'] = $this->load->view('backend/template/footer', '', true);

        $this->load->view('backend/master', $data);

        // $this->load->view('backend/dashboard');
        // $this->load->view('backend/template/footer');
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

        $data['books'] = json_decode($make_call, true);

        $this->load->view('backend/template/header', $data);
        $this->load->view('backend/master');
        $this->load->view('backend/allbooks', $data);
        $this->load->view('backend/template/footer');
    }

    public function create()
    {
        $data['title'] = "Add New Book";

        $this->load->view('backend/template/header', $data);
        $this->load->view('backend/master');
        $this->load->view('backend/addbook');
        $this->load->view('backend/template/footer');
    }

    public function save()
    {
        $userid = 'User-ID:' . $this->session->userdata('id');
        $Authorization = 'Authorization:' . $this->session->userdata('token');

        $url = 'http://localhost/CodeigniterRESTAPI/book/create';

        $book_info = [
            'title' => $this->input->post('title'),
            'author' => $this->input->post('author'),
        ];

        $headers = [
            $userid,
            $Authorization,
            'Client-Service:frontend-client',
            'Auth-Key:simplerestapi',
            'Content-Type:application/x-www-form-urlencoded',
        ];

        $make_call = callAPI('POST', $url, http_build_query($book_info), $headers);

        $response = json_decode($make_call, true);

        if ($response) {
            redirect(base_url('admin/book'));
        }

    }

    public function detail()
    {
        $data['title'] = "Add New Book";

        $userid = 'User-ID:' . $this->session->userdata('id');
        $Authorization = 'Authorization:' . $this->session->userdata('token');

        $id = $this->uri->segment(3);

        $url = 'http://localhost/CodeigniterRESTAPI/book/detail/' . $id;

        $headers = [
            $userid,
            $Authorization,
            'Client-Service:frontend-client',
            'Auth-Key:simplerestapi',
            'Content-Type:application/x-www-form-urlencoded',
        ];

        $make_call = callAPI('GET', $url, false, $headers);

        $data['book'] = json_decode($make_call, true);

        $data['id'] = $id;

        $this->load->view('backend/template/header', $data);
        $this->load->view('backend/master');
        $this->load->view('backend/update', $data);
        $this->load->view('backend/template/footer');

    }

    public function update()
    {
        $data['title'] = "Add New Book";

        $userid = 'User-ID:' . $this->session->userdata('id');
        $Authorization = 'Authorization:' . $this->session->userdata('token');

        $id = $this->uri->segment(3);

        $book_info = [
            'title' => $this->input->post('title'),
            'author' => $this->input->post('author'),
        ];

        $url = 'http://localhost/CodeigniterRESTAPI/book/update/' . $id;

        $headers = [
            $userid,
            $Authorization,
            'Client-Service:frontend-client',
            'Auth-Key:simplerestapi',
            'Content-Type:application/x-www-form-urlencoded',
        ];
        
        $make_call = callAPI('PUT', $url, http_build_query($book_info), $headers);

        $response = json_decode($make_call,true);

        if($response['status']==200){
            redirect(base_url('admin/book'));
        }else{
            echo $response['message'];
        }
        

    }

    public function delete()
    {
        $userid = 'User-ID:' . $this->session->userdata('id');
        $Authorization = 'Authorization:' . $this->session->userdata('token');

        $id = $this->uri->segment(3);

        $url = 'http://localhost/CodeigniterRESTAPI/book/delete/' . $id;

        $headers = [
            $userid,
            $Authorization,
            'Client-Service:frontend-client',
            'Auth-Key:simplerestapi',
            'Content-Type:application/x-www-form-urlencoded',
        ];

        $make_call = callAPI('DELETE', $url, false, $headers);

        $response = json_decode($make_call);

        if ($response) {
            redirect(base_url('admin/book'));
        }

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
                'username',
            );

            $this->session->unset_userdata($session_data);

            return redirect(base_url());
        }

    }
}
