<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast</title>
</head>
<body>
<h1>Dự báo thời tiết</h1>

@if(isset($error))
    <p style="color: red;">{{ $error }}</p>
@else
    <h2>Dự báo thời tiết tại {{ $weather['location']['name'] }}, {{ $weather['location']['country'] }}:</h2>

    @if(isset($weather['forecast']) && isset($weather['forecast']['forecastday']))
        <ul>
            @foreach($weather['forecast']['forecastday'] as $day)
                <li>
                    <strong>{{ \Carbon\Carbon::parse($day['date'])->format('d/m/Y') }}</strong>:
                    Nhiệt độ: {{ $day['day']['avgtemp_c'] }}°C,
                    Mô tả: {{ $day['day']['condition']['text'] }}
                </li>
            @endforeach
        </ul>
    @else
        <p>Không có dữ liệu dự báo thời tiết.</p>
    @endif
@endif
</body>
</html>
