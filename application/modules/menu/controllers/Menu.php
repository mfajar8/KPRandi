<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Menu extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Menu_model');
            $this->load->library('form_validation');
	    $method=$this->router->fetch_method();
            // if($method != 'ajax_list'){
            //   if($this->session->userdata('status')!='login'){
            //     redirect(base_url('login'));
            //   }
            // }
        }

        public function index()
        {$datamenu=$this->Menu_model->get_all();//panggil ke modell
          $datafield=$this->Menu_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'menu/menu/menu_list',
             'sidebar'=>'menu/sidebar',
             'css'=>'menu/menu/css',
             'js'=>'menu/menu/js',
             'datamenu'=>$datamenu,
             'datafield'=>$datafield,
             'module'=>'menu',
             'titlePage'=>'menu',
             'controller'=>'menu'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->Menu_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $Menu_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $Menu_model->nama_makanan;
							$row[] = $Menu_model->harga;
							$row[] = $Menu_model->gambar;
							$row[] = $Menu_model->tipe;
							
              $row[] ="
              <a href='menu/edit/$Menu_model->id_makanan'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$Menu_model->id_makanan' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->Menu_model->count_all(),
                          "recordsFiltered" => $this->Menu_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'menu/menu/menu_create',
             'sidebar'=>'menu/sidebar',
             'action'=>'menu/menu/create_action',
             'module'=>'menu',
             'titlePage'=>'menu',
             'controller'=>'menu'
            );
          $this->template->load($data);
        }

        public function edit($id_makanan){
          $dataedit=$this->Menu_model->get_by_id($id_makanan);
           $data = array(
             'content'=>'menu/menu/menu_edit',
             'sidebar'=>'menu/sidebar',
             'action'=>'menu/menu/update_action',
             'dataedit'=>$dataedit,
             'module'=>'menu',
             'titlePage'=>'menu',
             'controller'=>'menu'
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
					'nama_makanan' => $this->input->post('nama_makanan',TRUE),
					'harga' => $this->input->post('harga',TRUE),
					'gambar' => $this->input->post('gambar',TRUE),
					'tipe' => $this->input->post('tipe',TRUE),
					
);

            $this->Menu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menu/menu'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'nama_makanan' => $this->input->post('nama_makanan',TRUE),
					'harga' => $this->input->post('harga',TRUE),
					'gambar' => $this->input->post('gambar',TRUE),
					'tipe' => $this->input->post('tipe',TRUE),
					
);

            $this->Menu_model->update($this->input->post('id_makanan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menu/menu'));
        }
    }

    public function delete($id_makanan)
    {
        $row = $this->Menu_model->get_by_id($id_makanan);

        if ($row) {
            $this->Menu_model->delete($id_makanan);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu/menu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu/menu'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('nama_makanan', 'nama_makanan', 'trim|required');
$this->form_validation->set_rules('harga', 'harga', 'trim|required');
$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
$this->form_validation->set_rules('tipe', 'tipe', 'trim|required');


	$this->form_validation->set_rules('id_makanan', 'id_makanan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}