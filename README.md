# Bài tập 1 – Shop Demo (PHP Session & Cart)

## 1. Giới thiệu
Shop Demo là website mini được xây dựng bằng **PHP thuần**, nhằm minh họa các kỹ thuật:
- Đăng nhập và xác thực người dùng
- Quản lý trạng thái bằng Session
- Remember me bằng Cookie
- Flash message sau redirect
- CSRF token cho thao tác quan trọng
- Giỏ hàng mini lưu bằng Session
- Tổ chức mã nguồn theo mô hình nhiều trang (multi-page)

Bài tập không sử dụng CSDL, toàn bộ dữ liệu được lưu trong **mảng PHP** hoặc **file**.

---

## 2. Chức năng chính
- Đăng nhập người dùng (username / password)
- Bảo vệ các trang yêu cầu đăng nhập
- Remember me (lưu username bằng Cookie)
- Đăng xuất bằng POST + CSRF token
- Hiển thị flash message (success / error / info)
- Danh sách sản phẩm giả lập
- Giỏ hàng mini:
  - Thêm sản phẩm
  - Cập nhật số lượng
  - Xóa sản phẩm
  - Xóa toàn bộ giỏ
- (Tùy chọn nâng cao)
  - Remember token lưu file JSON
  - Phân quyền user / admin
  - Ghi log login / logout

---

## 3. Công nghệ sử dụng
- PHP (Session, Cookie)
- HTML / CSS
- XAMPP (Apache + PHP)
- Trình duyệt Chrome / Edge

---

## 4. Hướng dẫn chạy chương trình
1. Cài đặt XAMPP và khởi động Apache
2. Copy thư mục `bt1_shop_demo` vào:

# Student Portal (Mini) — Hướng dẫn cài đặt & sử dụng

Project: Student Portal (PHP + JSON files)  
Đường dẫn mẫu trên máy bạn: `C:\xampp\htdocs\Labs\lab05\bt2_student_portal`  
URL truy cập mẫu: `http://localhost/Labs/lab05/bt2_student_portal/`

Ứng dụng này là một website nhỏ cho sinh viên:
- Đăng nhập bằng `student_code` + mật khẩu.
- Xem profile, xem điểm (grades).
- Xem danh mục học phần, đăng ký / hủy đăng ký học phần.
- Dữ liệu lưu bằng file JSON trong thư mục `data/`.
- Có CSRF token cho các thao tác thay đổi (register/unregister/logout).
- Có flash message (hiển thị 1 lần sau redirect).
- Không lưu mật khẩu dạng rõ; dùng `password_hash()` / `password_verify()`.

---

Yêu cầu
- PHP (khuyến nghị PHP 7.4+), XAMPP hoặc Apache+PHP trên máy local.
- Quyền ghi vào thư mục project để tạo `data/*.json`.

Cấu trúc thư mục (chính)
```
/bt2_student_portal
├── init.php
├── login.php
├── logout.php
├── dashboard.php
├── student/
│   ├── profile.php
│   ├── grades.php
│   ├── courses.php
│   ├── registrations.php
│   ├── register.php
│   └── unregister.php
├── includes/
│   ├── config.php
│   ├── data.php
│   ├── auth.php
│   ├── flash.php
│   ├── csrf.php
│   ├── header.php
│   └── footer.php
└── data/
    ├── students.json
    ├── courses.json
    ├── enrollments.json
    └── grades.json
```

Các hàm chính trong `includes/`:
- `read_json($file, $default)` / `write_json($file, $data)` — đọc/ghi file JSON.
- `csrf_token()` / `csrf_verify($token)` — CSRF protection.
- `set_flash()` / `get_flash()` — flash message.
- `require_login()` / `current_student()` — xác thực session.

---

Cách cài & chạy (Windows + XAMPP)

1. Đặt project vào:
   C:\xampp\htdocs\Labs\lab05\bt2_student_portal

2. Khởi động Apache (XAMPP Control Panel).

3. BASE_PATH:
   - Ứng dụng cố gắng tự động xác định `BASE_PATH` dựa trên `$_SERVER['DOCUMENT_ROOT']`.
   - Nếu URL của bạn khác, mở `includes/config.php` và tùy chỉnh:
     ```php
     define('BASE_PATH', '/Labs/lab05/bt2_student_portal/');
     ```
     (BASE_PATH là phần path trên web, phải bắt đầu và kết thúc bằng `/`.)

4. Khởi tạo dữ liệu (bắt buộc) — chạy 1 lần:
   - Từ Command Prompt:
     ```
     cd C:\xampp\htdocs\Labs\lab05\bt2_student_portal
     C:\xampp\php\php.exe init.php
     ```
     Hoặc nếu `php` trong PATH:
     ```
     php init.php
     ```
   - Hoặc mở trình duyệt:  
     `http://localhost/Labs/lab05/bt2_student_portal/init.php`

   Sau khi chạy, `data/*.json` sẽ được tạo: `students.json`, `courses.json`, `enrollments.json`, `grades.json`.

5. Mở trang login:
   `http://localhost/Labs/lab05/bt2_student_portal/login.php`

---

Tài khoản mẫu (sau khi chạy `init.php`)
- SV001 / 123456
- SV002 / abcdef
  Disclaimer: ts is AI slop for homework
