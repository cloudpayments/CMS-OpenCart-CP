<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-payment" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?> 
            <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-payment"
                      class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-settings" data-toggle="tab"><?php echo $tab_settings; ?></a></li>
                        <li><a href="#tab-order_status" data-toggle="tab"><?php echo $tab_order_status; ?></a></li>
                        <li><a href="#tab-notifications" data-toggle="tab"><?php echo $tab_notifications; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-settings">
                            <fieldset>
                                <legend><?php echo $text_general; ?></legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="entry-public_id">
                                        <span data-toggle="tooltip" title="<?php echo $help_public_id; ?>"><?php echo $entry_public_id; ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cloudpayments_public_id"
                                               value="<?php echo $cloudpayments_public_id; ?>"
                                               placeholder="<?php echo $entry_public_id; ?>"
                                               autocomplete="off"
                                               id="entry-public_id" class="form-control"/>
                                        <?php if ($error_public_id) { ?>
                                            <div class="text-danger"><?php echo $error_public_id; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="entry-secret_key">
                                        <span data-toggle="tooltip" title="<?php echo $help_secret_key; ?>"><?php echo $entry_secret_key; ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cloudpayments_secret_key"
                                               value="<?php echo $cloudpayments_secret_key; ?>"
                                               placeholder="<?php echo $entry_secret_key; ?>"
                                               autocomplete="off"
                                               id="entry-secret_key" class="form-control"/>
                                        <?php if ($error_secret_key) { ?>
                                            <div class="text-danger"><?php echo $error_secret_key; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <!--Two-steps-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="entry-two_steps">
                                        <span data-toggle="tooltip" title="<?php echo $help_two_steps; ?>"><?php echo $entry_two_steps; ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="cloudpayments_two_steps" id="entry-two_steps"
                                                class="form-control">
                                            <?php if ($cloudpayments_two_steps) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                            <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!--Standard options -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="entry-geo-zone"><?php echo $entry_geo_zone; ?></label>
                                    <div class="col-sm-10">
                                        <select name="cloudpayments_geo_zone_id" id="entry-geo-zone" class="form-control">
                                            <option value="0"><?php echo $text_all_zones; ?></option>
                                            <?php foreach ($geo_zones as $geo_zone) { ?>
                                                <?php if ($geo_zone['geo_zone_id'] == $cloudpayments_geo_zone_id) { ?>
                                                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="entry-sort_order"><?php echo $entry_sort_order; ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cloudpayments_sort_order"
                                               value="<?php echo $cloudpayments_sort_order; ?>"
                                               placeholder="<?php echo $entry_sort_order; ?>"
                                               autocomplete="off"
                                               id="entry-sort_order" class="form-control"/>
                                        <?php if (isset($error_sort_order)) { ?>
                                            <div class="text-danger"><?php echo $error_sort_order; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="entry-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cloudpayments_total"
                                               value="<?php echo $cloudpayments_total; ?>"
                                               placeholder="<?php echo $entry_total; ?>"
                                               id="entry-total" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="entry-status"><?php echo $entry_status; ?></label>
                                    <div class="col-sm-10">
                                        <select name="cloudpayments_status" id="entry-status" class="form-control">
                                            <?php if ($cloudpayments_status) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                            <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </fieldset>
                            <fieldset>
                                <legend><?php echo $text_kkt; ?></legend>
                                <!--KKT-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="entry-kkt">
                                        <span data-toggle="tooltip" title="<?php echo $help_kkt; ?>"><?php echo $entry_kkt; ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="cloudpayments_kkt" id="entry-kkt" class="form-control">
                                            <?php if ($cloudpayments_kkt) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                            <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="entry-taxation_system">
                                        <span data-toggle="tooltip" title="<?php echo $help_taxation_system; ?>"><?php echo $entry_taxation_system; ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="cloudpayments_taxation_system" id="entry-taxation_system" class="form-control">
                                            <?php foreach ($taxation_systems as $i => $v) { ?>
                                                <?php if ($cloudpayments_taxation_system == $i) { ?>
                                                    <option value="<?php echo $i; ?>" selected="selected"><?php echo $v; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $v; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="entry-vat">
                                        <span data-toggle="tooltip" title="<?php echo $help_vat; ?>"><?php echo $entry_vat; ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="cloudpayments_vat" id="entry-vat"
                                                class="form-control">
                                            <?php if (strlen($cloudpayments_vat) == 0) { ?>
                                                <option value="" selected="selected"><?php echo $text_vat_none; ?></option>
                                            <?php } else { ?>
                                                <option value="" ><?php echo $text_vat_none; ?></option>
                                            <?php } ?>
                                            <?php foreach ($vat_values as $i => $v) { ?>
                                                <?php if ($cloudpayments_vat == $i && strlen($cloudpayments_vat)) { ?>
                                                    <option value="<?php echo $i; ?>" selected="selected"><?php echo $v; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $v; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="entry-vat_delivery">
                                        <span data-toggle="tooltip" title="<?php echo $help_vat_delivery; ?>"><?php echo $entry_vat_delivery; ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="cloudpayments_vat_delivery" id="entry-vat_delivery"
                                                class="form-control">
                                            <?php if (strlen($cloudpayments_vat_delivery) == 0) { ?>
                                                <option value="" selected="selected"><?php echo $text_vat_none; ?></option>
                                            <?php } else { ?>
                                                <option value="" ><?php echo $text_vat_none; ?></option>
                                            <?php } ?>
                                            <?php foreach ($vat_values as $i => $v) { ?>
                                                <?php if ($cloudpayments_vat_delivery == $i && strlen($cloudpayments_vat_delivery)) { ?>
                                                    <option value="<?php echo $i; ?>" selected="selected"><?php echo $v; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $v; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </fieldset>
                        </div>
                        <div class="tab-pane" id="tab-order_status">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="entry-order_status_pay">
                                    <span data-toggle="tooltip" title="<?php echo $help_order_status_pay; ?>"><?php echo $entry_order_status_pay; ?></span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="cloudpayments_order_status_pay" id="entry-order_status_pay"
                                            class="form-control">
                                        <?php foreach ($order_statuses as $status) { ?>
                                            <?php if ($cloudpayments_order_status_pay == $status['order_status_id']) { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>" selected="selected"><?php echo $status['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>"><?php echo $status['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="entry-order_status_auth">
                                    <span data-toggle="tooltip" title="<?php echo $help_order_status_auth; ?>"><?php echo $entry_order_status_auth; ?></span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="cloudpayments_order_status_auth" id="entry-order_status_auth"
                                            class="form-control status-container">
                                        <?php foreach ($order_statuses as $status) { ?>
                                            <?php if ($cloudpayments_order_status_auth == $status['order_status_id']) { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>" selected="selected"><?php echo $status['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>"><?php echo $status['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <p><?php echo $text_status_auth_help; ?></p>
                                    <p><a href="<?php echo $add_status_url; ?>" target="_blank" class="btn btn-primary"><?php echo $text_status_add_btn; ?></a></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="entry-order_status_confirm">
                                    <span data-toggle="tooltip" title="<?php echo $help_order_status_confirm; ?>"><?php echo $entry_order_status_confirm; ?></span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="cloudpayments_order_status_confirm" id="entry-order_status_confirm"
                                            class="form-control">
                                        <?php foreach ($order_statuses as $status) { ?>
                                            <?php if ($cloudpayments_order_status_confirm == $status['order_status_id']) { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>" selected="selected"><?php echo $status['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>"><?php echo $status['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="entry-order_status_refund">
                                    <span data-toggle="tooltip" title="<?php echo $help_order_status_refund; ?>"><?php echo $entry_order_status_refund; ?></span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="cloudpayments_order_status_refund" id="entry-order_status_refund"
                                            class="form-control">
                                        <?php foreach ($order_statuses as $status) { ?>
                                            <?php if ($cloudpayments_order_status_refund == $status['order_status_id']) { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>" selected="selected"><?php echo $status['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>"><?php echo $status['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="entry-order_status_fail">
                                    <span data-toggle="tooltip" title="<?php echo $help_order_status_fail; ?>"><?php echo $entry_order_status_fail; ?></span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="cloudpayments_order_status_fail" id="entry-order_status_fail"
                                            class="form-control">
                                        <?php foreach ($order_statuses as $status) { ?>
                                            <?php if ($cloudpayments_order_status_fail == $status['order_status_id']) { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>" selected="selected"><?php echo $status['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $status['order_status_id']; ?>"><?php echo $status['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="entry-order_status_for_confirm">
                                    <span data-toggle="tooltip" title="<?php echo $help_order_status_for_confirm; ?>"><?php echo $entry_order_status_for_confirm; ?></span>
                                </label>
                                <div class="col-sm-10">
                                    <div class="well well-sm status-container" data-type="checkbox-list" data-name="cloudpayments_order_status_for_confirm[]" style="height: 150px; overflow: auto;">
                                        <?php foreach ($order_statuses as $status) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input
                                                            type="checkbox"
                                                            name="cloudpayments_order_status_for_confirm[]"
                                                            value="<?php echo $status['order_status_id']; ?>"
                                                            <?php echo (in_array($status['order_status_id'], $cloudpayments_order_status_for_confirm) ? 'checked="checked"' : ''); ?>
                                                    />
                                                    <?php echo $status['name']; ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <p><?php echo $text_status_confirm_help; ?></p>
                                    <p><a href="<?php echo $add_status_url; ?>" target="_blank" class="btn btn-primary"><?php echo $text_status_add_btn; ?></a></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="entry-order_status_for_cancel">
                                    <span data-toggle="tooltip" title="<?php echo $help_order_status_for_cancel; ?>"><?php echo $entry_order_status_for_cancel; ?></span>
                                </label>
                                <div class="col-sm-10">
                                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                                        <?php foreach ($order_statuses as $status) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input
                                                            type="checkbox"
                                                            name="cloudpayments_order_status_for_cancel[]"
                                                            value="<?php echo $status['order_status_id']; ?>"
                                                            <?php echo (in_array($status['order_status_id'], $cloudpayments_order_status_for_cancel) ? 'checked="checked"' : ''); ?>
                                                    />
                                                    <?php echo $status['name']; ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="entry-order_status_for_send_order_link">
                                    <span data-toggle="tooltip" title="<?php echo $help_order_status_for_send_order_link; ?>"><?php echo $entry_order_status_for_send_order_link; ?></span>
                                </label>
                                <div class="col-sm-10">
                                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                                        <?php foreach ($order_statuses as $status) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input
                                                            type="checkbox"
                                                            name="cloudpayments_order_status_for_send_order_link[]"
                                                            value="<?php echo $status['order_status_id']; ?>"
                                                    <?php echo (in_array($status['order_status_id'], $cloudpayments_order_status_for_send_order_link) ? 'checked="checked"' : ''); ?>
                                                    />
                                                    <?php echo $status['name']; ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab-notifications">
                            <p><?php echo $help_notify_urls; ?></p>
                            <?php foreach ($notify_urls as $type => $notify) { ?>
                                <div class="form-group">
                                    <label for="entry-notify-url-<?php echo $type; ?>" class="col-sm-3 control-label"><?php echo $notify['label']; ?></label>
                                    <div class="col-sm-9">
                                        <input id="entry-notify-url-<?php echo $type; ?>" readonly class="form-control" value="<?php echo $notify['url']; ?>"/>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>