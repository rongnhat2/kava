@extends('admin.layout')
@section('title', 'Transaction')
@section('menu-data')
<input type="hidden" name="" class="menu-data" value="statistic-group | statistic">
@endsection()

@section('css')

@endsection()

@section('body')

<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-dollar"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">${{ $profit }}</h2>
                        <p class="m-b-0 text-muted">Volumn Boost</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-gold">
                        <i class="anticon anticon-profile"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ number_format($transactions, 0, ',', '.') }}</h2>
                        <p class="m-b-0 text-muted">Transactions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-purple">
                        <i class="anticon anticon-user"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ number_format($accounts, 0, ',', '.') }}</h2>
                        <p class="m-b-0 text-muted">Accounts</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="m-t-50" style="height: 330px">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas class="chart chartjs-render-monitor" id="revenue-chart" style="display: block; width: 989px; height: 330px;" width="989" height="330"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" value="{{ json_encode($transaction_data) }}" id="transaction-list">


@endsection()

@section('js')



<script>
    // Chart by hour, process data via #transaction-list
    const transactionList = JSON.parse(document.getElementById('transaction-list').value);

    // Assuming transactionList is an array of objects with a "created_at" or "hour" property,
    // and we want to count the number of transactions per hour in a 24h period.

    // Prepare an array of hour labels ("00", "01", ..., "23")
    const hours = Array.from({
        length: 24
    }, (_, i) => i.toString().padStart(2, '0'));

    // Initialize transaction count for each hour
    const hourlyTransactionCounts = Array(24).fill(0);

    // Assume each transaction has a 'created_at' datetime (e.g., "2024-06-02 14:23:00")
    transactionList.forEach(tx => {
        let hour = null;

        // Try parsing hour from 'created_at' if present
        if (tx.created_at) {
            // Extract hour part, assuming format "YYYY-MM-DD HH:mm:ss"
            hour = new Date(tx.created_at).getHours();
        } else if (tx.hour !== undefined) {
            // Or take the hour directly if provided
            hour = typeof tx.hour === 'string' ? parseInt(tx.hour, 10) : tx.hour;
        }

        if (hour !== null && hour >= 0 && hour < 24) {
            hourlyTransactionCounts[hour]++;
        }
    });

    const revenueChartConfig = new Chart(document.getElementById("revenue-chart").getContext('2d'), {
        type: 'line',
        data: {
            labels: hours,
            datasets: [{
                label: 'Transactions per hour',
                backgroundColor: "transparent",
                borderColor: "blue",
                pointBackgroundColor: "blue",
                pointBorderColor: "white",
                pointHoverBackgroundColor: "blue",
                pointHoverBorderColor: "blue",
                data: hourlyTransactionCounts
            }]
        },
        options: {
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            responsive: true,
            hover: {
                mode: 'nearest',
                intersect: true
            },
            tooltips: {
                mode: 'index'
            },
            scales: {
                xAxes: [{
                    ticks: {
                        display: true,
                        fontColor: "gray",
                        fontSize: 13,
                        padding: 10,
                        maxRotation: 90,
                        minRotation: 45,
                        autoSkip: true,
                        maxTicksLimit: 12
                    },
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        drawTicks: false,
                        borderDash: [3, 4],
                        zeroLineWidth: 1,
                        zeroLineBorderDash: [3, 4]
                    },
                    ticks: {
                        display: true,
                        fontColor: "gray",
                        fontSize: 13,
                        padding: 10,
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

@endsection()