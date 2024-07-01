<!DOCTYPE html>
<html>
<head>
    <title>Update Status</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Update Status</h1>
    <form id="status-form">
        @csrf
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="active">Active</option>
            <option value="critical">Critical</option>
            <option value="inactive">Inactive</option>
        </select>
        <button type="button" onclick="updateStatus()">Update Status</button>
    </form>

    <script src="/js/status.js"></script>
    <script>
        function updateStatus() {
            var status = document.getElementById('status').value;
            handleStatusChange(status);
        }
    </script>
</body>
</html>
