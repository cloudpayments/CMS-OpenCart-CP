<div class="buttons">
    <div class="pull-right">
        <input type="button" value="<?php echo $button_pay; ?>" id="button_pay" class="btn btn-primary" />
    </div>
</div>

<script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
<script type="text/javascript">
    var pay = function () {
        var widget = new cp.CloudPayments({language: "<?php echo $language; ?>"});
        widget.<?php echo $widget_pay_method; ?>({
                publicId: "<?php echo $public_id; ?>",
                description: "<?php echo $description; ?>",
                amount: <?php echo $order_total; ?>, //сумма
                currency: "<?php echo $order_currency; ?>",
                invoiceId: "<?php echo $order_invoice_id; ?>",
                <?php if ($customer_id != 0) { ?>
                accountId: "<?php echo $customer_id; ?>",
                <?php } ?>
                email: "<?php echo $order_email; ?>",
                data: <?php echo json_encode($widget_data); ?>
            },
            function (options) { // success
                window.location.assign("<?php echo $success_url; ?>");
            },
            function (reason, options) { // fail
                window.location.assign("<?php echo $failure_url; ?>");
            });
    };
    $(document).on('click', '#button_pay', function(e) {
        e.preventDefault();
        pay();
    });
</script>