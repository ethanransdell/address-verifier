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
                <th scope="col">Address 1</th>
                <th scope="col">Address 2</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">Zip5</th>
                <th scope="col">Zip4</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($addresses as $address) { ?>
                <tr class="table-primary">
                    <th scope="row"><?php echo $address->id; ?></th>
                    <td><?php echo $address->recipient; ?></td>
                    <td><?php echo $address->address1 ?></td>
                    <td><?php echo $address->address2 ?></td>
                    <td><?php echo $address->city; ?></td>
                    <td><?php echo $address->state; ?></td>
                    <td><?php echo $address->zip5; ?></td>
                    <td><?php echo $address->zip4; ?></td>
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
