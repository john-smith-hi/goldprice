<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SQL Query Executor</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="sqlForm">
                            <div class="form-group">
                                <textarea class="form-control" id="sqlQuery" rows="4" placeholder="Enter your SQL query here...">SHOW TABLES;</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Execute Query</button>
                        </form>
                        <div id="queryResult" class="mt-3">
                            <!-- Results will be displayed here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
    // Function to execute query
    function executeQuery(query) {
        const resultDiv = document.getElementById('queryResult');
        
        fetch(`database/execute-query`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ query: query })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.data && data.data.length > 0) {
                    // Create table for results
                    let table = '<table id="resultTable" class="table table-striped" style="width:100%">';
                    
                    // Add headers
                    table += '<thead><tr>';
                    Object.keys(data.data[0]).forEach(key => {
                        table += `<th>${key}</th>`;
                    });
                    table += '</tr></thead>';
                    
                    // Add rows
                    table += '<tbody>';
                    data.data.forEach(row => {
                        table += '<tr>';
                        Object.values(row).forEach(value => {
                            table += `<td>${value !== null ? value : ''}</td>`;
                        });
                        table += '</tr>';
                    });
                    table += '</tbody></table>';
                    
                    resultDiv.innerHTML = table;
                    
                    // Initialize DataTable
                    $('#resultTable').DataTable({
                        pageLength: 10,
                        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        language: {
                            search: "Search:",
                            lengthMenu: "Show _MENU_ entries",
                            info: "Showing _START_ to _END_ of _TOTAL_ entries",
                            infoEmpty: "Showing 0 to 0 of 0 entries",
                            infoFiltered: "(filtered from _MAX_ total entries)",
                            paginate: {
                                first: "«",
                                previous: "‹",
                                next: "›",
                                last: "»"
                            }
                        }
                    });
                } else {
                    resultDiv.innerHTML = '<div class="alert alert-info">Query executed successfully. No results found.</div>';
                }
            } else {
                resultDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => {
            resultDiv.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
        });
    }

    // Execute default query when page loads
    document.addEventListener('DOMContentLoaded', function() {
        executeQuery('SHOW TABLES;');
    });

    // Handle form submission
    document.getElementById('sqlForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const query = document.getElementById('sqlQuery').value.trim();
        executeQuery(query || 'SHOW TABLES;');
    });
    </script>
</body>
</html> 