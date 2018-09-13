<?php
class ModelCatalogLanding extends Model {

	
	public function getLanding() {
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "landing l LEFT JOIN oc_landing_description ld ON (l.landing_id = ld.landing_id) WHERE l.status = '1' AND l.url_param = '" . urlencode(urldecode(htmlspecialchars($_SERVER['REQUEST_URI']))) . "' AND ld.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	
	public function getFilterName($filter_ids) {
		
		$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "filter_description WHERE `filter_id` in (" . $filter_ids . ") AND `language_id` ="  . (int)$this->config->get('config_language_id'));

		return $query->rows;
	}

	
	public function getLandingLinks() {
		
		$query = $this->db->query("SELECT url_param FROM " . DB_PREFIX . "landing WHERE status = '1' ORDER BY landing_id ASC");

		return $query->rows;
	}
}
