<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Pesanan extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Pesanan_model');
            $this->load->library('form_validation');
	    $method=$this->router->fetch_method();
            // if($method != 'ajax_list'){
            //   if($this->session->userdata('status')!='login'){
            //     redirect(base_url('login'));
            //   }
            // }
        }

        public function index()
        {$datapesanan=$this->Pesanan_model->get_all();//panggil ke modell
          $datafield=$this->Pesanan_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'pesanan/pesanan/pesanan_list',
             'sidebar'=>'pesanan/sidebar',
             'css'=>'pesanan/pesanan/css',
             'js'=>'pesanan/pesanan/js',
             'datapesanan'=>$datapesanan,
             'datafield'=>$datafield,
             'module'=>'pesanan',
             'titlePage'=>'pesanan',
             'controller'=>'pesanan'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->Pesanan_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $Pesanan_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $Pesanan_model->id_item;
							$row[] = $Pesanan_model->nama_pemesan;
							$row[] = $Pesanan_model->tanggal_pesan;
							
              $row[] ="
              <a href='pesanan/edit/$Pesanan_model->id_pesanan'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$Pesanan_model->id_pesanan' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->Pesanan_model->count_all(),
                          "recordsFiltered" => $this->Pesanan_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'pesanan/pesanan/pesanan_create',
             'sidebar'=>'pesanan/sidebar',
             'action'=>'pesanan/pesanan/create_action',
             'module'=>'pesanan',
             'titlePage'=>'pesanan',
             'controller'=>'pesanan'
            );
          $this->template->load($data);
        }

        public function edit($id_pesanan){
          $dataedit=$this->Pesanan_model->get_by_id($id_pesanan);
           $data = array(
             'content'=>'pesanan/pesanan/pesanan_edit',
             'sidebar'=>'pesanan/sidebar',
             'action'=>'pesanan/pesanan/update_action',
             'dataedit'=>$dataedit,
             'module'=>'pesanan',
             'titlePage'=>'pesanan',
             'controller'=>'pesanan'
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
					'id_item' => $this->input->post('id_item',TRUE),
					'nama_pemesan' => $this->input->post('nama_pemesan',TRUE),
					'tanggal_pesan' => $this->input->post('tanggal_pesan',TRUE),
					
);

            $this->Pesanan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pesanan/pesanan'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'id_item' => $this->input->post('id_item',TRUE),
					'nama_pemesan' => $this->input->post('nama_pemesan',TRUE),
					'tanggal_pesan' => $this->input->post('tanggal_pesan',TRUE),
					
);

            $this->Pesanan_model->update($this->input->post('id_pesanan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pesanan/pesanan'));
        }
    }

    public function delete($id_pesanan)
    {
        $row = $this->Pesanan_model->get_by_id($id_pesanan);

        if ($row) {
            $this->Pesanan_model->delete($id_pesanan);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pesanan/pesanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pesanan/pesanan'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('id_item', 'id_item', 'trim|required');
$this->form_validation->set_rules('nama_pemesan', 'nama_pemesan', 'trim|required');
$this->form_validation->set_rules('tanggal_pesan', 'tanggal_pesan', 'trim|required');


	$this->form_validation->set_rules('id_pesanan', 'id_pesanan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}