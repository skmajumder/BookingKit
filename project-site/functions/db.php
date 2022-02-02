<?php

// connect with database
$db_host_name = 'localhost';
$db_user_name = 'root';
$db_password = '';
$db_name = 'project_db';

/*
 * if $db_connection is failed to connected with database will send a error message, and it will stop running the project with die() function.
 */
$db_connection = mysqli_connect($db_host_name, $db_user_name, $db_password, $db_name)
or die("Database Error for Connection." . mysqli_error($db_connection));

/*
 * This function returns the number of rows in the result set.
 * It is generally used to check if data is present in the database or not.
 * it is mandatory to first set up the connection with the MySQL database.
*/
function get_row_count($result)
{
    return mysqli_num_rows($result);
}

function get_row_effect()
{
    global $db_connection;
    return mysqli_affected_rows($db_connection);
}

/*
 * It function escapes special characters in a string for an SQL statement.
 * This function is used to create a legal SQL string that can use in an SQL statement.
 * The given string is encoded to an escaped SQL string, taking into account the current character set of the connection.
*/
function get_escape_sql($string)
{
    global $db_connection;
    return mysqli_real_escape_string($db_connection, $string);
}

/*
 * This function is used to check the given query is failed or vice versa
 */
function get_confirm($result)
{
    global $db_connection;
    if (!$result) {
        die("Query Failed" . mysqli_error($db_connection));
    }
}

/*
 * This function is used to execute SQL queries on the database  like: Insert, Select, Update, Delete.
 * For other successful queries it will return TRUE. FALSE on failure.
 */
function get_query($query)
{
    global $db_connection;
    return mysqli_query($db_connection, $query);
    get_confirm($result);
}

/*
 * This function is used to fetches a result row as an associative array, numeric array, or both.
 * Return Values: It returns an array of strings that corresponds to the fetched row.
*/
function get_fetch_array($result)
{
    global $db_connection;
    return mysqli_fetch_array($result);
}
