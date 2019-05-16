<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['css'] = $this->html_lib->get_css();
        $this->data['javascript'] = $this->html_lib->get_javascript();
        $this->data['CI'] = & get_instance();

        $this->meta = array('title' => 'Usuário',
            'description' => 'Usuário',
            'keywords' => 'Usuário'
        );
    }

    public function index() {
        if ($this->user->validate_session()) {
            redirect('users/dashboard', 'refresh');
        }

        $this->load->view('admin/index');
    }

    public function login() {
        $postData = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        if ($this->user->login($postData) == TRUE) {
            $this->user->update_last_login();
            redirect(base_url('users/dashboard'), 'refresh');
        } else {
            redirect(base_url('users/index/?signinError=true'), 'refresh');
        }
    }

    public function signup() {
        $this->form_validation->set_rules('name', 'email', 'password', 'required');
        $this->load->view('admin/signup');
    }

    public function createClient() {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'created_at' => date("Y-m-d H:i:s")
        );

        if ($this->user_manager->save_user($data)) {
            $postData = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );

            if ($this->user->login($postData) == TRUE) {
                $this->user->update_last_login();
                redirect(base_url('users/dashboard?created=true'), 'refresh');
            } else {
                redirect(base_url('users/signup?createdError=true'), 'refresh');
            }
        } else {
            redirect(base_url('users/signup?createdError=true'), 'refresh');
        }
    }

    public function dashboard() {
        if (!$this->user->validate_session()) {
            redirect('users', 'refresh');
        }

        $this->data['userData'] = $this->user->user_data;
        $this->data['header'] = $this->load->view('admin/users/header', $this->data, true);
        $this->data['menu'] = $this->load->view('admin/users/menu', $this->data, true);
        $this->data['footer'] = $this->load->view('admin/users/footer', $this->data, true);

        $productsArray = $this->curl->requestApi("", "products", $this->data['userData']->key);

        $today = date("Y-m-d");
        $yesterday = date("Y-m-d", strtotime("-1 day", strtotime($today)));
        $lastWeek = date("Y-m-d", strtotime("-7 day", strtotime($today)));

        $countYesterday = 0;
        $countLastWeek = 0;
        $totalPrice = 0.00;
        $totalLastWeek = 0.00;
        if (!empty($productsArray)) {
            foreach ($productsArray as $product) {
                $createdAt = date("Y-m-d", strtotime($product->created_at));
                if ($createdAt == $yesterday) {
                    $countYesterday++;
                }
                if ($createdAt >= $lastWeek) {
                    $countLastWeek++;
                    $totalLastWeek = $totalLastWeek + $product->price;
                }
                $totalPrice = $totalPrice + $product->price;
            }
        }

        $this->data['totalProducts'] = !(empty($productsArray)) ? count($productsArray) : 0;
        $this->data['countLastWeek'] = $countLastWeek;
        $this->data['countYesterday'] = $countYesterday;
        $this->data['totalPrice'] = $totalPrice;
        $this->data['totalLastWeek'] = $totalLastWeek;

        $this->load->view('admin/users/dashboard', $this->data);
    }

    public function user_key() {
        if (!$this->user->validate_session()) {
            redirect('users', 'refresh');
        }
        $this->data['userData'] = $this->user->user_data;
        $this->data['header'] = $this->load->view('admin/users/header', $this->data, true);
        $this->data['menu'] = $this->load->view('admin/users/menu', $this->data, true);
        $this->data['footer'] = $this->load->view('admin/users/footer', $this->data, true);
        $this->load->view('admin/users/user_key', $this->data);
    }

    public function logout() {
        $this->user->destroy_user();
        redirect('users ', 302);
    }

}
