<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Rescue - Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f8f5;
            color: #333;
        }

        header {
            background: #198754;
            color: white;
            padding: 18px 30px;
        }

        header h1 {
            margin-bottom: 12px;
        }

        header div {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        header a {
            background: white;
            color: #198754;
            padding: 9px 14px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        header a:hover {
            background: #e8f5e9;
        }

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            color: #198754;
            margin-bottom: 8px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            text-align: center;
        }

        .card h3 {
            color: #555;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .card .number {
            font-size: 32px;
            font-weight: bold;
            color: #198754;
        }

        .actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .action-btn {
            background: #198754;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .action-btn:hover {
            background: #146c43;
        }
    </style>
</head>

<body>

<header>
    <h1>🍱 Food Rescue</h1>

    <div>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('donations.index') }}">Available Food</a>
        <a href="{{ route('donations.create') }}">+ Donate Food</a>
        <a href="{{ route('food_requests.index') }}">Food Requests</a>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit"
                style="background:white; color:#198754; padding:9px 14px; border:none; border-radius:8px; font-weight:bold; font-size:14px; cursor:pointer;">
                Logout
            </button>
        </form>
    </div>
</header>

<div class="container">

    <div class="welcome">
        <h2>Welcome to Food Rescue 👋</h2>
        <p>Manage surplus food donations and requests from one place.</p>
    </div>

    <div class="cards">

        <div class="card">
            <h3>Total Donations</h3>
            <div class="number">
                {{ \App\Models\Donation::count() }}
            </div>
        </div>

        <div class="card">
            <h3>Total Requests</h3>
            <div class="number">
                {{ \App\Models\FoodRequest::count() }}
            </div>
        </div>

        <div class="card">
            <h3>Pending Requests</h3>
            <div class="number">
                {{ \App\Models\FoodRequest::where('status', 'pending')->count() }}
            </div>
        </div>

        <div class="card">
            <h3>Approved Requests</h3>
            <div class="number">
                {{ \App\Models\FoodRequest::where('status', 'approved')->count() }}
            </div>
        </div>

        <div class="card">
            <h3>Rejected Requests</h3>
            <div class="number">
                {{ \App\Models\FoodRequest::where('status', 'rejected')->count() }}
            </div>
        </div>

    </div>

    <div class="actions">
        <a class="action-btn" href="{{ route('donations.index') }}">
            View Donations
        </a>

        <a class="action-btn" href="{{ route('food_requests.index') }}">
            Manage Requests
        </a>

        <a class="action-btn" href="{{ route('donations.create') }}">
            Add Donation
        </a>
    </div>

</div>

</body>
</html>