<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <!-- Title shown in PDF Metadata -->
    <title>Proposal #{{ $proposal->id }} - {{ config('app.name') }}</title>

    <!-- Example: Simple styling for PDF.
         DomPDF supports only limited CSS. -->
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: DejaVu Sans, sans-serif; /* or a font DomPDF supports */
        }

        body {
            padding: 20px;
            color: #333;
            line-height: 1.4em;
        }

        header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        header img {
            height: 60px;
            margin-right: 20px;
        }

        header .app-name {
            font-size: 24px;
            font-weight: bold;
            color: #444;
        }

        h1, h2, h3, h4, h5 {
            margin-bottom: 10px;
            color: #555;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 8px;
            font-weight: bold;
            color: #000;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table th, .info-table td {
            text-align: left;
            padding: 8px;
            vertical-align: top;
        }

        .info-table th {
            background-color: #f5f5f5;
            width: 30%;
        }

        .features-list {
            list-style-type: disc;
            margin-left: 20px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>

<!-- Header with Logo + App Name -->
<header>
    <!-- Use an absolute path for DomPDF, e.g. public_path() -->
    <img src="{{ public_path('assets/logo.png') }}" alt="Logo">
    <div class="app-name">{{ config('app.name') }}</div>
</header>

<!-- Proposal Title -->
<h1>Proposal #{{ $proposal->id }}</h1>

<!-- Basic Information Table -->
<table class="info-table">
    <tr>
        <th>Title:</th>
        <td>{{ $proposal->title }}</td>
    </tr>
    <tr>
        <th>Status:</th>
        <td>{{ ucfirst($proposal->status) }}</td>
    </tr>
    <tr>
        <th>Associated Lead:</th>
        <td>{{ $proposal->lead->name ?? 'N/A' }}</td>
    </tr>
    @if($proposal->lead && $proposal->lead->email)
        <tr>
            <th>Lead Email:</th>
            <td>{{ $proposal->lead->email }}</td>
        </tr>
    @endif
    <tr>
        <th>Price:</th>
        <td>{{ number_format($proposal->price, 2) }}</td>
    </tr>
    <tr>
        <th>Discount (%):</th>
        <td>{{ $proposal->discount ?? 0 }}</td>
    </tr>
    <tr>
        <th>Total Price:</th>
        <td>{{ number_format($proposal->total_price, 2) }}</td>
    </tr>
    @if($proposal->budget)
        <tr>
            <th>Budget:</th>
            <td>{{ number_format($proposal->budget, 2) }}</td>
        </tr>
    @endif
    @if($proposal->start_date)
        <tr>
            <th>Start Date:</th>
            <td>{{ $proposal->start_date->format('Y-m-d') }}</td>
        </tr>
    @endif
    @if($proposal->deadline)
        <tr>
            <th>Deadline:</th>
            <td>{{ $proposal->deadline->format('Y-m-d') }}</td>
        </tr>
    @endif
</table>

<!-- Features Section -->
@if(!empty($proposal->features))
    <div class="section">
        <div class="section-title">Key Features</div>
        <ul class="features-list">
            @foreach($proposal->features as $feature)
                <li>{{ $feature['feature'] ?? '' }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Description Section -->
@if($proposal->description)
    <div class="section">
        <div class="section-title">Description</div>
        <p>{{ $proposal->description }}</p>
    </div>
@endif

<!-- Footer -->
<div class="footer">
    &copy; {{ date('Y') }} {{ config('app.name') }} - All rights reserved.
</div>

</body>
</html>
