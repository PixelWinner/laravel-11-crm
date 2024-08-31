@vite(['resources/css/statistics.css'])
@vite(['resources/js/statistics.js'])
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Статистика заказов</h1>

        <form action="{{ route('statistics') }}" method="GET">
            <div class="filter-section">
                <div class="form-group">
                    <label for="year">Год:</label>
                    <select name="year" id="year" onchange="this.form.submit()">
                        @foreach($availableYears as $availableYear)
                            <option value="{{ $availableYear }}" {{ $availableYear == $year ? 'selected' : '' }}>
                                {{ $availableYear }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div class="charts-container">
            <div>
                <canvas id="ordersByStatusChart"></canvas>
                <div id="ordersByStatusData" data-labels='@json($ordersByStatus->keys())'
                     data-data='@json($ordersByStatus->values())' data-year="{{ $year }}"></div>
            </div>

            <div>
                <canvas id="ordersByMonthChart"></canvas>
                <div id="ordersByMonthData" data-data='@json(array_values($months))' data-year="{{ $year }}"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
