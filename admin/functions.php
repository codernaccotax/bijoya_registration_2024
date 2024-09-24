<?php
function generateBootstrapTable($data)
{
    try {
       
        // If no data is returned, display a message
        if (empty($data)) {
            return "<div class='alert alert-warning'>No data found.</div>";
        }

        // Generate the table's opening HTML tags
        $html = "<table class='table table-striped table-bordered'>";

        // Get column headers
        $columns = array_keys($data[0]);
        
        // Create table header
        $html .= "<thead><tr>";
        foreach ($columns as $column) {
            $html .= "<th>" . htmlspecialchars($column) . "</th>";
        }
        $html .= "</tr></thead>";
        
        // Create table body
        $html .= "<tbody>";
        foreach ($data as $row) {
            $html .= "<tr>";
            foreach ($row as $value) {
                $html .= "<td>" . htmlspecialchars($value) . "</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</tbody>";

        // Close table tag
        $html .= "</table>";

        // Return the generated table
        return $html;
    } catch (PDOException $e) {
        // Return error message if something goes wrong
        return "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>