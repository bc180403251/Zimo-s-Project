@extends('layouts.default')

@section('title','dashboard')

@section('styles')
    <style>

        .content {
            flex-grow: 1;
            padding: 1rem;
        }
        .flex-container {
            display: flex;
            flex-wrap: wrap;
        }
        .chart-container {
            flex: 1;
            min-width: 300px;
            position: relative;
            height: 40vh;
            width: 80vw;
            margin: 10px;
        }
    </style>
@endsection

    @section('head-scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @endsection
@section('content')
    <main class="content">
        <div class="container">
            <div class="flex-container">
                <div class="chart-container">
                    <div class="chart-label">Employee Statistics</div>
                    <canvas id="employeeChart"></canvas>
                </div>
                <div class="chart-container">
                    <div class="chart-label">Employee Gender</div>
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>
    </main>
@endsection
    @section('body-scripts')
        <script>
            function loadCharts() {
                $.ajax({
                    url: '{{ route('employee.stats') }}',
                    method: 'GET',
                    success: function(response) {
                        const employeeData = response.employees;
                        const labels = employeeData.map(data => data.company);
                        const employeeCounts = employeeData.map(data => data.Total);

                        const employeeCtx = document.getElementById('employeeChart').getContext('2d');
                        const employeeChart = new Chart(employeeCtx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Number of Employees',
                                    data: employeeCounts,
                                    backgroundColor: [
                                        'rgba(255, 99, 132)',
                                        'rgba(255, 159, 64 )',
                                        'rgba(255, 205, 86 )',
                                        'rgba(75, 192, 192 )',
                                        'rgba(54, 162, 235 )',
                                        'rgba(153, 102, 255 )',
                                        'rgba(201, 203, 207)'
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        'rgb(153, 102, 255)',
                                        'rgb(201, 203, 207)'
                                    ],
                                    borderWidth: 0.5
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        beginAtZero: true
                                    },
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                        const genderCtx = document.getElementById('genderChart').getContext('2d');
                        const genderChart = new Chart(genderCtx, {
                            type: 'pie',
                            data: {
                                labels: ['Female', 'Male', 'Others'],
                                datasets: [{
                                    label: 'Employee Gender',
                                    data: [
                                        response.femalePercentage,
                                        response.malePercentage,
                                        response.othersPercentage,
                                    ],
                                    backgroundColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                        'rgb(255, 205, 86)'
                                    ],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                const genders = ['Female', 'Male', 'Others'];
                                                return genders[tooltipItem.dataIndex] + ': ' + tooltipItem.raw + '%';
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                });
            }

            $(document).ready(function() {
                loadCharts();
            });
        </script>
    @endsection
