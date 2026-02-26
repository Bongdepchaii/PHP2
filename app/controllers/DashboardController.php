<?php
class DashboardController extends Controller
{
    public function index()
    {
        $dateFrom = $_GET['date_from'] ?? date('Y-m-01');
        $dateTo   = $_GET['date_to']   ?? date('Y-m-d');
        $year     = $_GET['year']      ?? date('Y');

        $orderModel   = $this->model('order');
        $productModel = $this->model('product');
        $userModel    = $this->model('user');

        $summary     = $orderModel->getRevenueSummary($dateFrom, $dateTo);
        $revenueByDay = $orderModel->getRevenueByDay($dateFrom, $dateTo);
        $revenueByMonth = $orderModel->getRevenueByMonth($year);
        $topProducts = $orderModel->getTopProducts(5, $dateFrom, $dateTo);
        $productStats = $productModel->getStats();
        $orderCounts = $orderModel->countByStatus();
        $totalUsers = count($userModel->all());

        $this->view('dashboard/index', [
            'title'          => 'Bảng điều khiển',
            'dateFrom'       => $dateFrom,
            'dateTo'         => $dateTo,
            'year'           => $year,
            'summary'        => $summary,
            'revenueByDay'   => $revenueByDay,
            'revenueByMonth' => $revenueByMonth,
            'topProducts'    => $topProducts,
            'productStats'   => $productStats,
            'orderCounts'    => $orderCounts,
            'totalUsers'     => $totalUsers,
        ]);
    }
}
