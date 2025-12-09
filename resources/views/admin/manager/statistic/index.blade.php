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
                        <h2 class="m-b-0">Kava {{ $profit }}</h2>
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
    // Chart by date time, process data via #transaction-list
    const transactionList = JSON.parse(document.getElementById('transaction-list').value);

    // Lấy dữ liệu thống kê theo ngày giờ (ví dụ: mỗi cặp [yyyy-mm-dd HH])
    // Đếm số giao dịch cho từng ngày giờ riêng biệt
    const dateHourMap = {};

    transactionList.forEach(tx => {
        let dateHourLabel = null;
        if (tx.created_at) {
            // lấy riêng phần ngày + phần giờ ("2024-06-02 14:23:00" -> "2024-06-02 14")
            const d = new Date(tx.created_at);
            if (!isNaN(d.getTime())) {
                const yyyy = d.getFullYear();
                const mm = (d.getMonth() + 1).toString().padStart(2, '0');
                const dd = d.getDate().toString().padStart(2, '0');
                const hh = d.getHours().toString().padStart(2, '0');
                dateHourLabel = `${yyyy}-${mm}-${dd} ${hh}:00`;
            }
        } else if (tx.date && tx.hour !== undefined) {
            // fallback nếu dữ liệu đã tách ngày và giờ
            let hh = typeof tx.hour === 'string' ? tx.hour.padStart(2, '0') : tx.hour.toString().padStart(2, '0');
            dateHourLabel = `${tx.date} ${hh}:00`;
        }
        if (dateHourLabel) {
            dateHourMap[dateHourLabel] = (dateHourMap[dateHourLabel] || 0) + 1;
        }
    });

    // Sắp xếp các nhãn theo thứ tự thời gian tăng dần
    const sortedLabels = Object.keys(dateHourMap).sort();

    // Dữ liệu count theo nhãn
    const counts = sortedLabels.map(label => dateHourMap[label]);

    const revenueChartConfig = new Chart(document.getElementById("revenue-chart").getContext('2d'), {
        type: 'line',
        data: {
            labels: sortedLabels,
            datasets: [{
                label: 'Số giao dịch theo ngày giờ',
                backgroundColor: "transparent",
                borderColor: "blue",
                pointBackgroundColor: "blue",
                pointBorderColor: "white",
                pointHoverBackgroundColor: "blue",
                pointHoverBorderColor: "blue",
                data: counts
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
                    type: 'category',
                    ticks: {
                        display: true,
                        fontColor: "gray",
                        fontSize: 13,
                        padding: 10,
                        maxRotation: 80,
                        minRotation: 45,
                        autoSkip: true,
                        maxTicksLimit: 20,
                        callback: function(value) {
                            // rút gọn nhãn nếu cần
                            return value.length > 16 ? value.substring(5) : value;
                        }
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