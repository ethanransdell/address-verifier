<?php include_once APP_ROOT_DIR . '/views/includes/header.php'; ?>

<div class="page-header">
    <div class="row">
        <div class="col-lg-12">
            <h1>Saved</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card text-white bg-primary mb-3 mx-auto address-card"
             style="max-width: 20rem;">
            <div class="card-header">Address Saved!</div>
            <div class="card-body">
                <h4 class="card-title"><?php echo $saved->recipient; ?></h4>
                <p class="card-text">
                    <?php echo $saved->address1; ?>
                    <?php if (!empty($saved->address2)) {
                        echo '<br>' . $saved->address2;
                    } ?>
                    <br><?php echo $saved->city . ', ' . $saved->state . ' ' . $saved->zip5 . (!empty($saved->zip4) ? '-' . $saved->zip4 : ''); ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include_once APP_ROOT_DIR . '/views/includes/scripts.php'; ?>

<?php include_once APP_ROOT_DIR . '/views/includes/footer.php'; ?>
