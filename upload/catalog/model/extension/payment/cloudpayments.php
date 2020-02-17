<?php

/**
 * Class ModelExtensionPaymentCloudPayments
 *
 * @property Loader             $load
 * @property Config             $config
 * @property Language           $language
 * @property Session            $session
 * @property ModelCheckoutOrder $model_checkout_order
 * @property DB\MySQLi          $db
 */
class ModelExtensionPaymentCloudPayments extends Model {

	/**
	 * Call when display payments in checkout
	 *
	 * @param $address
	 * @param $total
	 * @return array
	 */
	public function getMethod($address, $total) {
		$this->load->language('extension/payment/cloudpayments');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('payment_cloudpayments_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if ($this->config->get('payment_cloudpayments_total') > 0 && $this->config->get('payment_cloudpayments_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('payment_cloudpayments_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		$currencies = array(
			'RUB',
			'EUR',
			'USD',
			'GBP',
			'UAH',
			'BYN',
			'KZT',
			'AZN',
			'CHF',
			'CZK',
			'CAD',
			'PLN',
			'SEK',
			'TRY',
			'CNY',
			'INR',
			'BRL',
			'ZAL',
			'UZS',
			'BGL',
			'GEL',
		);

		if (!in_array(strtoupper($this->session->data['currency']), $currencies)) {
			$status = false;
		}

		$method_data = array();

		if ($status) {
			$method_data = array(
				'code'       => 'cloudpayments',
				'title'      => $this->language->get('text_title'),
				'terms'      => '',
				'sort_order' => $this->config->get('payment_cloudpayments_sort_order')
			);
		}

		return $method_data;
	}

	/**
	 * @param $order_id
	 * @return mixed
	 */
	public function getLastOrderTransaction($order_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "cloudpayments_transaction` WHERE order_id = '" . $order_id . "' ORDER BY cloudpayments_transaction_id DESC LIMIT 1");
		return $query->row;
	}

	/**
	 * @param $order_id
	 * @param $transaction_status
	 * @return bool
	 */
	public function isOrderHasTransaction($order_id, $transaction_status) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "cloudpayments_transaction` WHERE order_id = '" . $order_id . "' AND transaction_status = '" . $transaction_status . "' LIMIT 1");
		return $query->num_rows > 0;
	}

	/**
	 * @param $data
	 */
	public function addTransaction($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "cloudpayments_transaction` SET 
			order_id = '" . intval($data['order_id']) . "',
			transaction_id = '" . $this->db->escape($data['transaction_id']) . "',
			transaction_status = '" . $this->db->escape($data['transaction_status']) . "',
			transaction_amount = '" . $this->db->escape($data['transaction_amount']) . "',
			transaction_currency = '" . $this->db->escape($data['transaction_currency']) . "',
			transaction_datetime = '" . $this->db->escape($data['transaction_datetime']) . "',
			reason = '" . $this->db->escape($data['reason']) . "',
			reason_code = '" . $this->db->escape($data['reason_code']) . "',
			ip = '" . $this->db->escape($data['ip']) . "',
			date_added = CURRENT_TIMESTAMP
		");
	}

	/**
	 * @param $order_id
	 * @param $order_status_id
	 */
	public function addOrderHistory($order_id, $order_status_id) {
		$order_id = intval($order_id);
		$order_status_id = intval($order_status_id);
		$this->load->model('checkout/order');
		$this->model_checkout_order->addOrderHistory($order_id, $order_status_id);


		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_history`
			WHERE order_id = " . $order_id . " ORDER BY order_history_id DESC LIMIT 2"
		);

		if ($query->num_rows < 2) {
			return ;
		}

		$last_history_items = $query->rows;
		if ($last_history_items[0]['date_added'] == $last_history_items[1]['date_added']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "order_history` 
				SET `date_added` = DATE_ADD(`date_added`, INTERVAL 1 second)
				WHERE order_history_id = " . $last_history_items[0]['order_history_id']
			);
		}
	}
}
