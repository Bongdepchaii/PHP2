
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<?php
$months = ['','Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6',
           'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'];

// Chuẩn bị dữ liệu chart theo ngày
$chartDays    = [];
$chartRevenue = [];
$chartOrders  = [];
foreach ($revenueByDay as $r) {
    $chartDays[]    = date('d/m', strtotime($r['day']));
    $chartRevenue[] = (float)$r['revenue'];
    $chartOrders[]  = (int)$r['orders'];
}

// Chart theo tháng
$monthLabels  = array_fill(1, 12, 0);
$monthRevArr  = array_fill(1, 12, 0);
foreach ($revenueByMonth as $r) {
    $monthRevArr[(int)$r['month']] = (float)$r['revenue'];
}
?>

<div class="row">
<div class="col-12 px-3 ms-1 me-1 mt-2">


<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" action="/dashboard" class="row g-2 align-items-end">
            <div class="col-auto">
                <label class="form-label small mb-1">Từ ngày</label>
                <input type="date" class="form-control form-control-sm" name="date_from" value="<?php echo e($dateFrom); ?>">
            </div>
            <div class="col-auto">
                <label class="form-label small mb-1">Đến ngày</label>
                <input type="date" class="form-control form-control-sm" name="date_to" value="<?php echo e($dateTo); ?>">
            </div>
            <div class="col-auto">
                <label class="form-label small mb-1">Năm (chart tháng)</label>
                <select class="form-select form-select-sm" name="year">
                    <?php for($y = date('Y'); $y >= date('Y') - 4; $y--): ?>
                    <option value="<?php echo e($y); ?>" <?php echo e($year == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary ms-1 mb-1">
                    <i class="feather-filter me-1"></i>Lọc
                </button>
                <a href="/dashboard" class="btn btn-sm btn-outline-secondary ms-1">
                    <i class="feather-refresh-cw me-1"></i>Reset
                </a>
            </div>
        </form>
    </div>
</div>



<div class="row g-3 mb-3">
    <div class="col-6 col-md-3">
        <div class="card stretch stretch-full border-0 bg-soft-primary">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar-text avatar-md bg-primary text-white rounded me-3">
                        <i class="feather-shopping-bag"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Tổng đơn hàng</div>
                        <div class="fw-bold fs-5"><?php echo e(number_format($summary['total_orders'])); ?></div>
                    </div>
                </div>
                <small class="text-muted">
                    <span class="text-success me-1">✓ <?php echo e($summary['done_orders']); ?> hoàn thành</span>·
                    <span class="text-danger ms-1">✗ <?php echo e($summary['cancelled_orders']); ?> hủy</span>
                </small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stretch stretch-full border-0 bg-soft-success">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar-text avatar-md bg-success text-white rounded me-3">
                        <i class="feather-trending-up"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Doanh thu</div>
                        <div class="fw-bold fs-6 text-success"><?php echo e(number_format($summary['total_revenue'], 0, ',', '.')); ?>đ</div>
                    </div>
                </div>
                <small class="text-muted">Giảm giá: <?php echo e(number_format($summary['total_discount'], 0, ',', '.')); ?>đ</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stretch stretch-full border-0 bg-soft-warning">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar-text avatar-md bg-warning text-white rounded me-3">
                        <i class="feather-box"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Sản phẩm</div>
                        <div class="fw-bold fs-5"><?php echo e(number_format($productStats['total'] ?? 0)); ?></div>
                    </div>
                </div>
                <small class="text-muted">
                    <span class="text-success"><?php echo e($productStats['in_stock'] ?? 0); ?> còn hàng</span> ·
                    <span class="text-danger"><?php echo e($productStats['out_of_stock'] ?? 0); ?> hết hàng</span>
                </small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stretch stretch-full border-0 bg-soft-info">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar-text avatar-md bg-info text-white rounded me-3">
                        <i class="feather-users"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Người dùng</div>
                        <div class="fw-bold fs-5"><?php echo e(number_format($totalUsers)); ?></div>
                    </div>
                </div>
                <small class="text-muted">Tổng tài khoản</small>
            </div>
        </div>
    </div>
</div>


<div class="row g-3 mb-3">
    <?php
    $statusInfo = [
        'pending'   => ['label' => 'Chờ xử lý',  'icon' => 'feather-clock',        'color' => 'warning'],
        'confirmed' => ['label' => 'Xác nhận',    'icon' => 'feather-check-circle', 'color' => 'info'],
        'shipping'  => ['label' => 'Đang giao',   'icon' => 'feather-truck',        'color' => 'primary'],
        'done'      => ['label' => 'Hoàn thành',  'icon' => 'feather-check-square', 'color' => 'success'],
        'cancelled' => ['label' => 'Đã hủy',      'icon' => 'feather-x-circle',     'color' => 'danger'],
    ];
    ?>
    <?php $__currentLoopData = $statusInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col">
        <a href="/order/index?status=<?php echo e($key); ?>" class="card stretch stretch-full text-decoration-none">
            <div class="card-body text-center py-3">
                <i class="<?php echo e($info['icon']); ?> text-<?php echo e($info['color']); ?> mb-1" style="font-size:1.5rem;display:block;"></i>
                <div class="fw-bold fs-5"><?php echo e($orderCounts[$key] ?? 0); ?></div>
                <div class="text-muted small"><?php echo e($info['label']); ?></div>
            </div>
        </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="row g-3 mb-3">
    
    <div class="col-lg-8">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Doanh thu theo ngày (<?php echo e(date('d/m/Y', strtotime($dateFrom))); ?> — <?php echo e(date('d/m/Y', strtotime($dateTo))); ?>)</h5>
            </div>
            <div class="card-body">
                <canvas id="chartByDay" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Doanh thu theo tháng <?php echo e($year); ?></h5>
            </div>
            <div class="card-body">
                <canvas id="chartByMonth" height="220"></canvas>
            </div>
        </div>
    </div>
</div>


<div class="row g-3">
    <div class="col-lg-7">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title"><i class="feather-award me-2"></i>Top 5 sản phẩm bán chạy</h5>
            </div>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Tên sản phẩm</th>
                                <th class="text-center">Đã bán (cái)</th>
                                <th class="text-end">Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <?php if($i === 0): ?><span class="badge bg-warning text-dark">1</span>
                                    <?php elseif($i === 1): ?><span class="badge bg-soft-secondary">2</span>
                                    <?php elseif($i === 2): ?><span class="badge bg-soft-warning">3</span>
                                    <?php else: ?> <span class="text-muted"><?php echo e($i + 1); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-semibold"><?php echo e($p['product_name']); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-soft-primary text-primary"><?php echo e(number_format($p['total_qty'])); ?></span>
                                </td>
                                <td class="text-end fw-bold text-success">
                                    <?php echo e(number_format($p['total_revenue'], 0, ',', '.')); ?>đ
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="4" class="text-center text-muted py-4">Chưa có dữ liệu</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-5">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title"><i class="feather-pie-chart me-2"></i>Phân bố trạng thái đơn</h5>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="chartDonut" style="max-height:260px;"></canvas>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>

// CHART THEO NGÀY
const ctxDay = document.getElementById('chartByDay');
if (ctxDay) {
    new Chart(ctxDay, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($chartDays); ?>,
            datasets: [{
                label: 'Doanh thu (đ)',
                data: <?php echo json_encode($chartRevenue); ?>,
                backgroundColor: 'rgba(99,102,241,0.7)',
                borderColor: '#6366f1',
                borderWidth: 1,
                borderRadius: 4,
                yAxisID: 'y',
            },{
                label: 'Đơn',
                data: <?php echo json_encode($chartOrders); ?>,
                type: 'line',
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,0.1)',
                tension: 0.4,
                fill: true,
                yAxisID: 'y1',
            }]
        },
        options: {
            responsive: true,
            interaction: { mode: 'index', intersect: false },
            plugins: { legend: { position: 'top' } },
            scales: {
                y:  { type: 'linear', position: 'left',  ticks: { callback: v => v.toLocaleString('vi') + 'đ' } },
                y1: { type: 'linear', position: 'right', grid: { drawOnChartArea: false } },
            }
        }
    });
}

// CHART THEO THÁNG

const ctxMonth = document.getElementById('chartByMonth');
if (ctxMonth) {
    new Chart(ctxMonth, {
        type: 'bar',
        data: {
            labels: ['T1','T2','T3','T4','T5','T6','T7','T8','T9','T10','T11','T12'],
            datasets: [{
                label: 'Doanh thu',
                data: <?php echo json_encode(array_values($monthRevArr)); ?>,
                backgroundColor: [
                    '#6366f1','#8b5cf6','#ec4899','#f43f5e','#f97316',
                    '#eab308','#22c55e','#14b8a6','#06b6d4','#3b82f6',
                    '#a855f7','#d946ef'
                ],
                borderRadius: 5,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { ticks: { callback: v => v.toLocaleString('vi') + 'đ' } } }
        }
    });
}

// === Donut chart trạng thái đơn ===
const ctxDonut = document.getElementById('chartDonut');
if (ctxDonut) {
    new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: ['Chờ xử lý','Xác nhận','Đang giao','Hoàn thành','Đã hủy'],
            datasets: [{
                data: [
                    <?php echo e($orderCounts['pending']   ?? 0); ?>,
                    <?php echo e($orderCounts['confirmed'] ?? 0); ?>,
                    <?php echo e($orderCounts['shipping']  ?? 0); ?>,
                    <?php echo e($orderCounts['done']      ?? 0); ?>,
                    <?php echo e($orderCounts['cancelled'] ?? 0); ?>,
                ],
                backgroundColor: ['#f59e0b','#06b6d4','#6366f1','#22c55e','#ef4444'],
                borderWidth: 2,
                hoverOffset: 6,
            }]
        },
        options: {
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 16 } }
            }
        }
    });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/dashboard/index.blade.php ENDPATH**/ ?>