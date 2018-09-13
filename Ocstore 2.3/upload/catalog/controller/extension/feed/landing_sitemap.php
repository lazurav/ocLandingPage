<?php
class ControllerExtensionFeedLandingSitemap extends Controller {

	
	public function index() {

		if ($this->config->get('landing_sitemap_status')) {

			$output  = '<?xml version="1.0" encoding="UTF-8"?>';
			$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

			$this->load->model('catalog/landing');

			$landingLinks = $this->model_catalog_landing->getLandingLinks();

			foreach ($landingLinks as $langingLink) {

				$output .= '<url>';
				$output .= '<loc>' . (isset($﻿this->request->server['HTTPS']) ? HTTPS_SERVER : HTTP_SERVER) . substr(urldecode($langingLink['url_param']),1) . '</loc>';
				$output .= '<changefreq>weekly</changefreq>';
				$output .= '<priority>0.7</priority>';
				$output .= '</url>';
			}
	 
			$output .= '</urlset>';

			$this->response->addHeader('Content-Type: application/xml');
			$this->response->setOutput($output);

			$file = "landing_sitemap.xml";
			$fp = fopen($file, "w");
			fwrite($fp, $output);
			fclose($fp);
		}
	}
}
