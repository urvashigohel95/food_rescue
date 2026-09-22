<!Doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Donate Food | Food Rescue</title>

        <style>
            *{
                box-sizing: border-box;
                margin:0;
                padding:0;
            }

        body{
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            padding: 40px 20px;
        }

        .container{
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius:15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        h1{
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle{
            text-align:center;
            color: #666;
            margin-bottom: 30px;
        }

        .form-group{
            margin-bottom: 20px;
        }

        label{
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea{
            width:100%;
            padding:12px;
            border:1px solid #ddd;
            border-radius: 8px;
            font-size:15px;
        }

        textarea{
            height: 100px;
            resize: vertical;
        }

        button{
            width:100%;
            padding:14px;
            border:none;
            border-radius:8px;
            background: $198754;
            color:white;
            font-size:17px;
            cursor:pointer;
        }


        button:hover{
            background: #146c43;
        }
      
        header div{
            display:flex;
            gap:8px;
            flex-wrap:wrap;
        }

        header div a{
            background:white;
            color:#198754;
            padding:9px 14px;
            text-decoration:none;
            border-radius:8px;
            font-weight:bold;
            font-size:14px;
            display:inline-block;
        }

        header div a:hover{
            background:#e8f5e9;
        }


        </style>
        </head>

        <header>
            <h1>Food Rescue</h1>

            <div>
                <a href="{{ route('dashboard')}}">
                    Dashboard</a>

                <a href="{{ route('donations.index')}}">
                    Available Food</a>
                
                <a href="{{ route('donations.create')}}">
                    +Donate Food</a>

                <a href="{{ route('food_requests.index')}}">
                    Food Requests</a>
</div>
</header>

        <body>
            <div class="container">
                <h1> Donate Surplus Food</h1>
                <p class="subtitle">
                    Your extra food can become someone's meal.
</p>

<form action="{{ route('donations.store') }}" method="POST"
enctype="multipart/form-data">
@csrf

<div class="form-group">
    <label>Food Name</label>
    <input type="text"
    name="food_name"
    placeholder="Example: Vegetable Biryani"
    required>

</div>

<div class="form-group">
    <label>Food Type</label>

    <select name="food_type" required>
        <option value="">Select food type</option>
        <option value="Vegetarian">Vegetarian</option>
        <option value="Vegan">Vegan</option>
        <option value="Bakery">Bakery</option>
        <option value="Other">Other</option>
</select>
</div>


<div class="form-group">
    <label>Quantity</label>
    <input type="number"
           name="quantity"
           main="1"
           placeholder="Example: 50"
           required>
</div>

<div class="form-group">
    <label>Quantity Unit</label>

    <select name="quantity_unit">
        <option value="plates">Plates</option>
        <option value="kg">Kg</option>
        <option value="packets">Packates</option>
        <option value="boxes">Boxes</option>
</select>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="description"
     placeholder="Describe the food..."></textarea>
</div>

<div class="form-group">
    <label>Pickup Lacation</label>

    <input type="text"
           name="pickup_location"
           placeholder="Enter pickup location"
           required>
</div>

<div class="form-group">
    <label>Available Until</label>

    <input type="datetime-local"
           name="available_until"
           required>
</div>

<div class="form-group">
    <label>Food Image</label>

    <input type="file"
           name="image"
           accept="image/*">
</div>

<button type="submit">
    Donate Food
</button>

</form>
</div>

</body>
</html>