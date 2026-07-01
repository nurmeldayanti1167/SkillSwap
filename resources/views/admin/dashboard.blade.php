<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
        <ul class="space-y-2">
            <li>Total Users: {{ $stats['users'] }}</li>
            <li>Total Skills: {{ $stats['skills'] }}</li>
            <li>Total Swaps: {{ $stats['swaps'] }}</li>
        </ul>
        <a href="{{ route('admin.users') }}" class="mt-4 inline-block text-blue-600 hover:underline">Manage Users</a>
    </div>
</body>
</html>