<?php

/**
 * Class ModelExtensionPaymentCloudPayments
 *
 * @property Loader              $load
 * @property ModelSettingSetting $model_setting_setting
 * @property DB\MySQLi           $db
 */
class ModelExtensionPaymentCloudPayments extends Model {

	/**
	 *
	 */
	public function install() {

		$this->db->query('CREATE TABLE IF NOT EXISTS `' . DB_PREFIX . 'cloudpayments_transaction` (
			`cloudpayments_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
			`order_id` int(11) NOT NULL,
			`transaction_id` varchar(50) NOT NULL,
			`transaction_status` varchar(50) NOT NULL,
			`transaction_amount` decimal(15,4) NOT NULL,
			`transaction_currency` varchar(10) NOT NULL,
			`transaction_datetime` datetime NOT NULL,
			`reason` varchar(255) NULL,
			`reason_code` int(11) NULL,
			`ip` varchar(50) NOT NULL,
			`date_added` datetime NOT NULL,
			PRIMARY KEY (`cloudpayments_transaction_id`),
			INDEX `order_id` (`order_id`),
			INDEX `transaction_status` (`transaction_status`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

		// Order Status defaults
		$defaults['payment_cloudpayments_order_status_pay']         = 1;
		$defaults['payment_cloudpayments_order_status_auth']        = 1;
		$defaults['payment_cloudpayments_order_status_confirm']     = 5;
		$defaults['payment_cloudpayments_order_status_refund']      = 13;
		$defaults['payment_cloudpayments_order_status_fail']        = 10;
		$defaults['payment_cloudpayments_order_status_for_confirm'] = array(5);
		$defaults['payment_cloudpayments_order_status_for_cancel']  = array(9);
		$defaults['payment_cloudpayments_order_status_for_send_order_link']  = array(1);

		$defaults['payment_cloudpayments_sort_order'] = 0;

		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('payment_cloudpayments', $defaults);
	}

	/**
	 *
	 */
	public function uninstall() {
	}

	/**
	 * @return array
	 */
	public function getAvailableTransactionStatuses() {
		return array(
			'Authorized',
			'Completed',
			'Refunded',
			'Failed'
		);
	}
}
