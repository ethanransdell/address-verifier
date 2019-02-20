<?php

class UspsService {
    private static $verifierInstance = null;

    private $username;
    private $password;
    private $url;

    public function __construct($username, $password, $url) {
        $this->username = $username;
        $this->password = $password;
        $this->url = $url;
    }

    public static function verifier() {
        if (self::$verifierInstance === null) {
            self::$verifierInstance = new UspsService(USPS_USERNAME, USPS_PASSWORD, USPS_URL);
        }

        return self::$verifierInstance;
    }

    public function verify(Address $address) {
        $result = $this->makeGetRequest($this->url, [
            'API' => 'Verify',
            'XML' => '<AddressValidateRequest USERID="' . $this->username . '" PASSWORD="' . $this->password . '"><Revision>1</Revision>' . $address->toXml() . '</AddressValidateRequest>',
        ]);
        if (!$result || $result->getName() === 'Error' || !count($result->children()) || $result->children()[0]->children()[0]->getName() === 'Error') {
            return null;
        }
        $resultArray = json_decode(json_encode($result->children()[0]), true);
        $verified = new Address();
        $verified->id = $resultArray['@attributes']['ID'] ?? null;
        // USPS sends back the unit, apt, etc. on the address1 line, so we'll flip the lines to result in a normal address
        $verified->address1 = $resultArray['Address2'] ?? null;
        $verified->address2 = $resultArray['Address1'] ?? null;
        $verified->city = $resultArray['City'] ?? null;
        $verified->state = $resultArray['State'] ?? null;
        $verified->zip5 = $resultArray['Zip5'] ?? null;
        $verified->zip4 = $resultArray['Zip4'] ?? null;

        return $verified;
    }

    private function makeGetRequest($url, $data): SimpleXMLElement {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url . '?' . http_build_query($data, '', '&'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return new SimpleXMLElement($response);
        }
    }
}
