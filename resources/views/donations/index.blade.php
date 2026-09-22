```php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Available Food | Food Rescue</title>

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
            min-height: 100vh;
        }

        header {
            background: #198754;
            color: white;
            padding: 18px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 25px;
        }

        header a {
            background: white;
            color: #198754;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        .heading {
            text-align: center;
            margin-bottom: 25px;
        }

        .heading h2 {
            font-size: 30px;
            margin-bottom: 8px;
            color: #198754;
        }

        .heading p {
            color: #666;
        }

        /* Success message */
        .success-message {
            background: #d1e7dd;
            color: #0f5132;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        /* Validation errors */
        .error-message {
            background: #f8d7da;
            color: #842029;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-message ul {
            margin-left: 20px;
        }

        .food-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .food-card {
            width: 100%;
            background: white;
            border-radius: 15px;
            padding: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .food-image {
            display:block;
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;

        }

        .no-image {
            width: 100%;
            height: 220px;
            background: #e9f5ed;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #198754;
        }

        .food-content {
            padding: 12px 5px 5px 5px;
        }

        .food-content h3 {
            font-size: 23px;
            margin-bottom: 10px;
            color: #222;
        }

        .food-type {
            display: inline-block;
            background: #e8f5e9;
            color: #198754;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .info {
            width: 100%;
            margin-top: 10px;
            padding: 11px;
            border-radius: 8px;
            background: #f4f8f5;
            color: #444;
            font-size: 14px;
        }

        /* Request form */
        .request-form {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #ddd;
        }

        .request-form h4 {
            margin-bottom: 10px;
            color: #198754;
            font-size: 18px;
        }

        .request-form input,
        .request-form textarea {
            width: 100%;
            padding: 11px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 14px;
        }

        .request-form textarea {
            height: 75px;
            resize: none;
        }

        .request-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #198754;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .request-btn:hover {
            background: #146c43;
        }

        .empty {
            text-align: center;
            background: white;
            padding: 50px 20px;
            border-radius: 15px;
            color: #777;
        }

        .empty h2 {
            margin-bottom: 10px;
        }

        /* Phone size */
        @media (max-width: 900px) {

            header {
                padding: 15px;
            }

            header h1 {
                font-size: 20px;
            }

            header a {
                padding: 8px 10px;
                font-size: 13px;
            }

            .container {
                padding: 20px 12px;
            }

            .heading h2 {
                font-size: 25px;
            }

            .food-card {
                padding: 12px;
            }

            .food-grid{
                grid-template-columns:repeat(2, 1fr);
            }

            .food-image,
            .no-image {
                height: 190px;
            }
        }
    </style>
</head>

<body>

<header>

    <h1>Food Rescue</h1>
 <div>

  @auth
 <a href="{{ route('dashboard')}}">
    Dashboard</a>

    <a href="{{ route('donations.index')}}">
        Available Food</a>

    <a href="{{ route('donations.create') }}">
        + Donate Food
    </a>

    <a href="{{route('food_requests.index')}}">
        Food Requests</a>

    <form method="POST" actions="{{route('logout')}}" style="display:inline;">
        @csrf

        <button type="submit">Logout</button>
</form>

@else

<a href="{{route('login')}}">Login</a>

<a href="{{route('register')}}">Register</a>

@endauth
</div>

</header>


<div class="container">

    <div class="heading">

        <h2>Available Food</h2>

        <p>
            Help rescue surplus food and reduce food waste.
        </p>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERROR MESSAGE --}}

    @if($errors->any())

        <div class="error-message">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    @if($donations->count() > 0)

        <div class="food-grid">

            @foreach($donations as $donation)

                <div class="food-card">

                    {{-- FOOD IMAGE --}}

                    @if($donation->image)

                        <img
                            src="{{ asset('storage/' . $donation->image) }}"
                            class="food-image"
                            alt="{{ $donation->food_name }}">

                    @else

                        <div class="no-image">
                            No image available
                        </div>

                    @endif


                    <div class="food-content">

                        <h3>
                            {{ $donation->food_name }}
                        </h3>


                        <span class="food-type">
                            {{ $donation->food_type }}
                        </span>


                        <div class="info">

                            <strong>Quantity:</strong>

                            {{ $donation->quantity }}
                            {{ $donation->quantity_unit }}

                        </div>


                        <div class="info">

                            <strong>Pickup:</strong>

                            {{ $donation->pickup_location }}

                        </div>


                        <div class="info">

                            <strong>Available until:</strong>

                            {{ $donation->available_until }}

                        </div>


                        @if($donation->description)

                            <div class="info">

                                {{ $donation->description }}

                            </div>

                        @endif


                        {{-- REQUEST FORM --}}

                        <form
                            action="{{ route('donations.request', $donation->id) }}"
                            method="POST"
                            class="request-form">

                            @csrf

                            <h4>Request This Food</h4>


                            <input
                                type="text"
                                name="requester_name"
                                placeholder="Your Name"
                                required>


                            <input
                                type="email"
                                name="requester_email"
                                placeholder="Your Email"
                                required>


                            <input
                                type="number"
                                name="requested_quantity"
                                placeholder="Quantity Required"
                                min="1"
                                max="{{ $donation->quantity }}"
                                required>


                            <textarea
                                name="message"
                                placeholder="Message (optional)"></textarea>


                            <button
                                type="submit"
                                class="request-btn">

                                Request Food

                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty">

            <h2>
                No Food available right now
            </h2>

            <p>
                Be the first person to donate surplus food.
            </p>

        </div>

    @endif

</div>

</body>

</html>
```

