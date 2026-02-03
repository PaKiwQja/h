<?php
    include_once("check_login.php");
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการออเดอร์ - ธีรภัทร์ มาตวังแสง (อีคิว)</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f4f7f6;
        }
        
        /* --- Sidebar Style --- */
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

        /* --- Content Style --- */
        .main-content { padding: 30px; }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn-outline-custom {
            border: 1px solid #e2e8f0;
            color: #64748b;
            background: white;
            border-radius: 10px;
            padding: 8px 15px;
            transition: all 0.2s;
        }
        .btn-outline-custom:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #334155;
        }

        .card-custom {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            margin-bottom: 20px;
        }

        /* Stats Card Specifics */
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .table-custom th {
            background-color: #f9fafb;
            color: #6b7280;
            font-weight: 500;
            padding: 15px;
            border-bottom: 1px solid #edf2f7;
            white-space: nowrap;
        }
        .table-custom td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
        }

        /* Status Badges */
        .badge-soft-primary { background-color: #e0f2fe; color: #0284c7; } /* Paid/Processing */
        .badge-soft-warning { background-color: #fef9c3; color: #ca8a04; } /* Pending */
        .badge-soft-success { background-color: #dcfce7; color: #166534; } /* Completed */
        .badge-soft-danger  { background-color: #fee2e2; color: #991b1b; } /* Cancelled */

        .search-box { position: relative; }
        .search-box input {
            padding-left: 40px;
            border-radius: 10px;
            background-color: #f9fafb;
            border: 1px solid #eee;
        }
        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
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
                </div>
                <h6 class="mt-2 mb-0 fw-bold"><?php echo $_SESSION['aname']; ?></h6>
                <small class="text-muted">Super Admin</small>
            </div>
            
            <div class="nav flex-column">
                <a href="index2.php" class="nav-link">
                    <i class="bi bi-grid-1x2"></i> แดชบอร์ด
                </a>
                <a href="products.php" class="nav-link">
                    <i class="bi bi-box-seam"></i> จัดการสินค้า
                </a>
                <a href="orders.php" class="nav-link active">
                    <i class="bi bi-cart3-fill"></i> จัดการออเดอร์
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
            
            <div class="content-header">
                <div>
                    <h2 class="fw-bold mb-1">รายการสั่งซื้อ 🛒</h2>
                    <p class="text-muted mb-0 small">จัดการและติดตามสถานะออเดอร์ทั้งหมด</p>
                </div>
                <div>
                    <button class="btn btn-outline-custom me-2">
                        <i class="bi bi-printer me-2"></i>พิมพ์รายงาน
                    </button>
                    <button class="btn btn-primary" style="border-radius: 10px;">
                        <i class="bi bi-download me-2"></i>Export CSV
                    </button>
                </div>
            </div>

            <div class="row mb-4 g-3">
                <div class="col-6 col-lg-3">
                    <div class="card-custom p-3 d-flex align-items-center h-100">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div>
                            <small class="text-muted">รอชำระเงิน</small>
                            <h5 class="fw-bold mb-0">5 รายการ</h5>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card-custom p-3 d-flex align-items-center h-100">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div>
                            <small class="text-muted">เตรียมจัดส่ง</small>
                            <h5 class="fw-bold mb-0">12 รายการ</h5>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card-custom p-3 d-flex align-items-center h-100">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div>
                            <small class="text-muted">สำเร็จแล้ว</small>
                            <h5 class="fw-bold mb-0">845 รายการ</h5>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card-custom p-3 d-flex align-items-center h-100">
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div>
                            <small class="text-muted">ยกเลิก</small>
                            <h5 class="fw-bold mb-0">3 รายการ</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-custom p-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="ค้นหาเลข Order, ชื่อลูกค้า...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-calendar3"></i></span>
                            <input type="date" class="form-control bg-light border-0" style="border-radius: 0 10px 10px 0;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select bg-light border-0" style="border-radius: 10px;">
                            <option value="">สถานะทั้งหมด</option>
                            <option value="pending">รอชำระเงิน</option>
                            <option value="paid">เตรียมจัดส่ง</option>
                            <option value="completed">สำเร็จ</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-light w-100 text-secondary" style="border-radius: 10px;">ล้างค่า</button>
                    </div>
                </div>
            </div>

            <div class="card-custom p-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">เลขที่คำสั่งซื้อ</th>
                                <th>ลูกค้า</th>
                                <th>วันที่สั่งซื้อ</th>
                                <th>ยอดชำระ</th>
                                <th>การชำระเงิน</th>
                                <th>สถานะ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold text-primary">#ORD-8823</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-2 text-secondary"><i class="bi bi-person"></i></div>
                                        <div>
                                            <div class="fw-medium">คุณธนพล</div>
                                            <small class="text-muted">089-123-4567</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted small">03 ก.พ. 2026<br>10:30 น.</td>
                                <td class="fw-bold">฿1,250</td>
                                <td><span class="small text-muted"><i class="bi bi-bank me-1"></i>โอนเงิน</span></td>
                                <td><span class="badge badge-soft-warning rounded-pill px-3">รอชำระเงิน</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-secondary"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-primary">#ORD-8822</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-2 text-secondary"><i class="bi bi-person"></i></div>
                                        <div>
                                            <div class="fw-medium">คุณวิภาวดี</div>
                                            <small class="text-muted">091-888-9999</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted small">03 ก.พ. 2026<br>09:15 น.</td>
                                <td class="fw-bold">฿4,500</td>
                                <td><span class="small text-muted"><i class="bi bi-credit-card me-1"></i>บัตรเครดิต</span></td>
                                <td><span class="badge badge-soft-primary rounded-pill px-3">เตรียมจัดส่ง</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-secondary me-1"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-light text-primary"><i class="bi bi-printer"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-primary">#ORD-8820</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-2 text-secondary"><i class="bi bi-person"></i></div>
                                        <div>
                                            <div class="fw-medium">คุณสมชาย</div>
                                            <small class="text-muted">081-555-6666</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted small">02 ก.พ. 2026<br>14:20 น.</td>
                                <td class="fw-bold">฿350</td>
                                <td><span class="small text-muted"><i class="bi bi-cash me-1"></i>ปลายทาง</span></td>
                                <td><span class="badge badge-soft-success rounded-pill px-3">สำเร็จแล้ว</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-secondary"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>

                             <tr>
                                <td class="ps-4 fw-bold text-primary">#ORD-8819</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-2 text-secondary"><i class="bi bi-person"></i></div>
                                        <div>
                                            <div class="fw-medium">คุณกานดา</div>
                                            <small class="text-muted">082-222-3333</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted small">01 ก.พ. 2026<br>11:00 น.</td>
                                <td class="fw-bold text-muted">฿900</td>
                                <td><span class="small text-muted">-</span></td>
                                <td><span class="badge badge-soft-danger rounded-pill px-3">ยกเลิก</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-secondary"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center p-3 border-top">
                    <small class="text-muted">แสดง 1-4 จาก 855 รายการ</small>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link border-0" href="#">ก่อนหน้า</a></li>
                            <li class="page-item active"><a class="page-link border-0 rounded-circle mx-1" href="#">1</a></li>
                            <li class="page-item"><a class="page-link border-0 rounded-circle mx-1 text-secondary" href="#">2</a></li>
                            <li class="page-item"><a class="page-link border-0 rounded-circle mx-1 text-secondary" href="#">3</a></li>
                            <li class="page-item"><a class="page-link border-0 text-primary" href="#">ถัดไป</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </main>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>