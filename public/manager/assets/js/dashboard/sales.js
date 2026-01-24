if ($("#dt_RecentSales").length) {
    const dt_RecentSales = $("#dt_RecentSales").DataTable({
        searching: true,
        pageLength: 5,
        select: false,
        lengthChange: false,
        info: true,
        paging: true,
        language: {
            search: "",
            searchPlaceholder: "Search",
            paginate: {
                previous: "<i class='fi fi-rr-angle-left'></i>",
                next: "<i class='fi fi-rr-angle-right'></i>",
                first: "<i class='fi fi-rr-angle-double-left'></i>",
                last: "<i class='fi fi-rr-angle-double-right'></i>",
            },
        },
        initComplete: function () {
            const dtSearch = $("#dt_RecentSales_wrapper .dt-search").detach();
            $("#dt_RecentSales_Search").append(dtSearch);
            $("#dt_RecentSales_Search .dt-search").prepend(
                '<i class="fi fi-rr-search"></i>'
            );
            $("#dt_RecentSales_Search .dt-search label").remove();
            $("#dt_RecentSales_wrapper > .row.mt-2.justify-content-between")
                .first()
                .remove();
        },
        columnDefs: [
            {
                targets: [0],
                orderable: false,
            },
        ],
    });
}

if ($("#dt_TopSellingItems").length) {
    const dt_TopSellingItems = $("#dt_TopSellingItems").DataTable({
        searching: true,
        pageLength: 5,
        select: false,
        lengthChange: false,
        info: true,
        paging: true,
        language: {
            search: "",
            searchPlaceholder: "Search",
            paginate: {
                previous: "<i class='fi fi-rr-angle-left'></i>",
                next: "<i class='fi fi-rr-angle-right'></i>",
                first: "<i class='fi fi-rr-angle-double-left'></i>",
                last: "<i class='fi fi-rr-angle-double-right'></i>",
            },
        },
        initComplete: function () {
            const dtSearch = $(
                "#dt_TopSellingItems_wrapper .dt-search"
            ).detach();
            $("#dt_TopSellingItems_Search").append(dtSearch);
            $("#dt_TopSellingItems_Search .dt-search").prepend(
                '<i class="fi fi-rr-search"></i>'
            );
            $("#dt_TopSellingItems_Search .dt-search label").remove();
            $("#dt_TopSellingItems_wrapper > .row.mt-2.justify-content-between")
                .first()
                .remove();
        },
        columnDefs: [
            {
                targets: [0],
                orderable: false,
            },
        ],
    });
}

const VisitorsChartConfig = {
    series: [
        {
            name: "Current",
            data: [4500, 2050, 3100, 4800, 1800, 2500],
        },
        {
            name: "Last Month",
            data: [4040, 2050, 4200, 2800, 1800, 2050],
        },
    ],
    chart: {
        height: 295,
        type: "bar",
        toolbar: { show: false },
        animations: {
            enabled: true,
            easing: "easeinout",
            speed: 800,
        },
    },
    colors: ["var(--bs-primary)", "var(--bs-light)"],
    fill: {
        type: ["gradient"],
        gradient: {
            shade: "light",
            type: "vertical",
            shadeIntensity: 0.1,
            gradientToColors: ["var(--bs-info)"],
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 0.6,
            stops: [20, 100],
        },
    },
    dataLabels: { enabled: false },
    stroke: {
        width: 0,
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "75%",
            borderRadius: 4,
            distributed: false,
        },
    },
    grid: {
        borderColor: "var(--bs-border-color)",
        strokeDashArray: 5,
        xaxis: { lines: { show: false } },
        yaxis: { lines: { show: true } },
    },
    tooltip: {
        theme: "light",
        y: {
            formatter: function (val) {
                return val + " Visitors";
            },
        },
    },
    xaxis: {
        categories: [
            ["Mobile"],
            ["Desktop"],
            ["Tablet"],
            ["iPad pro"],
            ["iPhone"],
            ["Other"],
        ],
        axisBorder: { color: "var(--bs-border-color)" },
        axisTicks: { show: false },
        labels: {
            style: {
                colors: "var(--bs-body-color)",
                fontSize: "13px",
                fontWeight: 500,
                fontFamily: "var(--bs-body-font-family)",
            },
        },
    },
    yaxis: { show: false },
};
const VisitorsChart = document.querySelector("#VisitorsChart");
if (VisitorsChart !== null) {
    const chartInit = new ApexCharts(VisitorsChart, VisitorsChartConfig);
    chartInit.render();
}

const SalesGrowthChartConfig = {
    series: [
        {
            name: "",
            data: [1000, 2050, 3100, 4800, 4800, 1800, 4500],
        },
    ],
    chart: {
        height: 280,
        type: "area",
        toolbar: { show: false },
        animations: {
            enabled: true,
            easing: "easeinout",
            speed: 800,
        },
    },
    colors: ["var(--bs-primary)"],
    fill: {
        type: ["gradient"],
        gradient: {
            shade: "light",
            type: "vertical",
            shadeIntensity: 0.1,
            gradientToColors: ["var(--bs-info)"],
            inverseColors: false,
            opacityFrom: 0.2,
            opacityTo: 0.06,
            stops: [20, 100],
        },
    },
    dataLabels: { enabled: false },
    stroke: {
        curve: "smooth",
        width: 2,
        colors: ["var(--bs-info)"],
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "75%",
            borderRadius: 4,
            distributed: false,
        },
    },
    grid: {
        borderColor: "var(--bs-border-color)",
        strokeDashArray: 5,
        xaxis: { lines: { show: false } },
        yaxis: { lines: { show: true } },
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return "$ " + val + "K";
            },
        },
    },
    xaxis: {
        categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
        axisBorder: { color: "var(--bs-border-color)" },
        axisTicks: { show: false },
        labels: {
            style: {
                colors: "var(--bs-body-color)",
                fontSize: "13px",
                fontWeight: 500,
                fontFamily: "var(--bs-body-font-family)",
            },
        },
    },
    yaxis: {
        min: 0,
        max: 6000,
        tickAmount: 4,
        labels: {
            formatter: function (value) {
                return "$" + value / 100 + "K";
            },
            style: {
                colors: "var(--bs-body-color)",
                fontSize: "13px",
                fontWeight: 500,
                fontFamily: "var(--bs-body-font-family)",
            },
        },
    },
};
const SalesGrowthChart = document.querySelector("#SalesGrowthChart");
if (SalesGrowthChart !== null) {
    const chartInit = new ApexCharts(SalesGrowthChart, SalesGrowthChartConfig);
    chartInit.render();
}
