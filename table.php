<?php

require_once 'cursor.php';

class table {

    private $table_name;

    public function __construct($table_name) {
        $query = "SELECT * FROM $table_name";
        $result = mysql_query($query);

        if ($result) {
            $this->table_name = $table_name;
        } else {
            die(mysql_error());
        }
    }

    public function count() {
        $query = "SELECT * FROM $this->table_name";
        $result = mysql_query($query);

        return mysql_num_rows($result);
    }

    public function insert($columns) {

        $parameters = $values = "";

        if (is_array($columns)) {

            $size = sizeof($columns);
            $counter = 0;

            foreach ($columns as $key => $value) {
                $key = mysql_real_escape_string($key);
                $value = mysql_real_escape_string($value);
                $parameters .= "$key";
                $values .= "'$value'";

                if ($counter + 1 != $size) {
                    $parameters .= ", ";
                    $values .= ", ";
                    $counter++;
                }
            }


            return "INSERT INTO $this->table_name ($parameters) VALUES ($values)";
        } else {
            die("Insert Parameter Must Be Of Type Array!");
        }
    }

    public function select($conditions = "", $variables = array()) {
        
        if($conditions != "" && !empty($variables)) {
            foreach ($variables as $variable=>$value) {
                $value = mysql_real_escape_string($value);
                $conditions = str_replace(":".$variable, "'".$value."'", $conditions);
            }
        }elseif ($conditions != "" && empty ($variables)) {
            die("Please provide the variables to the query!");
        }

        $query = "SELECT * FROM $this->table_name " . $conditions;

        $cursor = new cursor($query);

        return $cursor;
    }

}
?>
