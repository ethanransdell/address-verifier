<?php

class DatabaseService {
    private static $dbInstance = null;

    private $connection;

    public function __construct($dbHost, $dbName, $dbUser, $dbPassword) {
        $this->connection = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName, $dbUser, $dbPassword,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    public static function db(): DatabaseService {
        if (self::$dbInstance === null) {
            self::$dbInstance = new DatabaseService(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
        }

        return self::$dbInstance;
    }

    public function save(Address $address): Address {
        $statement = $this->connection->prepare('insert into address (recipient, address1, address2, city, state, zip5, zip4) values (:recipient, :address1, :address2, :city, :state, :zip5, :zip4);');
        $statement->bindValue(':recipient', $address->recipient, PDO::PARAM_STR);
        $statement->bindValue(':address1', $address->address1, PDO::PARAM_STR);
        if (!empty($address->address2)) {
            $statement->bindValue(':address2', $address->address2, PDO::PARAM_STR);
        } else {
            $statement->bindValue(':address2', null, PDO::PARAM_NULL);
        }
        $statement->bindValue(':city', $address->city, PDO::PARAM_STR);
        $statement->bindValue(':state', $address->state, PDO::PARAM_STR);
        $statement->bindValue(':zip5', $address->zip5, PDO::PARAM_STR);
        if (!empty($address->zip4)) {
            $statement->bindValue(':zip4', $address->zip4, PDO::PARAM_STR);
        } else {
            $statement->bindValue(':zip4', null, PDO::PARAM_NULL);
        }
        $statement->execute();
        $address->id = $this->connection->lastInsertId();

        return $address;
    }

    public function getAll(): array {
        $statement = $this->connection->prepare('select * from address order by id desc;');
        $statement->execute();
        $addresses = [];
        while ($result = $statement->fetch()) {
            $addresses[] = Address::fromArray($result);
        }

        return $addresses;
    }

    public function truncate() {
        $this->connection->prepare('truncate table address;')->execute();
    }
}
