<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisplayController extends Controller
{
    //
    public function login()
    {
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function index()
    {
        return view('admin.manager.account.index');
    }
    public function transaction()
    {
        return view('admin.manager.transaction.index');
    }
    public function bot()
    {
        return view('admin.manager.bot.index');
    }
    public function statistic()
    {


        // // Lấy 100 transaction mới nhất
        // $transactions = DB::table('transaction')
        //     ->orderBy('id', 'desc')
        //     ->limit(100)
        //     ->get();

        // $transactions = $transactions->values(); // Đảm bảo có thể truy cập theo chỉ số

        // for ($i = 0; $i < count($transactions); $i++) {
        //     $current = $transactions[$i];
        //     $shouldAdd = false;

        //     // Kiểm tra row liền kề (trước và sau)
        //     if ($i > 0 && $transactions[$i - 1]->id == $current->id) {
        //         $shouldAdd = true;
        //     }
        //     if ($i < count($transactions) - 1 && $transactions[$i + 1]->id == $current->id) {
        //         $shouldAdd = true;
        //     }

        //     // Nếu không có 2 row liền kề giống thì 50% ngẫu nhiên
        //     if (!$shouldAdd) {
        //         $shouldAdd = (rand(0, 1) === 1);
        //     }

        //     if ($shouldAdd) {
        //         // Tạo số giây ngẫu nhiên từ 1 đến 60
        //         $addSeconds = rand(1, 120);
        //         // Cộng vào created_at
        //         $newCreatedAt = \Carbon\Carbon::parse($current->created_at)->addSeconds($addSeconds);

        //         // Update bản ghi
        //         DB::table('transaction')
        //             ->where('id', $current->id)
        //             ->update(['created_at' => $newCreatedAt]);
        //     }
        // }
        // dd(1);
        $profit_buy = DB::table('transaction')->where("type", "Swap USDT to KAVA")->sum('amount');
        $profit_sell = DB::table('transaction')->where("type", "Swap KAVA to USDT")->sum('amount');
        $transactions = DB::table('transaction')->where('type', 'like', '%swap%')->count();
        $transaction_data = DB::table('transaction')->where('type', 'like', '%swap%')->get();

        // Lấy mốc thời gian cuối là thời điểm hiện tại, mốc đầu là 24h trước
        $todayEnd = now();
        $todayStart = now()->subDay();


        // Các mốc giờ cho biểu đồ và mapping sang giá trị giờ trong ngày
        $hourLabels = [
            // '2 AM',
            '4 AM',
            // '6 AM',
            '8 AM',
            // '10 AM',
            '12 PM',
            // '2 PM',
            '4 PM',
            // '6 PM',
            '8 PM',
            // '10 PM',
            '12 AM'
        ];
        $hourMap = [
            '2 AM' => 2,
            '4 AM' => 4,
            '6 AM' => 6,
            '8 AM' => 8,
            '10 AM' => 10,
            '12 PM' => 12,
            '2 PM' => 14,
            '4 PM' => 16,
            '6 PM' => 18,
            '8 PM' => 20,
            '10 PM' => 22,
            '12 AM' => 0,
        ];

        // Chuẩn bị mảng tổng số tiền theo từng mốc giờ
        $buySums = array_fill(0, count($hourLabels), 0);
        $sellSums = array_fill(0, count($hourLabels), 0);

        // Tạo mảng time window cho từng mốc giờ (window 2 tiếng)
        $timeWindows = [];
        foreach ($hourLabels as $i => $label) {
            $startHour = $hourMap[$label];
            // Đặc biệt "12 AM" là 0h, cuối cùng của danh sách sẽ là 2h ngày hôm sau
            if ($i < count($hourLabels) - 1) {
                $endHour = $hourMap[$hourLabels[$i + 1]];
            } else {
                $endHour = 24; // 12 AM đến 0h sáng hôm sau (end of day)
            }
            $windowStart = $todayStart->copy()->addHours($startHour);
            $windowEnd = ($endHour == 24)
                ? $todayEnd
                : $todayStart->copy()->addHours($endHour)->subSecond();
            $timeWindows[] = ['start' => $windowStart, 'end' => $windowEnd];
        }

        // Lấy tất cả transaction "trong ngày" chia theo giờ, tránh nhiều truy vấn
        $allTransactions = DB::table('transaction')
            ->whereBetween('created_at', [$todayStart, $todayEnd])
            ->where('type', 'like', '%swap%')
            ->get();

        foreach ($allTransactions as $tx) {
            $hour = (int) date('G', strtotime($tx->created_at));
            // Tìm index mốc giờ đúng cho $tx
            foreach ($timeWindows as $idx => $window) {
                if (
                    (strtotime($tx->created_at) >= $window['start']->timestamp) &&
                    (strtotime($tx->created_at) <= $window['end']->timestamp)
                ) {
                    if ($tx->type === 'Swap USDT to KAVA') {
                        $buySums[$idx] += $tx->amount;
                    }
                    if ($tx->type === 'Swap KAVA to USDT') {
                        $sellSums[$idx] += $tx->amount;
                    }
                    break;
                }
            }
        }

        // Tổng profit chỉ lấy trong ngày hôm nay cho khớp số liệu biểu đồ
        // $profit = $allTransactions->sum('amount');
        $profit = $profit_buy + $profit_sell;

        $buyCounts = $buySums;
        $sellCounts = $sellSums;



        // --- Lấy dữ liệu cho week ---
        // Tính toán tuần hiện tại (Thứ 2 -> Chủ nhật)
        $weekStart = now()->startOfWeek(); // Monday 00:00:00
        $weekEnd = now()->endOfWeek(); // Sunday 23:59:59

        $weekDayLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $weekBuySums = array_fill(0, 7, 0);
        $weekSellSums = array_fill(0, 7, 0);

        // Lấy các transaction swap trong tuần
        $weekTransactions = DB::table('transaction')
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->where('type', 'like', '%swap%')
            ->get();

        foreach ($weekTransactions as $tx) {
            $txTime = \Carbon\Carbon::parse($tx->created_at)->startOfDay();
            $dow = $txTime->dayOfWeekIso; // Monday = 1, Sunday = 7
            $idx = $dow - 1;
            if ($tx->type === 'Swap USDT to KAVA') {
                $weekBuySums[$idx] += $tx->amount;
            }
            if ($tx->type === 'Swap KAVA to USDT') {
                $weekSellSums[$idx] += $tx->amount;
            }
        }
        $weekBuyCounts = $weekBuySums;
        $weekSellCounts = $weekSellSums;

        // --- Lấy dữ liệu cho month ---

        // Tạo mảng 12 tháng với mặc định là 0 nếu không có dữ liệu
        $monthLabels = [];
        $monthBuySums = [];
        $monthSellSums = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthLabels[] = str_pad($i, 2, '0', STR_PAD_LEFT); // 01, 02, ..., 12
            $monthBuySums[$i] = 0;
            $monthSellSums[$i] = 0;
        }

        // Lấy các giao dịch swap của năm hiện tại
        $yearStart = now()->startOfYear();
        $yearEnd = now()->endOfYear();
        $monthTransactions = DB::table('transaction')
            ->whereBetween('created_at', [$yearStart, $yearEnd])
            ->where('type', 'like', '%swap%')
            ->get();

        foreach ($monthTransactions as $tx) {
            $txMonth = (int) date('n', strtotime($tx->created_at)); // 1..12
            if ($tx->type === 'Swap USDT to KAVA') {
                $monthBuySums[$txMonth] += $tx->amount;
            }
            if ($tx->type === 'Swap KAVA to USDT') {
                $monthSellSums[$txMonth] += $tx->amount;
            }
        }

        // Đảm bảo dữ liệu đúng thứ tự tháng và luôn có 12 phần tử, tháng không có thì giá trị là 0
        $monthBuyCounts = [];
        $monthSellCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthBuyCounts[] = $monthBuySums[$i];
            $monthSellCounts[] = $monthSellSums[$i];
        }

        // Truyền cho view
        // Note: bạn có thể cần điều chỉnh bên view để nhận 
        // weekBuyCounts, weekSellCounts, monthBuyCounts, monthSellCounts, weekDayLabels, monthLabels

        // Tính tổng buy và sell
        $totalBuy = array_sum($buyCounts);
        $totalSell = array_sum($sellCounts);
        $total = $totalBuy + $totalSell;

        // Tránh chia cho 0
        if ($total > 0) {
            $percentBuy = round($totalBuy / $total * 100, 2);
            $percentSell = round($totalSell / $total * 100, 2);
        } else {
            $percentBuy = 0;
            $percentSell = 0;
        }

        // Lấy ra 4 account có transactions nhiều nhất, kèm tổng volume
        $topAccounts = DB::table('transaction')
            ->select(
                'account_id',
                DB::raw('COUNT(*) as transactions_count'),
                DB::raw('SUM(amount) as total_volume')
            )
            // ->whereBetween('created_at', [$todayStart, $todayEnd])
            ->where('type', 'like', '%swap%')
            ->groupBy('account_id')
            ->orderByDesc('transactions_count')
            ->limit(4)
            ->get();


        // Lấy ra 30 transaction gần nhất
        $latestTransactions = DB::table('transaction')
            ->where('type', 'like', '%swap%')
            ->orderByDesc('created_at')
            ->limit(30)
            ->get();
        $accounts = DB::table('account')->count();
        return view('admin.manager.statistic.index', compact(
            'topAccounts',
            'profit',
            'profit_buy',
            'profit_sell',
            'transactions',
            'accounts',
            'transaction_data',
            'buyCounts',
            'sellCounts',
            'weekBuyCounts',
            'weekSellCounts',
            'monthBuyCounts',
            'monthSellCounts',
            'percentBuy',
            'percentSell',
            'latestTransactions'
        ));
    }
}
