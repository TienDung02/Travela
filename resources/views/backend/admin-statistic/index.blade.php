@extends('backend.layouts.layout')

@section('title', 'Statistic And Report Management')
@section('content')
<div class="container py-4">
    <h2>Financial Report</h2>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Revenue</h5>
                    <p class="h4 text-success">{{ number_format($totalRevenue) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Operating Cost</h5>
                    <p class="h4 text-danger">{{ number_format($totalCost) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Profit</h5>
                    <p class="h4 text-primary">{{ number_format($profit) }}</p>
                </div>
            </div>
        </div>
    </div>
    <h4>Details</h4>
    <table class="min-w-full divide-y divide-gray-200 table table-bordered bg-white">
        <thead>
            <tr>
                <th></th>
                <th>Revenue</th>
                <th>Operating Cost</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Tours</th>
                <td>{{ number_format($tourRevenue) }}</td>
                <td>{{ number_format($tourCost) }}</td>
            </tr>
            <tr>
                <th>Packages</th>
                <td>{{ number_format($packageRevenue) }}</td>
                <td>{{ number_format($packageCost) }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection