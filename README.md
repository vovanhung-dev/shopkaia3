# ShopKaia3 - Nen Tang Ban Dich Vu Game

## Danh Muc

`Web ban hang` `Full Stack`

## Gioi Thieu

Nen tang thuong mai dien tu chuyen ve dich vu game Lien Quan (Arena of Valor), ho tro ban tai khoan game, dich vu cay thue (boosting) va nap the voi he thong thanh toan tich hop.

## Chuc Nang

- Ban tai khoan game voi he thong dat truoc 15 phut
- Dich vu cay thue (boosting)
- Nap the truc tuyen
- Vi dien tu noi bo
- Thanh toan qua SePay (chuyen khoan ngan hang) va TheSieuRe (the cao)
- Quan ly san pham, don hang, nguoi dung (Admin)

## Cong Nghe Su Dung

- **Backend:** Laravel 10.x (PHP 8.1+)
- **Frontend:** Blade Templates, TailwindCSS 3.4+
- **Build Tool:** Vite
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **Payment:** SePay, TheSieuRe

## Yeu Cau He Thong

- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL >= 5.7

## Cai Dat

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

## Chay Ung Dung

```bash
php artisan serve
npm run dev
```
