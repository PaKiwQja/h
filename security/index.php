<?php
session_start();
$errorMsg = ""; // ตัวแปรสำหรับเก็บข้อความแจ้งเตือน

if(isset($_POST['Submit'])){
    include_once("connectdb.php");
    
    $sql = "SELECT a_id, a_name, a_password FROM admin WHERE a_username = ?"; 
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $_POST['auser']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            
            if (password_verify($_POST['apwd'], $data['a_password'])) {
                $_SESSION['aid'] = $data['a_id'];
                $_SESSION['aname'] = $data['a_name'];
                
                // Redirect ไปหน้า Dashboard
                header("Location: index2.php");
                exit;
            } else {
                $errorMsg = "รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่";
            }
        } else {
            $errorMsg = "ไม่พบชื่อผู้ใช้งานนี้ในระบบ";
        }
        mysqli_stmt_close($stmt);
    } else {
         $errorMsg = "SQL Error: " . mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เข้าสู่ระบบ - ธีรภัทร์ มาตวังแสง (อีคิว)</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: none;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        /* แถบสีตกแต่งด้านบนการ์ด */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, #2563eb 0%, #8b5cf6 100%);
        }

        .brand-logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #e0f2fe 0%, #f3e8ff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #2563eb;
            font-size: 2rem;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-gradient:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }

        .form-floating > .form-control {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background-color: #fcfcfc;
        }
        .form-floating > .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        
        .text-muted-custom { color: #94a3b8; font-size: 0.9rem; }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <div class="login-card">
                    <div class="text-center mb-4">
                        <div class="brand-logo">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h4 class="fw-bold mb-1">Admin Portal</h4>
                        <p class="text-muted-custom">เข้าสู่ระบบเพื่อจัดการร้านค้าของคุณ</p>
                    </div>

                    <?php if(!empty($errorMsg)): ?>
                        <div class="alert alert-danger d-flex align-items-center rounded-3 mb-3 p-2" role="alert">
                            <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"></i>
                            <div class="small">
                                <?php echo $errorMsg; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="auser" name="auser" placeholder="Username" autofocus required>
                            <label for="auser" class="text-secondary"><i class="bi bi-person me-2"></i>Username</label>
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="apwd" name="apwd" placeholder="Password" required>
                            <label for="apwd" class="text-secondary"><i class="bi bi-key me-2"></i>Password</label>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" name="Submit" class="btn btn-gradient btn-lg fs-6">
                                เข้าสู่ระบบ <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted-custom">
                            &copy; 2026 ธีรภัทร์ มาตวังแสง (อีคิว)<br>
                            System Version 2.0 Pro
                        </small>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>