<?php
    class Model
    {
        // Property declaration, in this case we are declaring a variable or handeler that points to the database connection, this will become a PDO object
        public $dbhandle;
            
        // Method to create database connection using PHP Data Objects (PDO) as the interface to SQLite
        public function __construct()
        {
            // Set up the database source name (DSN)
            $dsn = 'sqlite:./db/data.db';
            
            // Then create a connection to a database with the PDO() function
            try 
            {	
                // Change connection string for different databases, currently using SQLite
                $this->dbhandle = new PDO($dsn, 'user', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false,));
                // $this->dbhandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo 'Database connection created</br></br>';
            }
            catch (PDOEXception $e) 
            {
                echo "Can't connect to the database";
                // Generate an error message if the connection fails
                print new Exception($e->getMessage());
            }
        }

        public function dbCreateTable()
        {
            try 
            {
                $this->dbhandle->exec(
                    "CREATE TABLE modelData (id INTEGER PRIMARY KEY, x3dModelTitle TEXT, x3dCreationMethod TEXT);" . 
                    "CREATE TABLE brandData (id INTEGER PRIMARY KEY, brandName TEXT, drinkType TEXT, countryOfOrigin TEXT, introduced INTEGER, website TEXT, brandDescription TEXT);");
                return "Tables successfully created inside data.db file";
            }
            catch (PDOEXception $e)
            {
                print new Exception($e->getMessage());
            }

            $this->dbhandle = NULL;
        }

        public function dbInsertData()
        {
            try
            {
                $str = file_get_contents("application/model/data.json");
                $json = json_decode($str, true);
                $query = "";

                $counter = 0;

                foreach($json["modelData"] as $row)
                {
                    $query .= "REPLACE INTO modelData (id, x3dModelTitle, x3dCreationMethod) 
                    VALUES('
                    " . $counter . "', '
                    " . $row["x3dModelTitle"] . "', '
                    " . $row["x3dCreationMethod"] . "');";

                    $counter++;
                }

                $counter = 0;

                foreach($json["brandData"] as $row)
                {
                    $query .= "REPLACE INTO brandData (id, brandName, drinkType, countryOfOrigin, introduced, website, brandDescription) 
                    VALUES('
                    " . $counter . "', '
                    " . $row["brandName"] . "', '
                    " . $row["drinkType"] . "', '
                    " . $row["countryOfOrigin"] . "', '
                    " . $row["introduced"] . "', '
                    " . $row["website"] . "', '
                    " . $row["brandDescription"] . "');";

                    $counter++;
                }

                $this->dbhandle->exec($query);

                return "Data successfully inserted into database tables";
            }

            catch(PDOEXception $e) 
            {
                print new Exception($e->getMessage());
            }

            $this->dbhandle = NULL;
        }

        public function dbGetModelData()
        {
            try
            {
                // Prepare a statement to get all records from the Model_3D table
                $sql = 'SELECT * FROM modelData';
                // Use PDO query() to query the database with the prepared SQL statement
                $stmt = $this->dbhandle->query($sql);
                // Set up an array to return the results to the view
                $result = null;
                // Set up a variable to index each row of the array
                $i=-0;
                // Use PDO fetch() to retrieve the results from the database using a while loop
                while ($data = $stmt->fetch()) 
                {
                    // Write the database conetnts to the results array for sending back to the view
                    $result[$i]['x3dModelTitle'] = $data['x3dModelTitle'];
                    $result[$i]['x3dCreationMethod'] = $data['x3dCreationMethod'];
                    //increment the row index
                    $i++;
                }
            }
            catch (PDOEXception $e) {
                print new Exception($e->getMessage());
            }
            // Close the database connection
            $this->dbhandle = NULL;
            // Send the response back to the view
            return $result;
        }

        public function dbGetBrandData()
        {
            try
            {
                $sql = 'SELECT * FROM brandData';
                $stmt = $this->dbhandle->query($sql);
                $result = null;

                while ($data = $stmt->fetch()) 
                {
                    $result['brandName'] = $data['brandName'];
                    $result['drinkType'] = $data['drinkType'];
                    $result['countryOfOrigin'] = $data['countryOfOrigin'];
                    $result['introduced'] = $data['introduced'];
                    $result['website'] = $data['website'];
                    $result['brandDescription'] = $data['brandDescription'];
                }
            }
            catch (PDOEXception $e)
            {
                print new Exception($e->getMessage());
            }
            // Close the database connection
            $this->dbhandle = NULL;
            // Send the response back to the view
            return $result;
        }

        public function dbDeleteTable()
        {
            $sql = "DROP TABLE modelData; DROP TABLE brandData;";
            $this->dbhandle->exec($sql);

            return "Database tables successfully deleted";

            $this->dbhandle = NULL;
        }
    }
?>