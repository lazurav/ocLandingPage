<?php

class ModelCatalogLanding extends Model {

	
	public function addLanding($data) {
		$this->load->model('localisation/language');
		$language_info = $this->model_localisation_language->getLanguageByCode($this->config->get('config_language'));
    	$front_language_id = $language_info['language_id'];

		$this->db->query("INSERT INTO " . DB_PREFIX . "landing SET name = '" . $this->db->escape($data['landing']['name']) . "', url_param = '" . urlencode(urldecode($data['landing']['url_param'])) . "', status = '" . (int)$data['landing']['status'] . "'");

		$landing_id = $this->db->getLastId();

		foreach ($data['landing_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "landing_description SET landing_id = '" . (int)$landing_id . "', language_id = '" . (int)$language_id . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}
	}

	
	public function editLanding($landing_id, $data) {
		
		$this->load->model('localisation/language');
		$language_info = $this->model_localisation_language->getLanguageByCode($this->config->get('config_language'));
		$front_language_id = $language_info['language_id'];

		$this->db->query("UPDATE " . DB_PREFIX . "landing SET name = '" . $this->db->escape($data['landing']['name']) . "', url_param = '" . urlencode(urldecode($data['landing']['url_param'])) . "', status = '" . (int)$data['landing']['status'] . "' WHERE landing_id = '" . (int)$landing_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "landing_description WHERE landing_id = '" . (int)$landing_id . "'");

		foreach ($data['landing_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "landing_description SET landing_id = '" . (int)$landing_id . "', language_id = '" . (int)$language_id . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}
	}

	
	public function deleteLanding($landing_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "landing WHERE landing_id = '" . (int)$landing_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "landing_description WHERE landing_id = '" . (int)$landing_id . "'");		
	}


	public function getLanding($landing_id){

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "landing WHERE landing_id = '" . (int)$landing_id . "'");
		
		return $query->row;
	}

	
	public function getLandingDescription($landing_id) {
		$landing_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "landing_description WHERE landing_id = '" . (int)$landing_id . "'");

		foreach ($query->rows as $result) {
			$landing_description_data[$result['language_id']] = array(
				'meta_title'       => $result['meta_title'],
				'meta_h1'          => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $landing_description_data;
	}

	
	public function getLandings($data = array()){
		$sql = "SELECT * FROM " . DB_PREFIX . "landing";

		if (isset($data['status'])) {
			$sql .= " WHERE status = '" . $data['status'] . "'";
		}

		if (isset($data['sort']) && isset($data['sort'])) {
			$sql .= " ORDER BY " . $data['sort'] . " " . $data['order'];
		}
		
		if (isset($data['start']) && isset($data['limit'])) {
			$sql .= " LIMIT " . (int)$data['start'] . ", " . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
		
		return $query->rows;
	}

	
	public function getTotalLandings() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "landing");

		return $query->row['total'];
	}

	
	public function countLandingByUrl($url_param, $landing_id = '0') {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "landing WHERE landing_id != '" . $landing_id . "' AND url_param = '" . urlencode(urldecode(htmlentities($url_param))) . "'" );

		return $query->row['total'];
	}
}
