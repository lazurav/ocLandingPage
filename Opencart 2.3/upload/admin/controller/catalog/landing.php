<?php
class ControllerCatalogLanding extends Controller {

	private $error = array();


	public function index() {

		$this->load->language('catalog/landing');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/landing');
		$this->getList();
	}


	public function add(){

		$this->load->language('catalog/landing');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/landing');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_catalog_landing->addLanding($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('catalog/landing', 'token=' . $this->session->data['token'], true));
		}

		$this->getForm();
	}


	public function edit() {

		$this->load->language('catalog/landing');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/landing');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm($this->request->get['landing_id'])) {

			$this->model_catalog_landing->editLanding($this->request->get['landing_id'],$this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('catalog/landing', 'token=' . $this->session->data['token'], true));
		}

		$this->getForm();
	}


	public function copy(){

		$this->load->model('catalog/landing');
		
		if (isset($this->request->post['selected'])) {

			foreach ($this->request->post['selected'] as $landing_id) {

				$data['landing'] = $this->model_catalog_landing->getLanding($landing_id);
				
				$data['landing'] = array(
					'name' 		=> $data['landing']['name'] . '-COPY',
					'url_param' => '',
					'status' 	=> '0'
				);

				$data['landing_description'] = $this->model_catalog_landing->getLandingDescription($landing_id);

				$this->model_catalog_landing->addLanding($data);
				
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			$this->response->redirect($this->url->link('catalog/landing', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}


	public function delete(){

		$this->load->model('catalog/landing');	
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {

			foreach ($this->request->post['selected'] as $landing_id) {
				$this->model_catalog_landing->deleteLanding($landing_id);
				
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			$this->response->redirect($this->url->link('catalog/landing', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}


	public function getList(){

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/landing', 'token=' . $this->session->data['token'] . $url, true)
		);


		$data['add'] = $this->url->link('catalog/landing/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['copy'] = $this->url->link('catalog/landing/copy', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('catalog/landing/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['action'] = $this->url->link('catalog/landing', 'token=' . $this->session->data['token'], true);
    	$data['cancel'] = $this->url->link('catalog/landing', 'token=' . $this->session->data['token'], true);

    	$data['token'] = $this->session->data['token'];

		$data['landings'] = array();

		$filter_data = array(
			'sort'   => $sort,
			'order'  => $order,
			'start'  => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'  => $this->config->get('config_limit_admin'),
		);

		$landing_total = $this->model_catalog_landing->getTotalLandings();

		//Обращается к методу getLandings и разбираем результат

		$landings = $this->model_catalog_landing->getLandings($filter_data);
		
		foreach ($landings as $landing) {
			$data['landings'][] = array(
				'landing_id' 	=> $landing['landing_id'],
				'name' 			=> $landing['name'],
				'url_param' 	=> urldecode($landing['url_param']),
				'status' 		=> $landing['status'],
				'edit'  		=> $this->url->link('catalog/landing/edit', 'token=' . $this->session->data['token'] . '&landing_id=' . $landing['landing_id'] . $url, true)
			);	
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_success'] = $this->language->get('text_success');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_signup'] = $this->language->get('text_signup'); 
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_edit'] = $this->language->get('button_edit');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_url_param'] = $this->language->get('column_url_param');
		$data['column_status'] = $this->language->get('column_status'); 
		$data['column_action'] = $this->language->get('column_action');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/landing', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_url_param'] = $this->url->link('catalog/landing', 'token=' . $this->session->data['token'] . '&sort=url_param' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

    	$pagination = new Pagination();
		$pagination->total = $landing_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/landing', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($landing_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($landing_total - $this->config->get('config_limit_admin'))) ? $landing_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $landing_total, ceil($landing_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

	    $data['header'] = $this->load->controller('common/header');
	    $data['column_left'] = $this->load->controller('common/column_left');
	    $data['footer'] = $this->load->controller('common/footer');
	    
	    $this->response->setOutput($this->load->view('catalog/landing_list', $data));
  }


  protected function getForm() {

  		 //CKEditor
	    if ($this->config->get('config_editor_default')) {
	        $this->document->addScript('view/javascript/ckeditor/ckeditor.js');
	        $this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
	    } else {
	        $this->document->addScript('view/javascript/summernote/summernote.js');
	        $this->document->addScript('view/javascript/summernote/lang/summernote-' . $this->language->get('lang') . '.js');
	        $this->document->addScript('view/javascript/summernote/opencart.js');
	        $this->document->addStyle('view/javascript/summernote/summernote.css');
	    }

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_success'] = $this->language->get('text_success');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_form'] = $this->language->get('text_form');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_url_param'] = $this->language->get('text_url_param');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_signup'] = $this->language->get('text_signup');
		$data['text_help_url_param'] = $this->language->get('text_help_url_param');
		$data['text_help_title'] = $this->language->get('text_help_title');

		$data['entry_url_param'] = $this->language->get('entry_url_param');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_h1'] = $this->language->get('entry_meta_h1');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['error_url_param'])) {
			$data['error_url_param'] = $this->error['error_url_param'];
		} else {
			$data['error_url_param'] = '';
		}

		if (isset($this->error['error_name'])) {
			$data['error_name'] = $this->error['error_name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['error_meta_title'])) {
			$data['error_meta_title'] = $this->error['error_meta_title'];
		} else {
			$data['error_meta_title'] = '';
		}

		$url = '';

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/landing', 'token=' . $this->session->data['token'], true)
		);

		$url='';

		if (!isset($this->request->get['landing_id'])) {
			$data['action'] = $this->url->link('catalog/landing/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/landing/edit', 'token=' . $this->session->data['token'] . '&landing_id=' . $this->request->get['landing_id'] . $url, true);
		}

		if (isset($this->request->post['landing'])) {
			$data['landing'] = $this->request->post['landing'];
		} elseif (isset($this->request->get['landing_id'])) {
			$data['landing'] = $this->model_catalog_landing->getLanding($this->request->get['landing_id']);
			$data['landing']['url_param'] = urldecode($data['landing']['url_param']);
		} else {
			$data['landing'] = array(
				'status' => TRUE
			);
		}

		if (isset($this->request->post['landing_description'])) {
			$data['landing_description'] = $this->request->post['landing_description'];
		} elseif (isset($this->request->get['landing_id'])) {
			$data['landing_description'] = $this->model_catalog_landing->getLandingDescription($this->request->get['landing_id']);
		} else {
			$data['landing_description'] = array();
		}

		$this->load->model('localisation/language');

		$data['cancel'] = $this->url->link('catalog/landing', 'token=' . $this->session->data['token'] . $url, true);
		$data['token'] = $this->session->data['token'];
		$data['ckeditor'] = $this->config->get('config_editor_default');

		$data['languages'] = $this->model_localisation_language->getLanguages();
		$data['lang'] = $this->language->get('lang');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/landing_form', $data));
	}


	 protected function validateForm($landing_id = '0') {

		if (!$this->user->hasPermission('modify', 'catalog/landing')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['landing']['url_param']) && ((utf8_strlen($this->request->post['landing']['url_param']) < 2) || ($this->request->post['landing']['url_param']{0} != '/' ))) {
			$this->error['error_url_param'] = $this->language->get('error_url_param');
		}

		if (isset($this->request->post['landing']['url_param']) && ($this->model_catalog_landing->countLandingByUrl(htmlspecialchars_decode($this->request->post['landing']['url_param']), $landing_id) > 0)) {
			$this->error['error_url_param'] = $this->language->get('error_url_unique');
		}

		if (isset($this->request->post['landing']['name']) && (utf8_strlen($this->request->post['landing']['name']) < 1)) {
			$this->error['error_name'] = $this->language->get('error_name');
		}

		foreach ($this->request->post['landing_description'] as $language_id => $value) {
			if ((utf8_strlen($value['meta_title']) < 10) || (utf8_strlen($value['meta_title']) > 150)) {
				$this->error['error_meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		return !$this->error;
	}
	

	protected function validateDelete() {

		if (!$this->user->hasPermission('modify', 'catalog/landing')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
