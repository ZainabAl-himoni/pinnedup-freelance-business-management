<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <!-- Title shown in PDF Metadata -->
    <title>Invoice #{{ $invoice->id }} - {{ config('app.name') }}</title>

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

<!-- Invoice Title -->
<h1>Invoice #{{ $invoice->id }}</h1>

<!-- Basic Information Table -->
<table class="info-table">
    <tr>
        <th>Amount:</th>
        <td>{{ number_format($invoice->amount, 2) }}</td>
    </tr>
    <tr>
        <th>Status:</th>
        <td>{{ $invoice->status }}</td>
    </tr>
    <tr>
        <th>Date:</th>
        <td>{{ optional($invoice->date)->format('Y-m-d') }}</td>
    </tr>
    @if($invoice->task)
        <tr>
            <th>Associated Task:</th>
            <td>{{ $invoice->task->name }}</td>
        </tr>
        @if($invoice->task->client ?? false)
            <tr>
                <th>Client Name:</th>
                <td>{{ $invoice->task->client->name ?? '' }}</td>
            </tr>
            <tr>
                <th>Client Email:</th>
                <td>{{ $invoice->task->client->email ?? '' }}</td>
            </tr>
        @endif
    @endif
</table>

<!-- (Optional) If you have a "description" field on invoices: -->
@if(!empty($invoice->description))
    <div class="section">
        <div class="section-title">Description</div>
        <p>{{ $invoice->description }}</p>
    </div>
@endif

<!-- Footer -->
<div class="footer">
    &copy; {{ date('Y') }} {{ config('app.name') }} - All rights reserved.
</div>

</body>
</html>
