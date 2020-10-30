<?php

// open the database connection
function sqlite_open($path) {
    $db = new SQLite3($path);
    return $db;
}

// converts the passed result into an array
function result_to_array($res) {
    $rows = array();
    $row = $res->fetchArray(SQLITE3_ASSOC);
    while ($row) {
        $rows[$row['id']] = $row;
        $row = $res->fetchArray(SQLITE3_ASSOC);
    }
    return $rows;
}

// build the json string with the raiders matching the specified parametres, if any
function get_raiders($db) {
    // check if parmetres exist
    $searchName = $_GET['name'] != null;
    $searchTimezone = $_GET['timezone'] != null;

    // build query
    $query = 'SELECT * FROM raiders';
    // parameters?
    if($searchName || $searchTimezone) {
        $query .= ' WHERE';
        // name matching
        if ($searchName) {
            $query .= ' name == :name';
            // connect conditions if necessary
            if ($searchTimezone) {
                $query .= ' AND';
            }
        }
        // timezone matching
        if ($searchTimezone) {
            $query .= ' timezone == :timezone';
        }
    }
    // semicolon \o/
    $query .= ';';

    // prepare statement
    $stm = $db->prepare($query);
    if ($stm == false) {
        echo ('{error: "could not prepare statement"}');
        echo ($query);
        return;
    }
    // bind parameters
    if($searchName) {
        $stm->bindParam(':name', $_GET['name']);
    }
    if($searchTimezone) {
        $stm->bindParam(':timezone', $_GET['time']);
    }

    // execute <3
    $res = $stm->execute();

    // echo out \o/
    echo(json_encode(result_to_array($res)));
}

// build the json string with the statics matching a passed id if any and resolved raiders if resolveNames is passed
function get_statics($db) {
    $searchId = $_GET['id'] != null;

    // build query
    $query = 'SELECT * FROM statics';
    // id matching
    if ($searchId) {
        $query .= ' WHERE id = :id';
    }
    // semicolon <3
    $query .= ';';

    // prepare statement
    $stm = $db->prepare($query);
    if ($stm == false) {
        echo ('{error: "could not prepare statement"}');
        echo ($query);
        return;
    }
    // bind parameters
    if ($searchId) {
        $stm->bindParam(':id', $_GET['id']);
    }
    // execute \o/
    $res = $stm->execute();

    // get as array
    $array = result_to_array($res);

    // resolve names if requested
    if ($_GET['resolveNames'] != "false") {
        // query raiders
        $res = $db->query("SELECT * FROM raiders;");
        // to array
        $raiders = result_to_array($res);
        
        // lambda to replace ids with objects matching the ids
        $func = function ($e) use (&$raiders) {
            $e['tank1'] = $raiders[$e['tank1']];
            $e['tank2'] = $raiders[$e['tank2']];

            $e['heal1'] = $raiders[$e['heal1']];
            $e['heal2'] = $raiders[$e['heal2']];

            $e['mdps1'] = $raiders[$e['mdps1']];
            $e['mdps2'] = $raiders[$e['mdps2']];

            $e['rdps1'] = $raiders[$e['rdps1']];
            $e['rdps2'] = $raiders[$e['rdps2']];
            
            return $e;
        };

        // map!
        $array = array_map($func, $array);
    }
    // echo \o/
    echo json_encode($array);
}

// build the json string with the timezones
function get_timezones($db) {
    $query = 'SELECT * FROM timezones;';
    $stm = $db->prepare($query);
    $res = $stm->execute();

    $rows = array();
    $row = $res->fetchArray(SQLITE3_ASSOC);
    while ($row) {
        $rows[sizeof($rows)] = $row;
        $row = $res->fetchArray(SQLITE3_ASSOC);
    }
    echo(json_encode(result_to_array($res)));
}

function get_data() {
    // open db
    $db = sqlite_open('data.db');
        
    // set header to json
    header('Content-Type: application/json');
    // switch on type
    switch(strtolower($_GET['type'])) {
        case 'raider':
            get_raiders($db);
        break;
        case 'static':
            get_statics($db);
        break;
        case 'timezone':
            get_timezones($db);
        break;
        default:
            json_encode(array('error' => 'Please specify type as either raider or static'));
    }

    // close db, duh
    $db->close();
}

get_data();