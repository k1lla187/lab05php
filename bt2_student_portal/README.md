```markdown
# Student Portal (Mini)

Hướng dẫn nhanh:

1. Copy toàn bộ thư mục `lab05_hw` vào webserver (hoặc `htdocs`).
2. Mở `includes/config.php` và chỉnh `BASE_PATH` nếu bạn phục vụ project trong subfolder (ví dụ `/lab05_hw/`).
3. Chạy `init.php` một lần để khởi tạo data (tạo file JSON có password_hash):
   - Trên CLI: `php init.php`
   - Hoặc truy cập `http://your-host/lab05_hw/init.php` (nếu server cho phép)
4. Mở `login.php`. Dài liệu mẫu: user `SV001`, password `123456`.
5. Sử dụng các chức năng: xem profile, xem điểm, danh sách học phần, đăng ký, hủy đăng ký.
6. Lưu ý:
   - Tất cả thao tác thay đổi dữ liệu đều dùng POST.
   - Có CSRF token cho register/unregister/logout.
   - Dữ liệu lưu trong `data/*.json`.
```