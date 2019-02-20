<?php include_once APP_ROOT_DIR . '/views/includes/header.php'; ?>

<div class="page-header">
    <div class="row">
        <div class="col-lg-12">
            <h1>Create</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if (isset($errorMessage)) { ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php } ?>
        <form method="POST" action="<?php echo APP_ROOT_URL; ?>/verify" id="create_address_form">
            <fieldset>
                <div class="form-group">
                    <label for="recipient">Recipient</label>
                    <input type="text" class="form-control" name="recipient" maxlength="255"
                           value="<?php echo isset($address) ? $address->recipient : '' ?>" required autofocus>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="address1">Address 1</label>
                        <input type="text" class="form-control" name="address1" maxlength="255"
                               value="<?php echo isset($address) ? $address->address1 : '' ?>" required>
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="address2">Address 2</label>
                        <input type="text" class="form-control" name="address2" maxlength="255" placeholder="(optional)"
                               value="<?php echo isset($address) ? $address->address2 : '' ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3 col-sm-6">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" maxlength="50"
                               value="<?php echo isset($address) ? $address->city : '' ?>" required>
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                        <label for="state">State</label>
                        <select class="form-control" name="state" required>
                            <option value="" disabled selected>Choose</option>
                            <?php foreach ($states as $state) { ?>
                                <option value="<?php echo $state; ?>" <?php echo isset($address) && $address->state === $state ? 'selected' : '' ?>><?php echo $state; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                        <label for="zip5">Zip5</label>
                        <input type="text" class="form-control" name="zip5" pattern="\d{5}" minlength="5" maxlength="5"
                               value="<?php echo isset($address) ? $address->zip5 : '' ?>"
                               required>
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                        <label for="zip4">Zip4</label>
                        <input type="text" class="form-control" name="zip4" patterm="\d{4}" minlength="4" maxlength="4"
                               placeholder="(optional)" value="<?php echo isset($address) ? $address->zip4 : '' ?>">
                    </div>
                </div>
                <button type="submit" id="submit_button" class="btn btn-primary" disabled>Submit</button>
            </fieldset>
        </form>
    </div>
</div>

<?php include_once APP_ROOT_DIR . '/views/includes/scripts.php'; ?>

<script type="text/javascript">
    const createAddressForm = document.getElementById('create_address_form');
    const submitButton = document.getElementById('submit_button');
    const decorateFormControls = (target) => {
        if (target.checkValidity()) {
            target.classList.add('is-valid');
        } else {
            target.classList.add('is-invalid');
        }
        submitButton.disabled = !createAddressForm.checkValidity();
    }
    createAddressForm.onchange = (event) => decorateFormControls(event.target);
    (() => {
        $('[name=zip5]').mask('00000');
        $('[name=zip4]').mask('0000');
        <?php if (isset($address)) { ?>
        Array.from(document.getElementsByClassName('form-control')).forEach((element) => decorateFormControls(element));
        <?php } ?>
    })();
</script>

<?php include_once APP_ROOT_DIR . '/views/includes/footer.php'; ?>
