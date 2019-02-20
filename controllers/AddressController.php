<?php

class AddressController {
    public function index() {
        $addresses = DatabaseService::db()->getAll();
        require_once APP_ROOT_DIR . '/views/address/index.php';
    }

    public function create() {
        $states = $this->getStates();
        require_once APP_ROOT_DIR . '/views/address/create.php';
    }

    private function getStates() {
        return ['AK', 'AL', 'AR', 'AZ', 'CA', 'CO', 'CT', 'DE', 'FL', 'GA', 'GU', 'HI', 'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA', 'MA', 'MD', 'ME', 'MI', 'MN', 'MO', 'MS', 'MT', 'NC', 'ND', 'NE', 'NH', 'NJ', 'NM', 'NV', 'NY', 'OH', 'OK', 'OR', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VA', 'VI', 'VT', 'WA', 'WI', 'WV', 'WY'];
    }

    public function verify($parameters) {
        $address = Address::fromArray($parameters);
        $verified = UspsService::verifier()->verify($address);
        if (!$verified) {
            $errorMessage = 'Verification failed';
            $states = $this->getStates();
            require_once APP_ROOT_DIR . '/views/address/create.php';
            exit;
        } else {
            $verified->recipient = $address->recipient;
            require_once APP_ROOT_DIR . '/views/address/verify.php';
        }
    }

    public function save($parameters) {
        $address = Address::fromArray(json_decode(base64_decode($parameters['save_address']), true));
        $saved = DatabaseService::db()->save($address);
        require_once APP_ROOT_DIR . '/views/address/save.php';
    }

    public function truncate() {
        DatabaseService::db()->truncate();
        header('Location: ' . APP_ROOT_URL);
    }
}
