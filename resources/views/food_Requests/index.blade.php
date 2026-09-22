<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Requests | Food Rescue</title>

    <style>
        *{
            box-sizing:border-box;
            margin:0;
            padding:0;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f4f8f5;
            color:#333;
            min-height:100vh;
        }

        header{
            background:#198754;
            color:white;
            padding:18px 25px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        header h1{
            font-size:24px;
        }

        header a{
            background:white;
            color:#198754;
            padding: 9px 15px;
            text-decoration:none;
            border-radius:8px;
            font-weight:bold;
        }

        .container{
            width:100%;
            max-width:900px;
            margin:auto;
            padding:30px 20px;

        }

        .heading{
            text-align:center;
            margin-bottom:25px;
        }

        .heading h2{
            color: #198754;
            font-size:30px;
            margin-bottom:8px;
        }


        .heading p{
            color:#666;
        }

        .success{
            background:#d1e7dd;
            color:#0f5132;
            padding:13px;
            border-radius:8px;
            margin-bottom:20px;
            text-align:center;
            font-weight:bold;
        }

        .request-card{
            background:white;
            border-radius:15px;
            padding:20px;
            margin-bottom:20px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
        }

        .request-card h3{
            color: #198754;
            margin-bottom:12px;
        }

        .info{
            background:#f4f8f5;
            padding:10px;
            margin-top:8px;
            border-radius:7px;
            font-size:14px;
        }

        .status{
            display:inline-block;
            padding:6px 12px;
            border-radius:20px;
            margin-top:12px;
            font-size:13px;
            font-weight:bold;
            text-transform:capitalize;
        }

        .pending{
            background:#fff3cd;
            color:#856404;

        }

        .approved{
            background:#d1e7dd;
            color:#0f5132;
        }

        .rejected{
            background:#f8d7da;
            color:#842029;
        }

        .actions{
            display:flex;
            gap:10px;
            margin-top:18px;
        }

        .approve-btn,
        .reject-btn{
            flex:1;
            padding:11px;
            border:none;
            border-radius:8px;
            color:white;
            font-weight:bold;
            cursor:pointer;
        }

        .approve-btn{
            background:#198754;
        }

        .approve-btn:hover{
            background:#146c43;
        }

        .reject-btn{
            background:#dc3545;
        }

        .reject-btn:hover{
            background:#bb2d3b;
        }

        .empty{
            background:white;
            text-align:center;
            padding:50px 20px;
            border-radius:15px;
            color:#777;

        }

        @media(max-width:600px){
            header{
                padding:15px;
            }

            header h1{
                font-size:20px;
            }

            header a{
                font-size:13px;
                padding:8px 10px;
            }

            .heading h2{
                font-size:25px;

            }
            .actions{
                flex-direction: column;
            }
        }

        </style>
        </head>

        <body>
            <header>
                <h1>Food Rescue</h1>
         <div>
            <a href="{{route('dashboard')}}" style="margin-right:8px;">Dashboard</a>
                <a href="{{route('donations.index')}}">
                    Available Food</a>
</div>

</header>

<div class="container">
    <div class="heading">
        <h2>Food Requests</h2>

        <p>Manage requests for donated food.</p>

</div>

@if(session('success'))

<div class="success">
    {{session('success')}}</div>

    @endif

    @if($request->count() > 0)

    @foreach($request as $foodRequest)

    <div class="request-card">

    <h3>
        {{$foodRequest->donation->food_name}}</h3>


        <div class="info">
            <strong>Requester:</strong>
            {{$foodRequest->requester_name}}</div>


            <div class="info">
                <strong>Email:</strong>
                {{$foodRequest->requester_email}}
</div>

<div class="info">
    <strong>Quantity Requested:</strong>
    {{$foodRequest->requested_quantity}}
    {{$foodRequest->donation->quantity_unit}}</div>


    @if($foodRequest->message)

    <div class="info">
        <strong>Message:</strong>
        {{$foodRequest->message}}</div>

        @endif

        <span class="status{{$foodRequest->status}}">
            {{$foodRequest->status}}
</span>

@if($foodRequest->status === "pending")

 <div class="actions">

 <form action="{{ route('food_requests.approve',$foodRequest->id) }}"
 method="POST" style="flex:1;">
 
 @csrf

 <button type="submit" class="approve-btn">Approve</button>

</form>

<form action="{{route('food_requests.reject',$foodRequest->id)}}"
 method="POST" style="flex:1;">

 @csrf

 <button type="submit" class="reject-btn">Reject </button>

</form>
</div>
@endif
</div>
@endforeach

@else

<div class="empty">
    <h2>No food requests yet</h2>
    <p>Requests from users will appear here.</p>

</div>
@endif
</div>
</body>
</html>