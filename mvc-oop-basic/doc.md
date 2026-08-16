### Cấu trúc thư mục

1. commons // File dùng chung cả dự án
2. uploads // Folder lưu trữ file upload

3. controllers // Xử lý logic
4. models // Thao tác cơ sở dữ liệu
5. views // Hiển thị
6. index.php // Điều hướng


- Cấu hình DB trong file commons/env.php

## Bổ sung yêu cầu hệ thống (gợi ý các mục còn thiếu)

1) Yêu cầu chức năng nhỏ nhưng quan trọng
- Đăng ký: xác thực email (email verification).
- Quên mật khẩu / đặt lại mật khẩu qua email.
- Xác thực bảo mật: mật khẩu băm (bcrypt), giới hạn thử đăng nhập (rate-limit).
- CSRF protection cho tất cả form (token).
- Kiểm tra và lọc dữ liệu đầu vào để tránh XSS/SQL injection.
- Upload ảnh: giới hạn định dạng, kích thước, tạo thumbnail và alt text cho SEO.
- Phân trang danh sách sản phẩm và đơn hàng.
- Sắp xếp và lọc nâng cao (theo giá, độ phổ biến, đánh giá, mới nhất).
- Tìm kiếm gợi ý (autocomplete) và tìm kiếm mờ (fuzzy search) cho tên sản phẩm.
- Breadcrumbs trên trang chi tiết để cải thiện điều hướng.
- Thiết lập đơn vị tính và variants (ví dụ: trọng lượng, kích thước) cho sản phẩm.
- Mã sản phẩm (SKU) và slug thân thiện SEO cho URL sản phẩm.

2) Giỏ hàng / Thanh toán / Đơn hàng
- Hạn chế tồn tại của giỏ hàng (timeout) hoặc lưu giỏ hàng cho user đã đăng nhập.
- Mã giảm giá / coupon (áp dụng, kiểm tra hợp lệ, thời hạn).
- Tính phí vận chuyển theo vùng, cân nặng hoặc cố định; hiển thị trước khi thanh toán.
- Cho phép khách hàng hủy đơn (trong trạng thái cho phép) và yêu cầu trả hàng/hoàn tiền.
- Tạo hóa đơn/PDF cho đơn hàng (tải về / in).
- Gửi email xác nhận đơn hàng và cập nhật trạng thái (mỗi lần thay đổi trạng thái).

3) Quản trị (Admin) bổ sung
- Phân quyền/role (Admin, Manager, Staff) với giới hạn thao tác.
- Import/Export sản phẩm/đơn hàng (CSV/Excel) cho quản lý hàng loạt.
- Cảnh báo tồn kho thấp, danh sách sản phẩm sắp hết hàng.
- Lịch sử thay đổi / audit log cho thao tác quản trị (ai, khi nào thay đổi).
- Báo cáo và lọc đơn hàng theo ngày/tháng/năm, xuất báo cáo CSV.

4) Phi chức năng (non-functional)
- Responsive / Mobile-first: giao diện hoạt động tốt trên điện thoại máy tính bảng.
- Hiệu năng: caching cho trang danh sách, chỉ số DB cho trường tìm kiếm/loc.
- Tối ưu hình ảnh (lazy loading, WebP tùy chọn) và dùng CDN nếu có.
- Backup định kỳ DB và cơ chế khôi phục.
- Ghi log lỗi, theo dõi (error tracking) và cảnh báo (ví dụ Sentry hoặc tương tự).
- Tuân thủ bảo mật dữ liệu: không log mật khẩu, mã hóa thông tin nhạy cảm.

5) UX / nhỏ tiện ích
- Thông báo toast khi thêm vào giỏ hàng / cập nhật thành công.
- Hiển thị breadcrumb, meta title/description cho SEO.
- Bộ lọc giữ trạng thái khi điều hướng (preserve filters on back).
- Hiển thị đánh giá & số sao trên danh sách, hỗ trợ lọc theo đánh giá.
- Chức năng wishlist / yêu thích (tùy chọn cho user).

6) Testing & triển khai
- Tạo dữ liệu mẫu (seed) cho dev/staging.
- Tests cơ bản: unit test cho model/logic, integration test cho luồng đặt hàng.
- Có môi trường staging trước khi deploy production.

7) Pháp lý / vận hành
- Trang điều khoản sử dụng và chính sách bảo mật / cookie.
- Lưu ý về quyền riêng tư và quản lý consent nếu thu thập email/đăng ký.

Ghi chú: các mục trên là các yêu cầu phổ biến thường thiếu trong bản mô tả chức năng; tôi có thể chèn từng mục vào vị trí phù hợp trong tài liệu chính hoặc tạo một file `SRS_additions.md` nếu bạn muốn tách biệt. Nếu đồng ý, tôi sẽ tiếp tục chèn chi tiết và thêm mức độ ưu tiên (High/Medium/Low) cho từng mục.