<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
        <h4>Admin Panel</h4>
        <ul class="nav flex-column mt-4">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.services.index') }}">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.admins.index') }}">Admins</a>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('admins.logout') }}">
                    @csrf
                    <input type="submit" value="logout" name="submit">
                </form>

            </li>
        </ul>
    </div>



    <!-- Main Content -->
    <div class="flex-fill p-4">
        @yield('content')
    </div>
</div>

</body>
</html>
