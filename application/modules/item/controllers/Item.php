<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Item extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Item_model');
            $this->load->library('form_validation');
	    $method=$this->router->fetch_method();
            // if($method != 'ajax_list'){
            //   if($this->session->userdata('status')!='login'){
            //     redirect(base_url('login'));
            //   }
            // }
        }

        public function index()
        {$dataitem=$this->Item_model->get_all();//panggil ke modell
          $datafield=$this->Item_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'item/item/item_list',
             'sidebar'=>'item/sidebar',
             'css'=>'item/item/css',
             'js'=>'item/item/js',
             'dataitem'=>$dataitem,
             'datafield'=>$datafield,
             'module'=>'item',
             'titlePage'=>'item',
             'controller'=>'item'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->Item_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $Item_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $Item_model->id_menu;
							$row[] = $Item_model->qty;
							
              $row[] ="
              <a href='item/edit/$Item_model->id_item'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$Item_model->id_item' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->Item_model->count_all(),
                          "recordsFiltered" => $this->Item_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'item/item/item_create',
             'sidebar'=>'item/sidebar',
             'action'=>'item/item/create_action',
             'module'=>'item',
             'titlePage'=>'item',
             'controller'=>'item'
            );
          $this->template->load($data);
        }

        public function edit($id_item){
          $dataedit=$this->Item_model->get_by_id($id_item);
           $data = array(
             'content'=>'item/item/item_edit',
             'sidebar'=>'item/sidebar',
             'action'=>'item/item/update_action',
             'dataedit'=>$dataedit,
             'module'=>'item',
             'titlePage'=>'item',
             'controller'=>'item'
            );
          $this->template->load($data);
        }
public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
					'id_menu' => $this->input->post('id_menu',TRUE),
					'qty' => $this->input->post('qty',TRUE),
					
);

            $this->Item_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('item/item'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'id_menu' => $this->input->post('id_menu',TRUE),
					'qty' => $this->input->post('qty',TRUE),
					
);

            $this->Item_model->update($this->input->post('id_item', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('item/item'));
        }
    }

    public function delete($id_item)
    {
        $row = $this->Item_model->get_by_id($id_item);

        if ($row) {
            $this->Item_model->delete($id_item);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('item/item'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('item/item'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('id_menu', 'id_menu', 'trim|required');
$this->form_validation->set_rules('qty', 'qty', 'trim|required');


	$this->form_validation->set_rules('id_item', 'id_item', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}