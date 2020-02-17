<?php

/**
 * Class ControllerExtensionPaymentCloudPayments
 *
 * @property Loader                             $load
 * @property Document                           $document
 * @property ModelSettingSetting                $model_setting_setting
 * @property ModelSettingEvent                  $model_setting_event
 * @property Request                            $request
 * @property Response                           $response
 * @property Session                            $session
 * @property Language                           $language
 * @property Url                                $url
 * @property Config                             $config
 * @property ModelLocalisationGeoZone           $model_localisation_geo_zone
 * @property ModelLocalisationOrderStatus       $model_localisation_order_status
 * @property ModelExtensionPaymentCloudPayments $model_extension_payment_cloudpayments
 * @property Cart\User                          $user
 */
class ControllerExtensionPaymentCloudPayments extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/cloudpayments');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payment_cloudpayments', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('marketplace/extension',
				'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data = array(
			'error_public_id'  => '',
			'error_secret_key' => '',
		);
		foreach ($this->error as $f => $v) {
			$data['error_' . $f] = $v;
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension',
				'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/cloudpayments',
				'user_token=' . $this->session->data['user_token'],
				true)
		);

		$data['action'] = $this->url->link('extension/payment/cloudpayments',
			'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension',
			'user_token=' . $this->session->data['user_token'] . '&type=payment', true);

		$fields = array(
			'payment_cloudpayments_status',
			'payment_cloudpayments_total',
			'payment_cloudpayments_sort_order',
			'payment_cloudpayments_public_id',
			'payment_cloudpayments_secret_key',
			'payment_cloudpayments_currency',
			'payment_cloudpayments_language',
			'payment_cloudpayments_two_steps',
			'payment_cloudpayments_skin',
			'payment_cloudpayments_kkt',
			'payment_cloudpayments_taxation_system',
			'payment_cloudpayments_vat',
			'payment_cloudpayments_vat_delivery',
			'payment_cloudpayments_order_status_pay',
			'payment_cloudpayments_order_status_auth',
			'payment_cloudpayments_order_status_confirm',
			'payment_cloudpayments_order_status_refund',
			'payment_cloudpayments_order_status_fail',
			'payment_cloudpayments_order_status_for_confirm',
			'payment_cloudpayments_order_status_for_cancel',
			'payment_cloudpayments_order_status_for_send_order_link',
			'payment_cloudpayments_kassa_method',
            'payment_cloudpayments_kassa_object',
            'payment_cloudpayments_status_delivered',
            'payment_cloudpayments_inn'
		);

		foreach ($fields as $f) {
			if (isset($this->request->post[$f])) {
				$data[$f] = $this->request->post[$f];
			} else {
				$data[$f] = $this->config->get($f);
			}
		}
		$this->load->model('localisation/order_status');
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['payment_cloudpayments_geo_zone_id'])) {
			$data['payment_cloudpayments_geo_zone_id'] = $this->request->post['payment_cloudpayments_geo_zone_id'];
		} else {
			$data['payment_cloudpayments_geo_zone_id'] = $this->config->get('payment_cloudpayments_geo_zone_id');
		}
		$this->load->model('localisation/geo_zone');
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$data['taxation_systems'] = array();
		for ($i = 0; $i <= 5; $i++) {
			$data['taxation_systems'][$i] = $this->language->get('text_taxation_system_' . $i);
		}

        $data['skin_values'] = array();
		foreach (array('classic', 'modern', 'mini') as $skin) {
			$data['skin_values'][$skin] = $this->language->get('text_skin_' . $skin);
		}
		
		$data['kassa_method_values'] = array();
		foreach (array('0', '1', '2', '3', '4', '5', '6', '7') as $kassa_method) {
			$data['kassa_method'][$kassa_method] = $this->language->get('text_kassa_method_' . $kassa_method);
		}
		
		$data['kassa_object_values'] = array();
		foreach (array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13') as $kassa_object) {
			$data['kassa_object'][$kassa_object] = $this->language->get('text_kassa_object_' . $kassa_object);
		}
		
		//$data['currency_values'] = array();
		//foreach (array('RUB', 'EUR', 'USD', 'GBP', 'UAH', 'BYN', 'KZT', 'AZN', 'CHF', 'CZK', 'CAD', 'PLN', 'SEK', 'TRY', 'CNY', 'INR', 'BRL', 'ZAR', 'UZS', 'GEL','BGL') as $currency) {
		//	$data['currency_values'][$currency] = $this->language->get('text_currency_' . $currency);
		//}

		$data['vat_values'] = array();
		foreach (array('20', '10', '0', '110', '120') as $vat) {
			$data['vat_values'][$vat] = $this->language->get('text_vat_' . $vat);
		}
//		$data['text_vat_none'] = $this->language->get('text_vat_none');

		$data['notify_urls'] = array();

		$url = new Url(HTTP_CATALOG, $this->config->get('config_secure') ? HTTP_CATALOG : HTTPS_CATALOG);
		foreach (array('check', 'pay', 'fail', 'confirm', 'refund', 'receipt') as $type) {
			$data['notify_urls'][$type] = array(
				'label' => $this->language->get('entry_notify_url_' . $type),
				'url'   => $url->link('extension/payment/cloudpayments/notify-' . $type)
			);
		}
		$data['add_status_url'] = str_replace('&amp;', '&', $this->url->link('localisation/order_status',
			'user_token=' . $this->session->data['user_token'], true));

		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/cloudpayments', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/cloudpayments')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$required_fields = array(
			'public_id',
			'secret_key'
		);

		foreach ($required_fields as $f) {
			if (!$this->request->post['payment_cloudpayments_' . $f]) {
				$this->error[$f] = $this->language->get('error_' . $f);
			}
		}

		return !$this->error;
	}

	public function install() {
		$this->load->model('setting/event');
		$this->model_setting_event->addEvent('cloudpayments', 'catalog/model/checkout/order/addOrderHistory/after', 'extension/payment/cloudpayments/changeOrderStatus');
		$this->model_setting_event->addEvent('cloudpayments', 'catalog/model/checkout/order/deleteOrder/before', 'extension/payment/cloudpayments/deleteOrderBefore');
		$this->load->model('extension/payment/cloudpayments');
		$this->model_extension_payment_cloudpayments->install();
	}

	public function uninstall() {
		$this->load->model('setting/event');
		$this->model_setting_event->deleteEventByCode('cloudpayments');
		$this->load->model('extension/payment/cloudpayments');
		$this->model_extension_payment_cloudpayments->uninstall();
	}
}