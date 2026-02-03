@extends('admin.layout')
@section('title', 'Transaction')
@section('menu-data')
    <input type="hidden" name="" class="menu-data" value="statistic-group | statistic">
@endsection()

@section('css')

@endsection()

@section('body')


    <div class="container-fluid">

        <div class="app-page-head d-flex align-items-center justify-content-between">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i class="fi fi-rr-home"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>

        <div class="row">

            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-header pb-0 border-0">
                        <div class="avatar bg-primary-subtle text-primary rounded-circle">
                            <i class="fi fi-rr-wallet"></i>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-end">
                        <div class="clearfix me-auto">
                            <p class="mb-1">Total Volume</p>
                            <h2 class="mb-0">${{ $profit }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-header pb-0 border-0">
                        <div class="avatar bg-success-subtle text-success rounded-circle">
                            <i class="fi fi-rr-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-end">
                        <div class="clearfix me-auto">
                            <p class="mb-1">Total Transactions</p>
                            <h2 class="mb-0">{{ number_format($transactions, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-header pb-0 border-0">
                        <div class="avatar bg-danger-subtle text-danger rounded-circle">
                            <i class="fi fi-rr-bullseye-arrow"></i>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-end">
                        <div class="clearfix me-auto">
                            <p class="mb-1">Total Bot</p>
                            <h2 class="mb-0">{{ number_format($accounts, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-6 col-lg-8">
                <div class="card">
                    <div
                        class="card-header pb-0 border-0 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                        <h6 class="card-title mb-0">Volume Report</h6>
                        <ul class="nav nav-pills nav-pills-custom nav-fill p-1 bg-light rounded-5" id="chartRevenueTabs"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active rounded-5" id="todayRevenueTab" data-bs-toggle="tab"
                                    type="button" role="tab" aria-selected="false" tabindex="-1">
                                    Today
                                </button>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-5" id="weekRevenueTab" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" tabindex="-1">
                                            Week
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link  rounded-5" id="monthRevenueTab" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">
                                            Month
                                        </button>
                                    </li> -->
                        </ul>
                    </div>
                    <div class="card-body pb-0">
                        <div class="d-flex gap-5">
                            <div class="mb-2">
                                <h6 class="mb-0">
                                    <span class="text-body">Total Buy:
                                        $</span>{{ number_format($profit_buy, 0, ',', '.') }}<span class="text-primary">
                                    </span>
                                </h6>
                            </div>
                            <div class="mb-2">
                                <h6 class="mb-0">
                                    <span class="text-body">Total Sell:
                                        $</span>{{ number_format($profit_sell, 0, ',', '.') }}<span class="text-primary">
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div id="SalesChart" class="mx-n3"></div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-lg-4 col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-header pb-0 border-0">
                        <h6 class="card-title mb-0">Monthly Target</h6>
                    </div>
                    <div class="card-body pt-0 border-light border-bottom">
                        <div class="mb-0 mt-n2">
                            <div id="MonthlyTargetChart"></div>
                            <div class="mt-n5 text-center">5,000 Transactions</div>
                        </div>
                    </div>
                    <div class="card-footer border-0">
                        <h6 class="card-title mb-3">Volume Status</h6>
                        <div class="progress-stacked bg-transparent mb-4">
                            <div class="progress bg-transparent" role="progressbar" aria-label="Segment one"
                                aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"
                                style="width: <?php echo $percentBuy; ?>%">
                                <div class="progress-bar bg-primary"></div>
                            </div>
                            <div class="progress bg-transparent" role="progressbar" aria-label="Segment two"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                                style="width: <?php echo $percentSell; ?>%">
                                <div class="progress-bar bg-primary bg-opacity-75"></div>
                            </div>
                        </div>
                        <div class="d-grid gap-1">
                            <div class="d-flex gap-1 align-items-center py-1 mx-1">
                                <i class="fa fa-square text-primary me-1"></i>
                                Buy Volume
                                <strong class="text-dark fw-semibold ms-auto"><?php echo $percentBuy; ?>%</strong>
                            </div>
                            <div class="d-flex gap-1 align-items-center py-1 py-1 mx-1">
                                <i class="fa fa-square text-primary text-opacity-75 me-1"></i>
                                Sell Volume
                                <strong class="text-dark fw-semibold ms-auto"><?php echo $percentSell; ?>%</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header border-0 pb-0 d-flex align-items-center justify-content-between">
                        <h6 class="card-title mb-0">Volume by Account</h6>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row g-1">
                            @foreach ($topAccounts as $account)
                                <div class="col-xxl-12 col-lg-6 col-md-12 col-sm-6">
                                    <div class="p-3 border rounded">
                                        <div class="d-flex align-items-center mb-1">
                                            <h5 class="mb-0">Account {{ $account->account_id }}</h5>
                                        </div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h5 class="mb-0">{{ $account->transactions_count }} <span
                                                    class="text-2xs text-body ms-1">Transactions with total volume
                                                    {{ $account->total_volume  }}$</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div
                        class="card-header d-flex flex-wrap gap-3 align-items-center justify-content-between border-0 pb-0">
                        <h6 class="card-title mb-0">Recent 30 Transactions</h6>
                        <div id="dt_RecentTransactions_Search">
                            <div class="dt-search"><i class="fi fi-rr-search"></i>
                                <input type="search" class="form-control form-control-sm" id="dt-search-0"
                                    placeholder="Search for transactions..." aria-controls="dt_RecentTransactions">
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-1 pt-2 pb-2">
                        <div id="dt_RecentTransactions_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                            <div class="row mt-2 justify-content-between dt-layout-table">
                                <div
                                    class="d-md-flex justify-content-between align-items-center col-12 dt-layout-full col-md">
                                    <table id="dt_RecentTransactions"
                                        class="table table-sm display table-row-rounded dataTable"
                                        aria-describedby="dt_RecentTransactions_info" style="width: 100%;">
                                        <colgroup>
                                            <col data-dt-column="0" style="width: 220px;">
                                            <col data-dt-column="1" style="width: 140px;">
                                            <col data-dt-column="2" style="width: 260px;">
                                            <col data-dt-column="3" style="width: 110px;">
                                            <col data-dt-column="4" style="width: 120px;">
                                            <col data-dt-column="5" style="width: 120px;">
                                        </colgroup>
                                        <thead class="table-light">
                                            <tr>
                                                <th class="minw-150px dt-orderable-none dt-ordering-asc" data-dt-column="0">
                                                    <div class="dt-column-header"><span
                                                            class="dt-column-title">Customer</span></div>
                                                </th>
                                                <th class="minw-120px dt-orderable-asc dt-orderable-desc"
                                                    data-dt-column="1">
                                                    <div class="dt-column-header"><span class="dt-column-title">Date</span>
                                                    </div>
                                                </th>
                                                <th class="minw-200px dt-orderable-asc dt-orderable-desc"
                                                    data-dt-column="2">
                                                    <div class="dt-column-header"><span class="dt-column-title">Transaction
                                                            Hash</span></div>
                                                </th>
                                                <th data-dt-column="3" class="dt-orderable-asc dt-orderable-desc">
                                                    <div class="dt-column-header"><span class="dt-column-title">Type</span>
                                                    </div>
                                                </th>
                                                <th data-dt-column="4"
                                                    class="dt-type-numeric dt-orderable-asc dt-orderable-desc">
                                                    <div class="dt-column-header"><span
                                                            class="dt-column-title">Amount</span></div>
                                                </th>
                                                <th data-dt-column="5" class="dt-orderable-asc dt-orderable-desc">
                                                    <div class="dt-column-header"><span
                                                            class="dt-column-title">Status</span></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($latestTransactions as $transaction)
                                                <tr>
                                                    <td class="sorting_1">
                                                        <div class="d-flex align-items-center">
                                                            Bot {{ $transaction->account_id }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $transaction->created_at }}</td>
                                                    <td>
                                                        <a href="https://kavascan.io/tx/{{ $transaction->transaction_hash }}"
                                                            target="_blank">
                                                            {{ substr($transaction->transaction_hash, 0, 8) . '...' . substr($transaction->transaction_hash, -8) }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $transaction->type == "Swap USDT to KAVA" ? "Buy" : "Sell" }}</td>
                                                    <td
                                                        class="text-{{ $transaction->type == 'Swap USDT to KAVA' ? 'danger' : 'success' }} fw-bold dt-type-numeric">
                                                        {{ $transaction->type == "Swap USDT to KAVA" ? "-" : "+" }}{{$transaction->amount}}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge badge-lg bg-success-subtle text-success">Success</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="row mt-2 justify-content-between">
                                        <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto">
                                            <div class="dt-info" aria-live="polite" id="dt_RecentTransactions_info" role="status">Showing 1 to 5 of 5 transactions</div>
                                        </div>
                                        <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto">
                                            <div class="dt-paging">
                                                <nav aria-label="pagination">
                                                    <ul class="pagination">
                                                        <li class="dt-paging-button page-item disabled"><button class="page-link first" role="link" type="button" aria-controls="dt_RecentTransactions" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1"><i class="fi fi-rr-angle-double-left"></i></button></li>
                                                        <li class="dt-paging-button page-item disabled"><button class="page-link previous" role="link" type="button" aria-controls="dt_RecentTransactions" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1"><i class="fi fi-rr-angle-left"></i></button></li>
                                                        <li class="dt-paging-button page-item active"><button class="page-link" role="link" type="button" aria-controls="dt_RecentTransactions" aria-current="page" data-dt-idx="0">1</button></li>
                                                        <li class="dt-paging-button page-item disabled"><button class="page-link" role="link" type="button" aria-controls="dt_RecentTransactions" data-dt-idx="1" disabled>2</button></li>
                                                        <li class="dt-paging-button page-item disabled"><button class="page-link" role="link" type="button" aria-controls="dt_RecentTransactions" data-dt-idx="2" disabled>3</button></li>
                                                        <li class="dt-paging-button page-item disabled"><button class="page-link next" role="link" type="button" aria-controls="dt_RecentTransactions" aria-label="Next" data-dt-idx="next" disabled><i class="fi fi-rr-angle-right"></i></button></li>
                                                        <li class="dt-paging-button page-item disabled"><button class="page-link last" role="link" type="button" aria-controls="dt_RecentTransactions" aria-label="Last" data-dt-idx="last" disabled><i class="fi fi-rr-angle-double-right"></i></button></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div> -->
                            <div style="width: 100%; height: 0px;" class="dt-autosize"></div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>


    <input type="hidden" value="{{ json_encode($transaction_data) }}" id="transaction-list">


@endsection()

@section('js')



    <script>
        // // Chart by date time, process data via #transaction-list
        // const transactionList = JSON.parse(document.getElementById('transaction-list').value);

        // // Lấy dữ liệu thống kê theo ngày giờ (ví dụ: mỗi cặp [yyyy-mm-dd HH])
        // // Đếm số giao dịch cho từng ngày giờ riêng biệt
        // const dateHourMap = {};

        // transactionList.forEach(tx => {
        //     let dateHourLabel = null;
        //     if (tx.created_at) {
        //         // lấy riêng phần ngày + phần giờ ("2024-06-02 14:23:00" -> "2024-06-02 14")
        //         const d = new Date(tx.created_at);
        //         if (!isNaN(d.getTime())) {
        //             const yyyy = d.getFullYear();
        //             const mm = (d.getMonth() + 1).toString().padStart(2, '0');
        //             const dd = d.getDate().toString().padStart(2, '0');
        //             const hh = d.getHours().toString().padStart(2, '0');
        //             dateHourLabel = `${yyyy}-${mm}-${dd} ${hh}:00`;
        //         }
        //     } else if (tx.date && tx.hour !== undefined) {
        //         // fallback nếu dữ liệu đã tách ngày và giờ
        //         let hh = typeof tx.hour === 'string' ? tx.hour.padStart(2, '0') : tx.hour.toString().padStart(2, '0');
        //         dateHourLabel = `${tx.date} ${hh}:00`;
        //     }
        //     if (dateHourLabel) {
        //         dateHourMap[dateHourLabel] = (dateHourMap[dateHourLabel] || 0) + 1;
        //     }
        // });

        // // Sắp xếp các nhãn theo thứ tự thời gian tăng dần
        // const sortedLabels = Object.keys(dateHourMap).sort();

        // // Dữ liệu count theo nhãn
        // const counts = sortedLabels.map(label => dateHourMap[label]);

        // const revenueChartConfig = new Chart(document.getElementById("revenue-chart").getContext('2d'), {
        //     type: 'line',
        //     data: {
        //         labels: sortedLabels,
        //         datasets: [{
        //             label: 'Số giao dịch theo ngày giờ',
        //             backgroundColor: "transparent",
        //             borderColor: "blue",
        //             pointBackgroundColor: "blue",
        //             pointBorderColor: "white",
        //             pointHoverBackgroundColor: "blue",
        //             pointHoverBorderColor: "blue",
        //             data: counts
        //         }]
        //     },
        //     options: {
        //         legend: {
        //             display: false
        //         },
        //         maintainAspectRatio: false,
        //         responsive: true,
        //         hover: {
        //             mode: 'nearest',
        //             intersect: true
        //         },
        //         tooltips: {
        //             mode: 'index'
        //         },
        //         scales: {
        //             xAxes: [{
        //                 type: 'category',
        //                 ticks: {
        //                     display: true,
        //                     fontColor: "gray",
        //                     fontSize: 13,
        //                     padding: 10,
        //                     maxRotation: 80,
        //                     minRotation: 45,
        //                     autoSkip: true,
        //                     maxTicksLimit: 20,
        //                     callback: function(value) {
        //                         // rút gọn nhãn nếu cần
        //                         return value.length > 16 ? value.substring(5) : value;
        //                     }
        //                 },
        //                 gridLines: {
        //                     display: false,
        //                 }
        //             }],
        //             yAxes: [{
        //                 gridLines: {
        //                     drawBorder: false,
        //                     drawTicks: false,
        //                     borderDash: [3, 4],
        //                     zeroLineWidth: 1,
        //                     zeroLineBorderDash: [3, 4]
        //                 },
        //                 ticks: {
        //                     display: true,
        //                     fontColor: "gray",
        //                     fontSize: 13,
        //                     padding: 10,
        //                     beginAtZero: true
        //                 }
        //             }]
        //         }
        //     }
        // });


        const SalesChartConfig = {
            series: [{
                name: 'Total Buy',
                data: <?php echo json_encode($buyCounts); ?>
            },
            {
                name: "Total Sell",
                data: <?php echo json_encode($sellCounts); ?>
            }
            ],
            chart: {
                height: 320,
                type: 'area',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
            },
            colors: [
                "var(--bs-primary)",
                "var(--bs-danger)"
            ],
            fill: {
                type: ["gradient", "gradient"],
                gradient: {
                    shade: 'light',
                    type: "vertical",
                    shadeIntensity: 0.1,
                    gradientToColors: ["var(--bs-primary)"],
                    inverseColors: false,
                    opacityFrom: 0.08,
                    opacityTo: 0.01,
                    stops: [20, 100]
                },
                gradient: {
                    shade: 'light',
                    type: "vertical",
                    shadeIntensity: 0.1,
                    gradientToColors: ["var(--bs-danger)"],
                    inverseColors: false,
                    opacityFrom: 0.1,
                    opacityTo: 0.01,
                    stops: [20, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [2, 2],
                curve: 'smooth',
                dashArray: [0, 0]
            },
            markers: {
                size: 0,
                colors: ['#FFFFFF'],
                strokeColors: 'var(--bs-info)',
                strokeWidth: 2,
                hover: {
                    size: 6
                }
            },
            yaxis: {
                min: 0,
                max: 80,
                tickAmount: 5,
                labels: {
                    formatter: function (value) {
                        return "$" + value;
                    },
                    style: {
                        colors: 'var(--bs-body-color)',
                        fontSize: '13px',
                        fontWeight: '500',
                        fontFamily: 'var(--bs-body-font-family)'
                    }
                }
            },
            xaxis: {
                categories: ['2 AM', '4 AM', '6 AM', '8 AM', '10 AM', '12 PM', '2 PM', '4 PM', '6 PM', '8 PM', '10 PM', '12 AM'],
                axisBorder: {
                    color: 'var(--bs-border-color)'
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: 'var(--bs-body-color)',
                        fontSize: '13px',
                        fontWeight: '500',
                        fontFamily: 'var(--bs-body-font-family)'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + Number(val).toFixed(2);
                    }
                }
            },
            grid: {
                borderColor: 'var(--bs-border-color)',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'center',
                markers: {
                    size: 5,
                    shape: 'circle',
                    radius: 10,
                    width: 10,
                    height: 10,
                },
                labels: {
                    colors: 'var(--bs-heading-color)',
                    fontFamily: 'var(--bs-body-font-family)',
                    fontSize: '13px',
                }
            }
        };
        const SalesChart = document.querySelector("#SalesChart");
        if (SalesChart) {
            var chartTabsInit = new ApexCharts(SalesChart, SalesChartConfig);
            chartTabsInit.render();

            document.querySelector("#todayRevenueTab").addEventListener("click", () => {
                chartTabsInit.updateOptions({
                    xaxis: {
                        categories: ['2 AM', '4 AM', '6 AM', '8 AM', '10 AM', '12 PM', '2 PM', '4 PM', '6 PM', '8 PM', '10 PM', '12 AM']
                    },
                    series: [{
                        data: <?php echo json_encode($buyCounts); ?>
                    },
                    {
                        data: <?php echo json_encode($sellCounts); ?>
                    }
                    ]
                });
            });
            // document.querySelector("#weekRevenueTab").addEventListener("click", () => {
            //     chartTabsInit.updateOptions({
            //         xaxis: {
            //             categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            //         },
            //         series: [{
            //                 data: [4200, 5200, 4800, 6100, 7000, 6400, 7200]
            //             },
            //             {
            //                 data: [3100, 3700, 3400, 4000, 4600, 4200, 3900]
            //             }
            //         ]
            //     });
            // });
            // document.querySelector("#monthRevenueTab").addEventListener("click", () => {
            //     chartTabsInit.updateOptions({
            //         xaxis: {
            //             categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            //         },
            //         series: [{
            //                 data: [3500, 5000, 4200, 5500, 5000, 6200, 4800, 6500, 5800, 7200, 6600, 7500]
            //             },
            //             {
            //                 data: [2500, 3100, 2900, 3700, 3300, 4100, 3600, 3900, 4200, 4000, 4600, 4300]
            //             }
            //         ]
            //     });
            // });
        }



        const MonthlyTargetChartConfig = {
            series: [<?php echo ($transactions / 5000) * 100; ?>],
            chart: {
                type: "radialBar",
                offsetY: 0,
                height: 350,
                sparkline: {
                    enabled: true
                },
            },
            plotOptions: {
                radialBar: {
                    startAngle: -95,
                    endAngle: 95,
                    track: {
                        background: "rgba(var(--bs-primary-rgb), 0.6)",
                        strokeWidth: "10%",
                        margin: 25,
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            show: true,
                            offsetY: -35,
                            fontSize: "28px",
                            fontFamily: "var(--bs-body-font-family)",
                            fontWeight: 600,
                            color: "var(--bs-dark)",
                            formatter: function (val) {
                                const totalEarning = <?php echo ($transactions / 5000) * 100; ?>;
                                return `${totalEarning}%`;
                            },
                        },
                    },
                },
            },
            grid: {
                padding: {
                    top: 0,
                    bottom: 0,
                    left: 0,
                    right: 0,
                },
            },
            fill: {
                colors: ["var(--bs-primary)"],
            },
        };
        const MonthlyTargetChart = document.querySelector("#MonthlyTargetChart");
        if (typeof MonthlyTargetChart !== undefined && MonthlyTargetChart !== null) {
            const chartInit = new ApexCharts(
                MonthlyTargetChart,
                MonthlyTargetChartConfig
            );
            chartInit.render();
        }
    </script>

@endsection()