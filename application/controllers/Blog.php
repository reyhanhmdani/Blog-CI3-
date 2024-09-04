<?php

/**
 * @property $Blog_model
 * @property $upload
 * @property $form_validation
 * @property $pagination
 * @property $session
 */
class Blog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Blog_model');
	}

	public function index($offset = 0)
	{
		// Ubah $offset menjadi integer
		$offset = (ctype_digit((string)$offset)) ? (int)$offset : 0;

		$config['base_url'] = site_url('/');
		$config['total_rows'] = $this->Blog_model->getTotalBlogs();
		$config['per_page'] = 3;
		$this->pagination->initialize($config);

		$query = $this->Blog_model->getBlogs($config['per_page'], $offset);
		$data['blogs'] = $query->result_array();

		$this->load->view('blog', $data);
	}

	public function detail($url)
	{

		$query = $this->Blog_model->getSingleBlog('url', $url);
		$data['blog'] = $query->row_array();

		$this->load->view('detail', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
		$this->form_validation->set_rules('content', 'Content', 'required');

		if ($this->form_validation->run() === TRUE) {
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['url'] = $this->input->post('url');

			// Cek apakah ada file yang diupload
			if (!empty($_FILES['cover']['name'])) {
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 100;
				$config['max_width'] = 1920;
				$config['max_height'] = 1080;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('cover')) {
					// Jika ada error saat upload, tampilkan error
					echo $this->upload->display_errors();
					return; // Stop execution jika ada error pada upload
				} else {
					// Jika berhasil upload, simpan nama file ke dalam array data
					$data['cover'] = $this->upload->data()['file_name'];
				}
			}

			$id = $this->Blog_model->insertBlog($data);

			if ($id) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Data blog baru telah ditambahkan</div>');
				redirect('/blog/index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data blog gagal ditambahkan </div>');
				redirect('/blog/add');
			}
		} else {
			$this->load->view('form_add');
		}
	}

	public function edit($id)
	{
		$query = $this->Blog_model->getSingleBlog('id', $id);
		$data['blog'] = $query->row_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
		$this->form_validation->set_rules('content', 'Content', 'required');

		if ($this->form_validation->run() === TRUE) {
			$post['title'] = $this->input->post('title');
			$post['content'] = $this->input->post('content');
			$post['url'] = $this->input->post('url');

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 1000;
			$config['max_width'] = 1920;
			$config['max_height'] = 1080;

			$this->load->library('upload', $config);
			$this->upload->do_upload('cover');

			if (!empty($this->upload->data()['file_name'])) {
				$post['cover'] = $this->upload->data()['file_name'];
			}

			$id = $this->Blog_model->updateBlog($id, $post);

			if ($id) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Data blog baru telah update</div>');
				redirect('/blog/index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data blog gagal diUpdate </div>');
				redirect('/blog/add');
			}
		} else {
			$this->load->view('form_edit', $data);
		}
	}

	public function delete($id)
	{
		$result = $this->Blog_model->deleteBlog($id);

		if ($result) {
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Data telah dihapus </div>');
			redirect('/blog/index');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data gagal dihapus </div>');
			redirect('/blog/index');
		}
	}


	public function login()
	{
		if ($this->input->post()) {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($username == 'admin' && $password == 'admin') {
				$_SESSION['username'] = 'admin';
				$this->session->set_flashdata('message', '<div class="alert alert-info">Anda Berhasil Login</div>');
				redirect('/blog/index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Username atau Password salah</div>');
			}
		}

		$this->load->view('login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/blog/index');
	}
}


