<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->user->validate_session()) {
            redirect('users', 'refresh');
        }

        $this->meta = array('title' => 'Produtos',
            'description' => 'Produtos',
            'keywords' => 'Produtos'
        );

        $this->data['css'] = $this->html_lib->get_css();
        $this->data['javascript'] = $this->html_lib->get_javascript();
        $this->data['CI'] = & get_instance();
        $this->data['userData'] = $this->user->user_data;
    }

    public function list_products($pageBegin = 1, $perPage = 500, $sortBy = "created_at", $sortOrder = "desc", $productId = "") {

        $this->data['header'] = $this->load->view('admin/users/header', $this->data, true);
        $this->data['menu'] = $this->load->view('admin/users/menu', $this->data, true);
        $this->data['footer'] = $this->load->view('admin/users/footer', $this->data, true);

        $arrayGetProduct = urlencode("page=$pageBegin&per_page=$perPage&sort_by=$sortBy&sort_order=$sortOrder&product_id=$productId");
        $products = $this->curl->requestApi($arrayGetProduct, "products", $this->data['userData']->key);

        if (isset($products->header) && $products->header == 400) {
            $this->data['listProductsArray'] = "";
        } else {
            $this->data['listProductsArray'] = $products;
        }

        $this->load->view('admin/products/list_products', $this->data);
    }

    public function create_product() {
        $this->form_validation->set_rules('product_name', 'price');
        $this->data['header'] = $this->load->view('admin/users/header', $this->data, true);
        $this->data['menu'] = $this->load->view('admin/users/menu', $this->data, true);
        $this->data['footer'] = $this->load->view('admin/users/footer', $this->data, true);

        $this->load->view('admin/products/create_product', $this->data);
    }

    public function edit_product($productId) {
        $this->data['header'] = $this->load->view('admin/users/header', $this->data, true);
        $this->data['menu'] = $this->load->view('admin/users/menu', $this->data, true);
        $this->data['footer'] = $this->load->view('admin/users/footer', $this->data, true);

        $arrayGetProduct = "product_id=$productId";

        $product = $this->curl->requestApi($arrayGetProduct, "products", $this->data['userData']->key);

        if (isset($product->header) && $product->header == 400) {
            $this->data['productArray'] = "";
        } else {
            $this->data['productArray'] = $product;
        }
        $this->load->view('admin/products/edit_product', $this->data);
    }

    public function post_information_product() {

        if (!empty($this->input->post('product_name')) && !empty($this->input->post('price'))) {
            $data = ['product_name' => $this->input->post('product_name'), 'price' => $this->convert_lib->currencyToDouble($this->input->post('price'))];

            $product = $this->curl->requestApi($data, "products", $this->data['userData']->key, "POST");

            if ($product->header == 200) {
                redirect(base_url('products/list_products?product_created=true'), 'refresh');
            } else {
                redirect(base_url('products/list_products?product_create_error=true'), 'refresh');
            }
        } else {
            redirect(base_url('products/list_products?product_create_error=true'), 'refresh');
        }
    }

    public function put_information_product() {

        $data = [
            'id_product' => $this->input->post('product_id'),
            'product_name' => $this->input->post('product_name'),
            'price' => $this->input->post('price')
        ];

        $product = $this->curl->requestApi($data, "products", $this->data['userData']->key, "PUT");

        if ($product->header == 200) {
            redirect(base_url('products/list_products?product_updated=true'), 'refresh');
        } else {
            redirect(base_url('products/list_products?product_update_error=true'), 'refresh');
        }
    }

    public function delete_information_product() {

        $arrayDeleteProduct = $this->input->post('product_id');

        $product = $this->curl->requestApi($arrayDeleteProduct, "products", $this->data['userData']->key, "DELETE");

        if ($product->header == 200) {
            redirect(base_url('products/list_products?product_deleted=true'), 'refresh');
        } else {
            redirect(base_url('products/list_products?product_delete_error=true'), 'refresh');
        }
    }

}
