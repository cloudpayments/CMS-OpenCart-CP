<?php

// Heading
$_['heading_title'] = 'CloudPayments';

// Text
$_['text_cloudpayments'] = '<a href="https://cloudpayments.ru" target="_blank"><img src="view/image/payment/cloudpayments.png"></a>';
$_['text_extension'] = 'Extensions';
$_['text_success'] = 'Success: You have modified CloudPayments settings!';
$_['text_edit'] = 'Edit CloudPayments settings';

$_['text_taxation_system_0'] = 'General taxation system';
$_['text_taxation_system_1'] = 'Simplified taxation system (Income)';
$_['text_taxation_system_2'] = 'Simplified taxation system (Income minus Expenditure)';
$_['text_taxation_system_3'] = 'A single tax on imputed income';
$_['text_taxation_system_4'] = 'Unified agricultural tax';
$_['text_taxation_system_5'] = 'Patent system of taxation';

$_['text_vat_none'] = 'No Vat';
$_['text_vat_18'] = 'Vat 18%';
$_['text_vat_10'] = 'Vat 10%';
$_['text_vat_0'] = 'Vat 0%';
$_['text_vat_110'] = 'Calculated vat 10/110';
$_['text_vat_118'] = 'Calculated vat 18/118';

// Entry
$_['entry_public_id'] = 'Public site ID';
$_['entry_secret_key'] = 'Secret key';

$_['entry_two_steps'] = 'Two-steps payments (DMS)';

$_['entry_kkt'] = 'Generate online receipt';
$_['entry_taxation_system'] = 'Taxation_system';
$_['entry_vat'] = 'Vat';
$_['entry_vat_delivery'] = 'Vat for delivery';

$_['entry_order_status_pay'] = 'Status for order on pay notifcation';
$_['entry_order_status_auth'] = 'Status for order on auth notifcation (two-steps payments)';
$_['entry_order_status_confirm'] = 'Status for order on confirm notifcation (two-steps payments)';
$_['entry_order_status_refund'] = 'Status for order on refund notifcation';
$_['entry_order_status_fail'] = 'Status for order on fail notifcation';
$_['entry_order_status_for_confirm'] = 'Order statuses for confirm payment (two-steps payments)';
$_['entry_order_status_for_cancel'] = 'Order statuses for cancel payment (two-steps payments)';
$_['entry_order_status_for_send_order_link'] = 'Order statuses for send payment email';

$_['entry_notify_url_check'] = 'URL for check notifcation';
$_['entry_notify_url_pay'] = 'URL for pay notifcation';
$_['entry_notify_url_confirm'] = 'URL for confirm notifcation';
$_['entry_notify_url_refund'] = 'URL for refund notifcation';
$_['entry_notify_url_fail'] = 'URL for fail notifcation';

$_['entry_total'] = 'Total';
$_['entry_geo_zone'] = 'Geo zone';
$_['entry_status'] = 'Status';
$_['entry_sort_order'] = 'Sort order';

// Tab
$_['tab_settings'] = 'Settings';
$_['tab_order_status'] = 'Statuses';
$_['tab_notifications'] = 'Notifications';

//Field sets
$_['text_general'] = 'General';
$_['text_kkt'] = 'Online kassir';

$_['text_status_auth_help'] = 'When a two-steps payment mode enabled, an additional statuses may be required. Additional status "Authorized" may be required for the marking of orders whose payment is authorized (holded on the account of  cardholder).';
$_['text_status_confirm_help'] = 'When a two-stage payment mode enabled, an additional statuses may be required. Additional status "Confirmed" may be required to send a request for payment confirmation when the order changed to this status.';
$_['text_status_add_btn'] = 'Add status';

// Help
$_['help_public_id'] = 'This parameter you can get in CloudPayments (Public ID)';
$_['help_secret_key'] = 'This parameter you can get in CloudPayments (Пароль для API)';
$_['help_two_steps'] = 'Payment will occur in 2 steps: authorization and confirmation';

$_['help_kkt'] = 'Automatically generate online check when pay';
$_['help_taxation_system'] = 'More details in documentation CloudPayments';
$_['help_vat'] = 'Vat for products in the order. More details in documentation CloudPayments';
$_['help_vat_delivery'] = 'Vat for delivery. More details in documentation CloudPayments';

$_['help_order_status_pay'] = 'Order get changed its status on chosen once receive pay notification';
$_['help_order_status_auth'] = 'Order get changed its status on chosen once receive auth notification (two-steps payments)';
$_['help_order_status_confirm'] = 'Order get changed its status on chosen once receive confirm notification (two-steps payments)';
$_['help_order_status_refund'] = 'Order get changed its status on chosen once receive refund notification';
$_['help_order_status_fail'] = 'Order get changed its status on chosen once receive fail notification';
$_['help_order_status_for_confirm'] = 'Order statuses for sending request confirm payment (two-steps payments)';
$_['help_order_status_for_cancel'] = 'Order statuses for sending request confirm payment';
$_['help_order_status_for_send_order_link'] = 'For  order creation from backend.  one of the following statuses will send a payment link to customer by email and sms';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify settings!';
$_['error_public_id'] = 'Field required';
$_['error_secret_key'] = 'Field required';
