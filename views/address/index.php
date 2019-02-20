<?php include_once APP_ROOT_DIR . '/views/includes/header.php'; ?>

<style>
    #list_addresses_table_length,
    #list_addresses_table_filter,
    #list_addresses_table_info,
    #list_addresses_table_paginate .paginate_button.previous,
    #list_addresses_table_paginate .paginate_button.next {
        color: rgba(255, 255, 255, 0.5);
    }
</style>

<div class="page-header">
    <div class="row">
        <div class="col-lg-12">
            <h1>List</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table id="list_addresses_table" class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Recipient</th>
                <th scope="col">Address</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($addresses as $address) { ?>
                <tr class="table-primary">
                    <th scope="row"><?php echo $address->id; ?></th>
                    <td><?php echo $address->recipient; ?></td>
                    <td>
                        <?php echo $address->address1; ?>
                        <?php if (!empty($address->address2)) {
                            echo '<br>' . $address->address2;
                        } ?>
                        <br><?php echo $address->city . ', ' . $address->state . ' ' . $address->zip5 . (!empty($address->zip4) ? '-' . $address->zip4 : ''); ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once APP_ROOT_DIR . '/views/includes/scripts.php'; ?>

<script type="text/javascript">
    (() => $('#list_addresses_table').DataTable())();
</script>

<?php include_once APP_ROOT_DIR . '/views/includes/footer.php'; ?>
