@foreach (generate_calendar($year) as $month)
    <tr>
        {!! $month !!}
    </tr>
@endforeach
