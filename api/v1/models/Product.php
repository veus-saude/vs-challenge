<?php
class Product {
    private $conn;
    private $table = 'products';
    public $product_id;
    public $product_name;
    public $brand;
    public $price;
    public $amount;
    public $q;
    public $filter;
    public $order;
    public $limit;
    public $offset;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        if (isset($this->q)) {
            $query .= ' WHERE product_name LIKE "%' . $this->q . '%"';
        }

        if (isset($this->filter)) {
            $query .= isset($this->q) ? ' AND ' : ' WHERE ';

            $filters = explode(',', $this->filter);
            $parsedFilters = [];

            foreach ($filters as $singleFilterString) {
                $criteria = explode(':', $singleFilterString);
                $value = $criteria[1];
                preg_match('/(\w*)(\[\w*\])?/', $criteria[0], $matches);
                $field = $matches[1];
                $operator = $matches[2] ?? '[eq]';
                $parsedFilters[] = [$field, $operator, $value];
            }

            foreach ($parsedFilters as $parsedFilters) {
                $operators = [
                    '[gte]' => '>=',
                    '[lte]' => '<=',
                    '[eq]' => '=',
                    '[gt]' => '>',
                    '[lt]' => '<'
                ];
                $query .= $parsedFilters[0] . $operators[$parsedFilters[1]] . "'" . $parsedFilters[2] . "'";
                if (next($filters) == true) $query .= " AND ";
            }   
        }

        if (isset($this->order)) {
            $query .= ' ORDER BY ';
            $order_array = explode(',', $this->order);
            foreach($order_array as $order_name) {
                $operator = '';
                if (strpos($order_name, '[desc]')) {
                    $operator = ' DESC';
                }
                $order_name = preg_replace('/\[.*\]/', '', $order_name);
                $query .= $order_name . $operator;

                if (next($order_array) == true) $query .= ",";
            }
        }

        if (isset($this->limit)) {
            $query .= ' LIMIT ' . $this->limit;
        }

        if (isset($this->offset)) {
            $query .= ' OFFSET ' . $this->offset;
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $query = 'SELECT product_id, product_name, brand, price, amount FROM ' . $this->table . ' WHERE product_id=? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->product_id);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->product_id = $row['product_id'];
        $this->product_name = $row['product_name'];
        $this->brand = $row['brand'];
        $this->price = $row['price'];
        $this->amount = $row['amount'];
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table .
                    '(product_name, brand, price, amount)
                  VALUES
                    (:product_name, :brand, :price, :amount)';
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->product_name));
        $this->title = htmlspecialchars(strip_tags($this->brand));
        $this->title = htmlspecialchars(strip_tags($this->price));
        $this->title = htmlspecialchars(strip_tags($this->amount));

        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':brand', $this->brand);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':amount', $this->amount);

        if ($stmt->execute()) {
            return true;
        }
        printf('Error: %s.\n', $stmt->error);
        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . '
        SET
            product_name = :product_name,
            brand = :brand,
            price = :price,
            amount = :amount
        WHERE
            product_id = :product_id';

        $stmt = $this->conn->prepare($query);

        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->amount = htmlspecialchars(strip_tags($this->amount));

        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':brand', $this->brand);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':amount', $this->amount);


        if ($stmt->execute()) {
            return true;
        }
        printf('Error: %s.\n', $stmt->error);
        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE product_id = :product_id';
        $stmt = $this->conn->prepare($query);
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $stmt->bindParam(':product_id', $this->product_id);
        if ($stmt->execute()) {
            return true;
        }
        printf('Error: %s.\n', $stmt->error);
        return false;
    }
}