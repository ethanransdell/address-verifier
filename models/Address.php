<?php

class Address {
    public $id;
    public $recipient;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $zip5;
    public $zip4;

    public static function fromArray($array) {
        $address = new Address();
        $address->id = $array['id'] ?? null;
        $address->recipient = $array['recipient'] ?? null;
        $address->address1 = $array['address1'] ?? null;
        $address->address2 = $array['address2'] ?? null;
        $address->city = $array['city'] ?? null;
        $address->state = $array['state'] ?? null;
        $address->zip5 = $array['zip5'] ?? null;
        $address->zip4 = $array['zip4'] ?? null;

        return $address;
    }

    public function toXml(): string {
        return '
            <Address ID="' . ($this->id ?? 0) . '">
                <Address1>' . $this->address1 . '</Address1>
                <Address2>' . $this->address2 . '</Address2>
                <City>' . $this->city . '</City>
                <State>' . $this->state . '</State>
                <Zip5>' . $this->zip5 . '</Zip5>
                <Zip4>' . $this->zip4 . '</Zip4>
            </Address>
        ';
    }
}
