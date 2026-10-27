<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "alamin";
    ini_set('date.timezone', 'Asia/Kolkata');
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
// function OpenCon()
// {
//     global $conn;
//     return $conn;
// }
/**
 * Helper function to determine the parameter type for mysqli::bind_param.
 *
 * @param mixed $param The parameter to check.
 * @return string The type character ('s', 'i', 'd').
 */
function getParamType($param)
{
    if (is_int($param)) {
        return 'i';
    } elseif (is_float($param)) {
        return 'd';
    } else {
        return 's';
    }
}

/**
 * Perform a secure database action using prepared statements.
 *
 * This improved version adds flexibility for SELECT statements and returns the last insert ID for INSERTs.
 * It also includes more robust parameter binding based on data types.
 *
 * @param string $table The name of the table.
 * @param int $action The action code (1=INSERT, 2=UPDATE, 3=DELETE, 4=SELECT).
 * @param array $data The associative array of data to insert or update.
 * @param array $options Optional settings for the query (e.g., where, orderBy, limit).
 * @return array The result of the operation.
 */
function dbAction($table, $action, $data = [], $where = '', $params = [])
{
    $conn = OpenCon();

    // Sanitize table name
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        return ['success' => false, 'error' => 'Invalid table name.'];
    }

    $sql = '';
    $types = '';
    $bindValues = [];

    try {
        switch ($action) {
            case 1: // INSERT
                $columns = implode(', ', array_map(fn($k) => "`$k`", array_keys($data)));
                $placeholders = implode(', ', array_fill(0, count($data), '?'));
                $sql = "INSERT INTO `$table` ($columns) VALUES ($placeholders)";
                $bindValues = array_values($data);
                foreach ($bindValues as $value) {
                    $types .= getParamType($value);
                }
                break;

            case 2: // UPDATE
                if (empty($where)) {
                    return ['success' => false, 'error' => 'Missing WHERE clause for update.'];
                }
                $set = implode(', ', array_map(fn($k) => "`$k` = ?", array_keys($data)));
                $sql = "UPDATE `$table` SET $set WHERE $where";
                $bindValues = array_merge(array_values($data), $params);
                foreach ($bindValues as $value) {
                    $types .= getParamType($value);
                }
                break;

            case 3: // DELETE
                if (empty($where)) {
                    return ['success' => false, 'error' => 'Missing WHERE clause for delete.'];
                }
                $sql = "DELETE FROM `$table` WHERE $where";
                $bindValues = $params;
                foreach ($bindValues as $value) {
                    $types .= getParamType($value);
                }
                break;

            case 4: // SELECT
                $columns = $data['columns'] ?? '*';
                $orderBy = $data['orderBy'] ?? '';
                $limit   = $data['limit'] ?? '';

                $columns = preg_replace('/[^a-zA-Z0-9_,`\s\*]+/', '', $columns);
                $orderBy = preg_replace('/[^a-zA-Z0-9_,`\s]+/', '', $orderBy);
                $limit   = preg_replace('/[^0-9,]+/', '', $limit);

                $sql = "SELECT $columns FROM `$table`";
                if ($where) $sql .= " WHERE $where";
                if ($orderBy) $sql .= " ORDER BY $orderBy";
                if ($limit) $sql .= " LIMIT $limit";
                $bindValues = $params;
                foreach ($bindValues as $value) {
                    $types .= getParamType($value);
                }
                break;

            default:
                return ['success' => false, 'error' => 'Invalid action code'];
        }

        $stmt = $conn->prepare($sql);
        if (!$stmt) throw new Exception($conn->error);

        if (!empty($bindValues)) {
            $stmt->bind_param($types, ...$bindValues);
        }

        $stmt->execute();

        if ($action === 1) {
            return ['success' => true, 'insert_id' => $conn->insert_id];
        }

        if ($action === 4) {
            $result = $stmt->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return ['success' => true, 'data' => $rows];
        }

        if ($action === 5) {
            $result = $stmt->get_result();
            $cols = $result->fetch_all(MYSQLI_ASSOC);
            // Flatten to just column names
            $fields = array_column($cols, 'COLUMN_NAME');
            return ['success' => true, 'data' => $fields];
        }

        return ['success' => true, 'affected_rows' => $stmt->affected_rows];
    } catch (Exception $e) {
        $logMessage = date('Y-m-d H:i:s') . " | ERROR: " . $e->getMessage() . "\nSQL: " . $sql . "\n\n";
        file_put_contents(__DIR__ . '/db_errors.log', $logMessage, FILE_APPEND);

        return [
            'success' => false,
            'error' => $e->getMessage(),
            'query' => $sql
        ];
    }
}
include_once "constant.php";
