# ShopKaia3 - Nền Tảng Bán Dịch Vụ Game

## Danh Mục

`Web ban hang` `Full Stack`

## Giới Thiệu

Nền tảng thương mại điện tử chuyên về dịch vụ game Liên Quân (Arena of Valor), hỗ trợ bán tài khoản game, dịch vụ cày thuê (boosting) và nạp thẻ với hệ thống thanh toán tích hợp.

## Chức Năng

- Bán tài khoản game với hệ thống đặt trước 15 phút
- Dịch vụ cày thuê (boosting)
- Nạp thẻ trực tuyến
- Ví điện tử nội bộ
- Thanh toán qua SePay (chuyển khoản ngân hàng) và TheSieuRe (thẻ cào)
- Quản lý sản phẩm, đơn hàng, người dùng (Admin)

## Công Nghệ Sử Dụng

- **Backend:** Laravel 10.x (PHP 8.1+)
- **Frontend:** Blade Templates, TailwindCSS 3.4+
- **Build Tool:** Vite
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **Payment:** SePay, TheSieuRe

## Yêu Cầu Hệ Thống

- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL >= 5.7

## Cài Đặt

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

## Chạy Ứng Dụng

```bash
php artisan serve
npm run dev
```
