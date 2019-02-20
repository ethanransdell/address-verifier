<?php include_once APP_ROOT_DIR . '/views/includes/header.php'; ?>

<div class="page-header">
    <div class="row">
        <div class="col-lg-12">
            <h1>Verify</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="address_entered" class="card text-white bg-primary mb-3 mx-auto address-card"
             style="max-width: 20rem;">
            <div class="card-header">Address Entered</div>
            <div class="card-body">
                <h4 class="card-title"><?php echo $address->recipient; ?></h4>
                <p class="card-text">
                    <?php echo $address->address1; ?>
                    <?php if (!empty($address->address2)) {
                        echo '<br>' . $address->address2;
                    } ?>
                    <br><?php echo $address->city . ', ' . $address->state . ' ' . $address->zip5 . (!empty($address->zip4) ? '-' . $address->zip4 : ''); ?>
                </p>
                <form method="POST" action="<?php echo APP_ROOT_URL; ?>/save">
                    <input type="hidden" name="save_address"
                           value="<?php echo base64_encode(json_encode($address)); ?>">
                    <button type="submit" class="btn btn-primary">Use This Address</button>
                </form>
            </div>
        </div>
        <div id="address_verified" class="card text-white bg-primary mb-3 mx-auto address-card"
             style="max-width: 20rem;">
            <div class="card-header">Address Verified</div>
            <div class="card-body">
                <h4 class="card-title"><?php echo $verified->recipient; ?></h4>
                <p class="card-text">
                    <?php echo $verified->address1; ?>
                    <?php if (!empty($verified->address2)) {
                        echo '<br>' . $verified->address2;
                    } ?>
                    <br><?php echo $verified->city . ', ' . $verified->state . ' ' . $verified->zip5 . (!empty($verified->zip4) ? '-' . $verified->zip4 : ''); ?>
                </p>
                <form method="POST" action="<?php echo APP_ROOT_URL; ?>/save">
                    <input type="hidden" name="save_address"
                           value="<?php echo base64_encode(json_encode($verified)); ?>">
                    <button type="submit" class="btn btn-primary">Use This Address</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once APP_ROOT_DIR . '/views/includes/scripts.php'; ?>

<?php include_once APP_ROOT_DIR . '/views/includes/footer.php'; ?>
