<?php
    class Person {
    
        // database connection and table name
        private $conn;
        private $table_name = "person_table";

   
        // object properties
        public $id;
        public $name;
        public $age;
        public $gender;
        public $occupation;
        public $city;
        public $photo_url;
        public $email;
        public $password;
        public $quote;
    
        // constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        // read all
        public function read() {
        
            // select all query
            $query = "SELECT
                            *
                        FROM
                            person_table";

        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // read one item
        public function readOne() {
        
            // query to read single record
            $query = "SELECT
                            *
                        FROM
                            person_table
                        WHERE
                            id = ?
                        LIMIT
                            0, 1";
        
            // prepare query statement
            $stmt = $this->conn->prepare( $query );
        
            // bind id of product to be updated
            $stmt->bindParam(1, $this->id);
        
            // execute query
            $stmt->execute();
        
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // set values to object properties
            $this->name = $row['name'];
            $this->age = $row['age'];
            $this->gender = $row['gender'];
            $this->occupation = $row['occupation'];
            $this->city = $row['city'];
            $this->photo_url = $row['photo_url'];
            $this->quote = $row['quote'];
        }

        // read one item
        public function get_by_id($id) {
        
            // query to read single record
            $query = "SELECT
                            *
                        FROM
                            person_table
                        WHERE
                            id = ?";
        
            // prepare query statement
            $stmt = $this->conn->prepare( $query );
        
            // bind id of product to be updated
            $stmt->bindParam(1, $id);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // authenticate
        public function authenticate($email, $password) {
        
            // select all query
            $query = "SELECT
                        id
                        FROM
                            person_table
                        WHERE
                            email = ? AND
                            password = ?
                        ";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            
            // bind
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $password);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // randomly select one user profile by gender
        public function get_random_by_gender($gender) {
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            person_table
                        WHERE
                            gender = ?
                        ORDER BY RAND()
                        LIMIT 1";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            
            $search_term = strtoupper($gender);
            // bind
            $stmt->bindParam(1, $gender);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // search by user's gender
        public function search_by_gender($search_term) {
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            person_table
                        WHERE
                            gender = ?
                        ORDER BY
                            id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            
            $search_term = strtoupper($search_term);
            // bind
            $stmt->bindParam(1, $search_term);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // search by user's age
        public function search_by_age($lower, $upper) {
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            person_table
                        WHERE
                            age >= ? AND
                            age <= ?
                        ORDER BY
                            id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // bind
            $stmt->bindParam(1, $lower);
            $stmt->bindParam(2, $upper);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // search by user's gender AND age
        public function search_by_gender_age($gender, $lower, $upper) {
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            person_table
                        WHERE
                            gender = ? AND
                            age >= ? AND
                            age <= ?
                        ORDER BY
                            id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // bind
            $stmt->bindParam(1, $gender);
            $stmt->bindParam(2, $lower);
            $stmt->bindParam(3, $upper);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // read with pagination
        public function readPaging($from_record_num, $records_per_page) {
        
            // select query
            $query = "SELECT
                        *
                        FROM
                            person_table
                        ORDER BY id
                        LIMIT ?, ?";
        
            // prepare query statement
            $stmt = $this->conn->prepare( $query );
        
            // bind variable values
            $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
            $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
        
            // execute query
            $stmt->execute();
        
            // return values from database
            return $stmt;
        }

        // used for paging
        public function count() {
            $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
        
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            return $row['total_rows'];
        }
    }
?>