<?php
    include_once("check_login.php");
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการลูกค้า - ธีรภัทร์ มาตวังแสง (อีคิว)</title>
    
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

        .card-custom {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            margin-bottom: 20px;
        }

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
        }
        .table-custom td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
        }

        /* Avatar Styling */
        .avatar-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Badges */
        .badge-soft-success { background-color: #dcfce7; color: #166534; }
        .badge-soft-danger  { background-color: #fee2e2; color: #991b1b; }
        .badge-soft-purple  { background-color: #f3e8ff; color: #6b21a8; } /* VIP */
        .badge-soft-gray    { background-color: #f3f4f6; color: #374151; } /* Regular */

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
        
        .contact-link {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .contact-link:hover { color: #2563eb; }
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
                <a href="orders.php" class="nav-link">
                    <i class="bi bi-cart3"></i> จัดการออเดอร์
                </a>
                <a href="customers.php" class="nav-link active">
                    <i class="bi bi-people-fill"></i> จัดการลูกค้า
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
                    <h2 class="fw-bold mb-1">ฐานข้อมูลลูกค้า 👥</h2>
                    <p class="text-muted mb-0 small">จัดการสมาชิกและประวัติการสั่งซื้อ</p>
                </div>
                <div>
                    <button class="btn btn-outline-success me-2" style="border-radius: 10px;">
                        <i class="bi bi-file-earmark-excel me-2"></i>Export CSV
                    </button>
                    <button class="btn btn-primary" style="border-radius: 10px;">
                        <i class="bi bi-person-plus me-2"></i>เพิ่มลูกค้า
                    </button>
                </div>
            </div>

            <div class="row mb-4 g-3">
                <div class="col-md-4">
                    <div class="card-custom p-3 d-flex align-items-center h-100">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <small class="text-muted">ลูกค้าทั้งหมด</small>
                            <h5 class="fw-bold mb-0">2,405 คน</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom p-3 d-flex align-items-center h-100">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div>
                            <small class="text-muted">สมัครใหม่เดือนนี้</small>
                            <h5 class="fw-bold mb-0">+128 คน</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom p-3 d-flex align-items-center h-100">
                        <div class="stat-icon bg-purple-light text-primary" style="background:#f3e8ff; color:#7e22ce;">
                            <i class="bi bi-star"></i>
                        </div>
                        <div>
                            <small class="text-muted">ลูกค้า VIP</small>
                            <h5 class="fw-bold mb-0">54 คน</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-custom p-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="ค้นหาชื่อ, อีเมล หรือเบอร์โทร...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select bg-light border-0" style="border-radius: 10px;">
                            <option value="">ระดับสมาชิกทั้งหมด</option>
                            <option value="vip">VIP Member</option>
                            <option value="regular">Regular</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select bg-light border-0" style="border-radius: 10px;">
                            <option value="">สถานะบัญชี</option>
                            <option value="active">ใช้งานปกติ</option>
                            <option value="banned">ระงับการใช้งาน</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-custom p-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">ชื่อ-นามสกุล</th>
                                <th>ข้อมูลติดต่อ</th>
                                <th>ที่อยู่จัดส่งล่าสุด</th>
                                <th>ยอดซื้อรวม</th>
                                <th>สถานะ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Somchai+Jaidee&background=f3e8ff&color=7e22ce" class="avatar-img me-3" alt="Avatar">
                                        <div>
                                            <div class="fw-bold text-dark">คุณสมชาย ใจดี</div>
                                            <span class="badge badge-soft-purple rounded-pill" style="font-size:0.7rem;"><i class="bi bi-star-fill me-1"></i>VIP</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="mailto:somchai@email.com" class="contact-link"><i class="bi bi-envelope me-2"></i>somchai@email.com</a>
                                        <a href="tel:0812345678" class="contact-link mt-1"><i class="bi bi-telephone me-2"></i>081-234-5678</a>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted small text-truncate d-inline-block" style="max-width: 200px;">
                                        123 ถ.สุขุมวิท แขวงคลองตัน เขตคลองเตย กทม. 10110
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">฿45,200</div>
                                    <small class="text-muted">12 ออเดอร์</small>
                                </td>
                                <td><span class="badge badge-soft-success rounded-pill px-3">Active</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-primary me-1"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-light text-secondary"><i class="bi bi-three-dots-vertical"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Kanda+Rak&background=e0f2fe&color=0284c7" class="avatar-img me-3" alt="Avatar">
                                        <div>
                                            <div class="fw-bold text-dark">คุณกานดา รักเรียน</div>
                                            <span class="badge badge-soft-gray rounded-pill" style="font-size:0.7rem;">Member</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="mailto:kanda@email.com" class="contact-link"><i class="bi bi-envelope me-2"></i>kanda@email.com</a>
                                        <a href="tel:0899998888" class="contact-link mt-1"><i class="bi bi-telephone me-2"></i>089-999-8888</a>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted small text-truncate d-inline-block" style="max-width: 200px;">
                                        45 หมู่ 8 ต.ขามเรียง อ.กันทรวิชัย จ.มหาสารคาม
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">฿350</div>
                                    <small class="text-muted">1 ออเดอร์</small>
                                </td>
                                <td><span class="badge badge-soft-success rounded-pill px-3">Active</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-primary me-1"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-light text-secondary"><i class="bi bi-three-dots-vertical"></i></button>
                                </td>
                            </tr>

                             <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Mana+Chai&background=fee2e2&color=991b1b" class="avatar-img me-3" alt="Avatar" style="filter: grayscale(100%);">
                                        <div>
                                            <div class="fw-bold text-muted">คุณมานะ ชัยชนะ</div>
                                            <span class="badge badge-soft-gray rounded-pill" style="font-size:0.7rem;">Member</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-muted small"><i class="bi bi-envelope me-2"></i>mana@test.com</span>
                                        <span class="text-muted small mt-1"><i class="bi bi-telephone me-2"></i>081-000-0000</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted small text-truncate d-inline-block" style="max-width: 200px;">
                                        -
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-muted">฿0</div>
                                    <small class="text-muted">0 ออเดอร์</small>
                                </td>
                                <td><span class="badge badge-soft-danger rounded-pill px-3">ระงับการใช้งาน</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-secondary me-1"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-light text-secondary"><i class="bi bi-three-dots-vertical"></i></button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                
                 <div class="d-flex justify-content-between align-items-center p-3 border-top">
                    <small class="text-muted">แสดง 1-3 จาก 2,405 รายการ</small>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link border-0" href="#">ก่อนหน้า</a></li>
                            <li class="page-item active"><a class="page-link border-0 rounded-circle mx-1" href="#">1</a></li>
                            <li class="page-item"><a class="page-link border-0 rounded-circle mx-1 text-secondary" href="#">2</a></li>
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