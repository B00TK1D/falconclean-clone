<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    ini_set("extension", "php_mysqli.dll");

    // Create DB connection
    global $mysqli;
    $mysqli = new mysqli(config("mysql.web.host"), config("mysql.web.user"), config("mysql.web.password"), config("mysql.web.database"));

    // Define DB Schema
    global $dbSchema;
    $dbSchema = [
        "rooms" => [
            "table" => "rooms",
            "fields" => [
                "id" => "i",
                "name" => "s",
                "image" => "s",
                "lat" => "s",
                "lon" => "s",
                "width" => "i",
                "height" => "i",
            ],
            "sort" => [
                "name" => "ASC"
            ],
        ],
        "types" => [
            "table" => "types",
            "fields" => [
                "id" => "i",
                "name" => "s",
                "image" => "s",
                "cycleTime" => "i",
                "width" => "i",
                "height" => "i",
            ],
            "sort" => [
                "name" => "ASC"
            ],
        ],
        "machines" => [
            "table" => "machines",
            "fields" => [
                "id" => "i",
                "typeID" => "i",
                "roomID" => "i",
                "qr" => "i",
                "lat" => "s",
                "lon" => "s",
            ],
            "sort" => [
                "id" => "ASC"
            ],
        ],
        "users" => [
            "table" => "users",
            "fields" => [
                "id" => "i",
                "name" => "s",
            ],
            "sort" => [
                "name" => "ASC"
            ],
        ],
        "loads" => [
            "table" => "loads",
            "fields" => [
                "id" => "i",
                "userID" => "i",
                "machineID" => "i",
                "load" => "s",
            ],
            "sort" => [
                "load" => "ASC"
            ],
        ],
        "issues" => [
            "table" => "issues",
            "fields" => [
                "id" => "i",
                "machineID" => "i",
                "userID" => "i",
                "severity" => "i",
                "description" => "s",
            ],
            "sort" => [
                "severity" => "DESC"
            ],
        ],
    ];


    // MySQL interface functions

    function createObject($name, $fields) { // Create object in MySQL DB
        global $mysqli, $dbSchema;
        if (!isset($dbSchema[$name])) return; // Check table name exists
        $query = "INSERT INTO " . $name . " (";
        $types = "";
        $placeholders = "";
        $params = [];
        $first = true;
        foreach ($fields as $key => $field) { // Add fields
            if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
            $first ? $query .= $key : $query .= "," . $key;
            $first ? $placeholders .= "?" : $placeholders .= ",?";
            $types .= $dbSchema[$name]["fields"][$key];
            $params[] = $field;
            $first = false;
        }
        if (!count($params)) return; // Check at least one valid field exists
        $query .= ") VALUES (" . $placeholders . ");";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return mysqli_insert_id($mysqli); // Return ID of newly created object
    }
    

    function readObject($tables, $filters = [], $limit = 0, $sorts = []) { // List object(s) from MySQL DB, with optional filters (also can be used as select by setting $filter["id"], etc.)
        global $mysqli, $dbSchema;
        $names = [];
        $default = "";
        if (is_array($tables)) {
            $names = $tables;
        } else {
            $names[] = $tables;
            $default = $tables . ".";
        }
        if (!is_array($filters) || !is_array($sorts)) {
            error("internal-error");
        }
        $first = true;
        $second = true;
        $query = "";
        $types = "";
        $params = [];
        foreach ($names as $name) {
            if (!isset($dbSchema[$name])) {; // Check table name exists
                error("internal-error");
            }
            $first ? $query = "SELECT * FROM " . $name : ($second ? $query .= " INNER JOIN " . $name : ", " . $name);
        }
        if (count($filters)) { // Add filters to query
            $first = true;
            foreach ($filters as $key => $filter) {
                if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
                $first ? $query .= " WHERE " . $default . $key . "=?" : $query .= " AND " . $default . $key . "=?";
                $types .= $dbSchema[$name]["fields"][$key];
                $params[] = $filter;
                $first = false;
            }
        }
        if (count($sorts)) {  // Add parameter-defined sort values to query (overrides table-defined sort values)
            $first = true;
            foreach ($sorts as $key => $sort) {
                if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
                $first ? $query .= " ORDER BY " . $default . $key . " " . $sort: $query .= ", " . $default . $key . " " . $sort;
                //$types .= $dbSchema[$name]["fields"][$key];
                $first = false;
            }
        } else {
            $first = true;
            foreach ($names as $name) {
                if (isset($dbSchema[$name]["sort"])) { // Add table-defined sort values to query
                    foreach ($dbSchema[$name]["sort"] as $key => $sort) {
                        if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
                        $first ? $query .= " ORDER BY " . $name . "." . $key . " " . $sort: $query .= ", " . $name . "." . $key . " " . $sort;
                        //$types .= $dbSchema[$name]["fields"][$key];
                        $first = false;
                    }
                }
            }
        }
        if ($limit) {
            $query .= " LIMIT " . $limit;
        }
        $query .= ";";
        //debug($query);
        $stmt = $mysqli->prepare($query);
        if(count($params)) $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while($row = mysqli_fetch_array($result)) $rows[] = $row;
        if ($limit == 1) {
            if (count($rows)) {
                $rows = reset($rows); // If only one item requested, don't return array
            } else {
                $rows = null;
            }
        }
        return $rows;
    }

    function searchObject($name, $searches = [], $filters = [], $limit = 0, $sorts = []) { // Search object(s) from MySQL DB, with provided filters
        global $mysqli, $dbSchema;
        if (!is_array($filters) || !is_array($sorts) || !isset($dbSchema[$name])) {
            error("internal-error");
        }
        $query = "SELECT * FROM " . $name;
        $types = "";
        $params = [];
        $first = true;
        if (count($filters) || count($searches)) {
            $query .= " WHERE";
        }
        if (count($filters)) { // Add filters to query
            $first = true;
            foreach ($filters as $key => $filter) {
                if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
                $first ? $query .= " ( " . $name . "." . $key . "=?" : $query .= " AND " . $name . "." . $key . "=?";
                $types .= $dbSchema[$name]["fields"][$key];
                $params[] = $filter;
                $first = false;
            }
            $query .= " )";
            if (count($searches)) $query .= " AND";
        }
        $first = true;
        if (count($searches)) { // Add searches to query
            foreach ($searches as $key => $search) {
                if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
                $first ? $query .= " ( LOWER(" . $name . "." . $key . ") LIKE ?" : $query .= " OR LOWER(" . $name . "." . $key . ") LIKE ?";
                $types .= $dbSchema[$name]["fields"][$key];
                $params[] = $search;
                $first = false;
            }
            $query .= " )";
        }
        if (count($sorts)) {  // Add parameter-defined sort values to query (overrides table-defined sort values)
            $first = true;
            foreach ($sorts as $key => $sort) {
                if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
                $first ? $query .= " ORDER BY " . $name . "." . $key . " " . $sort: $query .= ", " . $name . "." . $key . " " . $sort;
                $first = false;
            }
        } elseif (isset($dbSchema[$name]["sort"])) { // Add table-defined sort values to query
            $first = true;
            foreach ($dbSchema[$name]["sort"] as $key => $sort) {
                if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
                $first ? $query .= " ORDER BY " . $name . "." . $key . " " . $sort: $query .= ", " . $name . "." . $key . " " . $sort;
                $first = false;
            }
        }
        if ($limit) {
            $query .= " LIMIT " . $limit;
        }
        $query .= ";";
        //debug([$query, $params]);
        $stmt = $mysqli->prepare($query);
        foreach ($params as $key => $param) $params[$key] = "%" . $param . "%";
        if(count($params)) $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while($row = mysqli_fetch_array($result)) $rows[] = $row;
        if ($limit == 1) {
            if (count($rows)) {
                $rows = reset($rows); // If only one item requested, don't return array
            } else {
                $rows = null;
            }
        }
        return $rows;
    }

    function updateObject($name, $fields, $filters = []) { // Update object(s) from MySQL DB, with filters to constain scope of update (update single object by setting $filter["id], etc.)
        global $mysqli, $dbSchema;
        if (!is_array($filters) || !isset($dbSchema[$name])) {
            error("internal-error");
        }
        $query = "UPDATE " . $name . " SET ";
        $types = "";
        $params = [];
        $first = true;
        foreach ($fields as $key => $field) {
            if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
            $first ? $query .= $name . "." . $key . "=?" : $query .= "," . $name . "." . $key . "=?";
            $types .= $dbSchema[$name]["fields"][$key];
            $params[] = $field;
            $first = false;
        }
        if (!count($params)) return; // Check at least one valid field exists
        if (count($filters)) { // Add filters to query
            $first = true;
            foreach ($filters as $key => $filter) {
                if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
                $first ? $query .= " WHERE " . $name . "." . $key . "=?" : $query .= " AND " . $name . "." . $key . "=?";
                $types .= $dbSchema[$name]["fields"][$key];
                $params[] = $filter;
                $first = false;
            }
        }
        $query .= ";";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return 1;
    }

    function deleteObject($name, $filters) { // Delete object(s) from MySQL DB specified by filters (at least one filter required to prevent accidentally table deletion)
        global $mysqli, $dbSchema;
        if (!is_array($filters) || !isset($dbSchema[$name])) {
            error("internal-error");
        }
        $query = "DELETE FROM " . $name;
        $types = "";
        $first = true;
        foreach ($filters as $key => $filter) { // Add filters to query
            if (!isset($dbSchema[$name]["fields"][$key])) continue; // Check field exists
            $first ? $query .= " WHERE " . $name . "." . $key . "=?" : $query .= " AND " . $name . "." . $key . "=?";
            $types .= $dbSchema[$name]["fields"][$key];
            $params[] = $filter;
            $first = false;
        }
        if (!count($params)) return; // Check at least one valid filter exists
        $query .= ";";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return 1;
    }

    function objectFields($name) {
        global $dbSchema;
        if (isset($dbSchema[$name])) {
            if (isset($dbSchema[$name]["protected"])) {
                $params = [];
                foreach ($dbSchema[$name]["fields"] as $field => $value) {
                    if (!in_array($field, $dbSchema[$name]["protected"])) {
                        $params[$field] = $value;
                    }
                }
                return $params;
            }
            return $dbSchema[$name]["fields"];
        }
        return [];
    }
?>