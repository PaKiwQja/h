<?php
    include_once("check_login.php");
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการสินค้า - ธีรภัทร์ มาตวังแสง (อีคิว)</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f4f7f6;
        }
        
        /* --- Sidebar Style (เหมือนหน้า Dashboard) --- */
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

        .btn-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: transform 0.2s;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3);
        }

        .card-custom {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            margin-bottom: 20px;
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
        
        /* ป้าย Status สวยๆ */
        .badge-soft-success { background-color: #dcfce7; color: #166534; }
        .badge-soft-warning { background-color: #fef9c3; color: #854d0e; }
        .badge-soft-danger  { background-color: #fee2e2; color: #991b1b; }
        
        .search-box {
            position: relative;
        }
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
                <a href="products.php" class="nav-link active">
                    <i class="bi bi-box-seam-fill"></i> จัดการสินค้า
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
            
            <div class="content-header">
                <div>
                    <h2 class="fw-bold mb-1">คลังสินค้า 📦</h2>
                    <p class="text-muted mb-0 small">จัดการรายการสินค้า ราคา และสต็อกของคุณ</p>
                </div>
                <a href="product_add.php" class="btn btn-gradient">
                    <i class="bi bi-plus-lg me-2"></i>เพิ่มสินค้าใหม่
                </a>
            </div>

            <div class="row mb-4 g-3">
                <div class="col-md-4">
                    <div class="card-custom p-3 d-flex align-items-center mb-0 h-100">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3 text-primary">
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">สินค้าทั้งหมด</small>
                            <h5 class="fw-bold mb-0">158 รายการ</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom p-3 d-flex align-items-center mb-0 h-100">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3 text-success">
                            <i class="bi bi-currency-dollar fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">มูลค่าสินค้ารวม</small>
                            <h5 class="fw-bold mb-0">฿450,200</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom p-3 d-flex align-items-center mb-0 h-100">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3 text-warning">
                            <i class="bi bi-exclamation-triangle fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">สินค้าใกล้หมด</small>
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
                            <input type="text" class="form-control" placeholder="ค้นหาชื่อสินค้า, รหัส SKU...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select bg-light border-0" style="border-radius: 10px;">
                            <option value="">หมวดหมู่ทั้งหมด</option>
                            <option value="1">เสื้อผ้า</option>
                            <option value="2">อุปกรณ์เสริม</option>
                            <option value="3">รองเท้า</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select bg-light border-0" style="border-radius: 10px;">
                            <option value="">สถานะทั้งหมด</option>
                            <option value="1">พร้อมขาย</option>
                            <option value="0">สินค้าหมด</option>
                        </select>
                    </div>
                    <div class="col-md-2 text-end">
                        <button class="btn btn-light w-100 text-secondary" style="border-radius: 10px;"><i class="bi bi-filter"></i> ตัวกรอง</button>
                    </div>
                </div>
            </div>

            <div class="card-custom p-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">สินค้า</th>
                                <th>หมวดหมู่</th>
                                <th>ราคา</th>
                                <th>คงเหลือ</th>
                                <th>สถานะ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=100&q=80" class="product-img me-3" alt="Product">
                                        <div>
                                            <div class="fw-bold text-dark">เสื้อยืด Minimal Cotton</div>
                                            <small class="text-muted">SKU: TS-005</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark border">เสื้อผ้า</span></td>
                                <td class="fw-bold text-primary">฿350.00</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 5px; width: 50px;">
                                            <div class="progress-bar bg-success" style="width: 80%"></div>
                                        </div>
                                        <span class="small text-muted">45 ชิ้น</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-soft-success rounded-pill px-3">พร้อมขาย</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-primary me-1" title="แก้ไข"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-light text-danger" title="ลบ"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=100&q=80" class="product-img me-3" alt="Product">
                                        <div>
                                            <div class="fw-bold text-dark">รองเท้าผ้าใบ Nike Air</div>
                                            <small class="text-muted">SKU: SH-102</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark border">รองเท้า</span></td>
                                <td class="fw-bold text-primary">฿2,900.00</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 5px; width: 50px;">
                                            <div class="progress-bar bg-warning" style="width: 20%"></div>
                                        </div>
                                        <span class="small text-danger fw-bold">2 ชิ้น</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-soft-warning rounded-pill px-3">ใกล้หมด</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-primary me-1"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=100&q=80" class="product-img me-3" alt="Product" style="filter: grayscale(100%);">
                                        <div>
                                            <div class="fw-bold text-muted">นาฬิกา Smart Watch</div>
                                            <small class="text-muted">SKU: WT-009</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark border">Gadget</span></td>
                                <td class="fw-bold text-muted">฿4,500.00</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 5px; width: 50px;">
                                            <div class="progress-bar bg-danger" style="width: 0%"></div>
                                        </div>
                                        <span class="small text-muted">0 ชิ้น</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-soft-danger rounded-pill px-3">สินค้าหมด</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-primary me-1"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center p-3 border-top">
                    <small class="text-muted">แสดง 1-3 จาก 158 รายการ</small>
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