{{-- filepath: resources/views/backend/admin-statistic/index.blade.php --}}
@extends('backend.layouts.layout')

@section('title', 'Statistic And Report Management')
@section('content')
<div class="container py-4">
    <h2>Financial Report</h2>
    <div class="mb-4">
        <h4>Total Revenue (All Time): <span class="text-success">{{ number_format($totalRevenue) }}</span></h4>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h4>Revenue by Month</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthlyRevenue as $row)
                        <tr>
                            <td>{{ $row->month }}</td>
                            <td>{{ number_format($row->revenue) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h4>Revenue by Year</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($yearlyRevenue as $row)
                        <tr>
                            <td>{{ $row->year }}</td>
                            <td>{{ number_format($row->revenue) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h4>Revenue by Month & Type</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Type</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthlyTypeRevenue as $row)
                        <tr>
                            <td>{{ $row->month }}</td>
                            <td>{{ ucfirst($row->item_type) }}</td>
                            <td>{{ number_format($row->revenue) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h4>Revenue by Year & Type</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Type</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($yearlyTypeRevenue as $row)
                        <tr>
                            <td>{{ $row->year }}</td>
                            <td>{{ ucfirst($row->item_type) }}</td>
                            <td>{{ number_format($row->revenue) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection