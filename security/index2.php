<?php
    include_once("check_login.php");
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Pro - ธีรภัทร์ มาตวังแสง (อีคิว)</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f4f7f6;
        }
        /* Sidebar Styles */
        .sidebar {
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #eee;
            z-index: 100;
        }
        .nav-link {
            color: #666;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 5px 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        .nav-link:hover, .nav-link.active {
            background-color: #f0f2f5;
            color: #2563eb;
            font-weight: 500;
        }
        .nav-link i { margin-right: 12px; font-size: 1.1rem; }
        
        /* Dashboard Content Styles */
        .main-content { padding: 30px; }
        
        .welcome-banner {
            background: linear-gradient(135deg, #2563eb 0%, #8b5cf6 100%); /* ไล่สีน้ำเงิน-ม่วง */
            color: white;
            border-radius: 20px;
            padding: 40px 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
            position: relative;
            overflow: hidden;
        }
        .welcome-banner::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            transition: transform 0.3s ease;
            height: 100%;
        }
        .stat-card:hover { transform: translateY(-5px); }
        
        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        .bg-purple-light { background: #f3e8ff; color: #9333ea; }
        .bg-blue-light { background: #e0f2fe; color: #0284c7; }
        .bg-green-light { background: #dcfce7; color: #16a34a; }
        .bg-orange-light { background: #ffedd5; color: #ea580c; }

        .chart-container {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            height: 100%;
        }
        
        .table-custom th { 
            background-color: #f9fafb; 
            font-weight: 500; 
            color: #6b7280;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="p-4 text-center border-bottom mb-4">
                <div class="position-relative d-inline-block">
                    <img src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['aname']; ?>&background=random" class="rounded-circle mb-2" width="80">
                    <span class="position-absolute bottom-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle"></span>
                </div>
                <h6 class="mt-2 mb-0 fw-bold"><?php echo $_SESSION['aname']; ?></h6>
                <small class="text-muted">Super Admin</small>
            </div>
            
            <div class="nav flex-column">
                <a href="index2.php" class="nav-link active">
                    <i class="bi bi-grid-1x2-fill"></i> แดชบอร์ด
                </a>
                <a href="products.php" class="nav-link">
                    <i class="bi bi-box-seam"></i> จัดการสินค้า
                </a>
                <a href="orders.php" class="nav-link">
                    <i class="bi bi-cart3"></i> จัดการออเดอร์
                </a>
                <a href="customers.php" class="nav-link">
                    <i class="bi bi-people"></i> จัดการลูกค้า
                </a>
                <div class="mt-5 px-3">
                    <a href="logout.php" class="btn btn-danger w-100 rounded-3">
                        <i class="bi bi-box-arrow-right me-2"></i> ออกจากระบบ
                    </a>
                </div>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
            
            <div class="welcome-banner">
                <h2 class="fw-bold mb-1">สวัสดี, คุณ<?php echo $_SESSION['aname']; ?>! 👋</h2>
                <p class="mb-0 opacity-75">นี่คือภาพรวมของร้านค้าประจำวันนี้</p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1">ยอดขายรวม</p>
                                <h3 class="fw-bold mb-0">฿45,200</h3>
                            </div>
                            <div class="icon-box bg-purple-light"><i class="bi bi-currency-dollar"></i></div>
                        </div>
                        <small class="text-success"><i class="bi bi-arrow-up-short"></i> +12% จากเดือนก่อน</small>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1">ออเดอร์ใหม่</p>
                                <h3 class="fw-bold mb-0">12 รายการ</h3>
                            </div>
                            <div class="icon-box bg-blue-light"><i class="bi bi-bag-check"></i></div>
                        </div>
                        <small class="text-muted">รอการจัดส่งวันนี้</small>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1">สินค้าทั้งหมด</p>
                                <h3 class="fw-bold mb-0">158 ชิ้น</h3>
                            </div>
                            <div class="icon-box bg-orange-light"><i class="bi bi-box"></i></div>
                        </div>
                        <small class="text-warning">สินค้าใกล้หมด 3 ชิ้น</small>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1">สมาชิก</p>
                                <h3 class="fw-bold mb-0">2,405 คน</h3>
                            </div>
                            <div class="icon-box bg-green-light"><i class="bi bi-people"></i></div>
                        </div>
                        <small class="text-success">+5 คนในวันนี้</small>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="chart-container">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">สถิติยอดขาย 7 วันล่าสุด</h5>
                            <select class="form-select form-select-sm w-auto border-0 bg-light">
                                <option>สัปดาห์นี้</option>
                                <option>เดือนนี้</option>
                            </select>
                        </div>
                        <canvas id="salesChart" height="120"></canvas>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="chart-container">
                        <h5 class="fw-bold mb-4">ออเดอร์ล่าสุด</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-custom align-middle">
                                <tbody>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded me-3"><i class="bi bi-phone"></i></div>
                                                <div>
                                                    <div class="fw-medium">iPhone 15</div>
                                                    <small class="text-muted">คุณสมชาย</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end fw-bold text-primary">฿32,900</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded me-3"><i class="bi bi-headphones"></i></div>
                                                <div>
                                                    <div class="fw-medium">AirPods</div>
                                                    <small class="text-muted">คุณวิภา</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end fw-bold text-primary">฿5,500</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded me-3"><i class="bi bi-laptop"></i></div>
                                                <div>
                                                    <div class="fw-medium">MacBook</div>
                                                    <small class="text-muted">คุณกรณ์</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end fw-bold text-primary">฿42,500</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-light w-100 text-primary mt-2">ดูออเดอร์ทั้งหมด</button>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // ตั้งค่ากราฟจำลอง (Sales Chart)
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['จันทร์', 'อังคาร', 'พุธ', 'พฤหัส', 'ศุกร์', 'เสาร์', 'อาทิตย์'],
                datasets: [{
                    label: 'ยอดขาย (บาท)',
                    data: [12000, 19000, 15000, 25000, 22000, 30000, 45000],
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    tension: 0.4, // ทำให้เส้นโค้งสวยงาม
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>