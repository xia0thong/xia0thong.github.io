<?php
    class Drink {
    
        // database connection and table name
        private $conn;
        private $table_name = "drink_table";

   
        // object properties
        public $id;
        public $name;
        public $category;
        public $alcoholic;
        public $glass;
        public $instructions;
        public $photo_url;
        public $ingredient1;
        public $ingredient2;
        public $ingredient3;
        public $ingredient4;
        public $ingredient5;
        public $ingredient6;
        public $ingredient7;
        public $ingredient8;
        public $ingredient9;
        public $ingredient10;
    
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
                            drink_table";

        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // read categories
        public function get_categories() {
        
            // query to read single record
            $query = "SELECT
                            distinct(category)
                        FROM
                            drink_table
                        ORDER BY category";
        
            // prepare query statement
            $stmt = $this->conn->prepare( $query );
        
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
                            drink_table
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
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->category = $row['category'];
            $this->alcoholic = $row['alcoholic'];
            $this->glass = $row['glass'];
            $this->instructions = $row['instructions'];
            $this->photo_url = $row['photo_url'];
            $this->ingredient1 = $row['ingredient1'];
            $this->ingredient2 = $row['ingredient2'];
            $this->ingredient3 = $row['ingredient3'];
            $this->ingredient4 = $row['ingredient4'];
            $this->ingredient5 = $row['ingredient5'];
            $this->ingredient6 = $row['ingredient6'];
            $this->ingredient7 = $row['ingredient7'];
            $this->ingredient8 = $row['ingredient8'];
            $this->ingredient9 = $row['ingredient9'];
            $this->ingredient10 = $row['ingredient10'];
        }

        // read one item
        public function get_by_id($id) {
        
            // query to read single record
            $query = "SELECT
                            *
                        FROM
                            drink_table
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

        // search by alcoholic (or not)
        public function search_by_alcoholic($search_term) {

            $search_term = strtoupper($search_term);
            if($search_term == 'NONALCOHOLIC') {
                $search_term = 'NON ALCOHOLIC';
            }
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            drink_table
                        WHERE
                            UPPER(alcoholic) = ?
                        ORDER BY
                            id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            
            
            // bind
            $stmt->bindParam(1, $search_term);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }


        // search by category
        public function search_by_category($search_term) {
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            drink_table
                        WHERE
                            UPPER(category) = ?
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

        // search by category, alcoholic, and name
        // search by (optional) category, (optional) alcoholic, and (optional) name substring
        public function search_by_category_alcoholic_name($category, $alcoholic, $name) {

            // Normalize inputs
            $category  = trim($category);
            $alcoholic = trim($alcoholic);
            $name      = trim($name);

            // Normalize alcoholic values like "nonalcoholic", "Non-alcoholic" → "NON ALCOHOLIC"
            if ($alcoholic !== '') {
                $norm = strtoupper(str_replace([' ', '-'], '', $alcoholic)); // remove spaces/hyphens
                if ($norm === 'NONALCOHOLIC') {
                    $alcoholic = 'NON ALCOHOLIC';
                } else {
                    $alcoholic = strtoupper($alcoholic);
                }
            }

            $conds  = [];
            $params = [];

            // Add conditions only when the corresponding argument is provided
            if ($category !== '') {
                $conds[]  = 'TRIM(UPPER(category)) = ?';
                $params[] = strtoupper($category);
            }

            if ($alcoholic !== '') {
                $conds[]  = 'TRIM(UPPER(alcoholic)) = ?';
                $params[] = strtoupper($alcoholic); // now "ALCOHOLIC" or "NON ALCOHOLIC"
            }

            if ($name !== '') {
                $conds[]  = 'UPPER(name) LIKE ?';
                $params[] = '%' . strtoupper($name) . '%';
            }

            // If no filters provided, select all
            $where = $conds ? implode(' AND ', $conds) : '1=1';

            $query = "SELECT
                        *
                      FROM
                        drink_table
                      WHERE
                        {$where}
                      ORDER BY
                        id";

            $stmt = $this->conn->prepare($query);

            // Bind in order
            foreach ($params as $i => $p) {
                // PDO bindValue is convenient for dynamic parameter lists (1-indexed)
                $stmt->bindValue($i + 1, $p);
            }

            $stmt->execute();
            return $stmt;
        }



        // search by name (substring)
        public function search_by_name($search_term) {
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            drink_table
                        WHERE
                            UPPER(name) LIKE ?
                        ORDER BY
                            id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            
            // prepare search term with wildcards
            $search_term = "%" . strtoupper($search_term) . "%";
            
            // bind
            $stmt->bindParam(1, $search_term);
        
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
                            drink_table
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