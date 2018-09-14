<?php

/**
 * Class ControllerExtensionPaymentCloudPayments
 *
 * @property Loader                             $load
 * @property Document                           $document
 * @property ModelSettingSetting                $model_setting_setting
 * @property ModelExtensionEvent                $model_extension_event
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
			$this->model_setting_setting->editSetting('cloudpayments', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
		}

		$data = array(
			'error_public_id'  => '',
			'error_secret_key' => '',
		);
		foreach ($this->error as $f => $v) {
			$data['error_' . $f] = $v;
		}

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['entry_public_id'] = $this->language->get('entry_public_id');
        $data['entry_secret_key'] = $this->language->get('entry_secret_key');
        $data['entry_currency'] = $this->language->get('entry_currency');
        $data['entry_language'] = $this->language->get('entry_language');
        $data['entry_two_steps'] = $this->language->get('entry_two_steps');
        $data['entry_kkt'] = $this->language->get('entry_kkt');
        $data['entry_taxation_system'] = $this->language->get('entry_taxation_system');
        $data['entry_vat'] = $this->language->get('entry_vat');
        $data['entry_vat_delivery'] = $this->language->get('entry_vat_delivery');
        $data['entry_order_status_pay'] = $this->language->get('entry_order_status_pay');
        $data['entry_order_status_auth'] = $this->language->get('entry_order_status_auth');
        $data['entry_order_status_confirm'] = $this->language->get('entry_order_status_confirm');
        $data['entry_order_status_refund'] = $this->language->get('entry_order_status_refund');
        $data['entry_order_status_fail'] = $this->language->get('entry_order_status_fail');
        $data['entry_order_status_for_cancel'] = $this->language->get('entry_order_status_for_cancel');
        $data['entry_order_status_for_confirm'] = $this->language->get('entry_order_status_for_confirm');
        $data['entry_order_status_for_send_order_link'] = $this->language->get('entry_order_status_for_send_order_link');
        $data['entry_total'] = $this->language->get('entry_total');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['tab_settings'] = $this->language->get('tab_settings');
        $data['tab_order_status'] = $this->language->get('tab_order_status');
        $data['tab_notifications'] = $this->language->get('tab_notifications');
        $data['text_general'] = $this->language->get('text_general');
        $data['text_kkt'] = $this->language->get('text_kkt');
        $data['text_vat_none'] = $this->language->get('text_vat_none');
        $data['text_status_auth_help'] = $this->language->get('text_status_auth_help');
        $data['text_status_confirm_help'] = $this->language->get('text_status_confirm_help');
        $data['text_status_add_btn'] = $this->language->get('text_status_add_btn');
        $data['help_public_id'] = $this->language->get('help_public_id');
        $data['help_secret_key'] = $this->language->get('help_secret_key');
        $data['help_two_steps'] = $this->language->get('help_two_steps');
        $data['help_kkt'] = $this->language->get('help_kkt');
        $data['help_taxation_system'] = $this->language->get('help_taxation_system');
        $data['help_vat'] = $this->language->get('help_vat');
        $data['help_vat_delivery'] = $this->language->get('help_vat_delivery');
        $data['help_total'] = $this->language->get('help_total');
        $data['help_notify_urls'] = $this->language->get('help_notify_urls');
        $data['help_order_status_pay'] = $this->language->get('help_order_status_pay');
        $data['help_order_status_auth'] = $this->language->get('help_order_status_auth');
        $data['help_order_status_confirm'] = $this->language->get('help_order_status_confirm');
        $data['help_order_status_refund'] = $this->language->get('help_order_status_refund');
        $data['help_order_status_fail'] = $this->language->get('help_order_status_fail');
        $data['help_order_status_for_confirm'] = $this->language->get('help_order_status_for_confirm');
        $data['help_order_status_for_cancel'] = $this->language->get('help_order_status_for_cancel');
        $data['help_order_status_for_send_order_link'] = $this->language->get('help_order_status_for_send_order_link');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension',
				'token=' . $this->session->data['token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/cloudpayments',
				'token=' . $this->session->data['token'],
				true)
		);

		$data['action'] = $this->url->link('extension/payment/cloudpayments',
			'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension',
			'token=' . $this->session->data['token'] . '&type=payment', true);

		$fields = array(
			'cloudpayments_status',
			'cloudpayments_total',
			'cloudpayments_sort_order',
			'cloudpayments_public_id',
			'cloudpayments_secret_key',
			'cloudpayments_currency',
			'cloudpayments_language',
			'cloudpayments_two_steps',
			'cloudpayments_kkt',
			'cloudpayments_taxation_system',
			'cloudpayments_vat',
			'cloudpayments_vat_delivery',
			'cloudpayments_order_status_pay',
			'cloudpayments_order_status_auth',
			'cloudpayments_order_status_confirm',
			'cloudpayments_order_status_refund',
			'cloudpayments_order_status_fail',
			'cloudpayments_order_status_for_confirm',
			'cloudpayments_order_status_for_cancel',
			'cloudpayments_order_status_for_send_order_link'
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

		if (isset($this->request->post['cloudpayments_geo_zone_id'])) {
			$data['cloudpayments_geo_zone_id'] = $this->request->post['cloudpayments_geo_zone_id'];
		} else {
			$data['cloudpayments_geo_zone_id'] = $this->config->get('cloudpayments_geo_zone_id');
		}
		$this->load->model('localisation/geo_zone');
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$data['taxation_systems'] = array();
		for ($i = 0; $i <= 5; $i++) {
			$data['taxation_systems'][$i] = $this->language->get('text_taxation_system_' . $i);
		}

		$data['vat_values'] = array();
		foreach (array('18', '10', '0', '110', '118') as $vat) {
			$data['vat_values'][$vat] = $this->language->get('text_vat_' . $vat);
		}
//		$data['text_vat_none'] = $this->language->get('text_vat_none');

		$data['notify_urls'] = array();

		$url = new Url(HTTP_CATALOG, $this->config->get('config_secure') ? HTTP_CATALOG : HTTPS_CATALOG);
		foreach (array('check', 'pay', 'fail', 'confirm', 'refund') as $type) {
			$data['notify_urls'][$type] = array(
				'label' => $this->language->get('entry_notify_url_' . $type),
				'url'   => $url->link('extension/payment/cloudpayments/notify-' . $type)
			);
		}
		$data['add_status_url'] = str_replace('&amp;', '&', $this->url->link('localisation/order_status',
			'token=' . $this->session->data['token'], true));

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
			if (!$this->request->post['cloudpayments_' . $f]) {
				$this->error[$f] = $this->language->get('error_' . $f);
			}
		}

		return !$this->error;
	}

	public function install() {
        $this->load->model('extension/event');
		$this->model_extension_event->addEvent('cloudpayments', 'catalog/model/checkout/order/addOrderHistory/after', 'extension/payment/cloudpayments/changeOrderStatus');
		$this->model_extension_event->addEvent('cloudpayments', 'catalog/model/checkout/order/deleteOrder/before', 'extension/payment/cloudpayments/deleteOrderBefore');
		$this->load->model('extension/payment/cloudpayments');
		$this->model_extension_payment_cloudpayments->install();
	}

	public function uninstall() {
        $this->load->model('extension/event');
		$this->model_extension_event->deleteEvent('cloudpayments');
		$this->load->model('extension/payment/cloudpayments');
		$this->model_extension_payment_cloudpayments->uninstall();
	}
}