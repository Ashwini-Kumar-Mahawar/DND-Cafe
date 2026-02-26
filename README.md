# DND Cafe - Dine-In Ordering System

> Desi n Delicious - QR-based ordering system for cafes

## 🍔 Features

- **QR Code Ordering** - Customers scan table QR codes to order
- **Session-based Security** - Prevents home ordering attempts
- **Real-time Kitchen Dashboard** - Live order updates for kitchen staff
- **Admin Panel** - Manage menu items, categories, tables, and orders
- **Payment Tracking** - Mark orders as paid (Cash/UPI)
- **Order Cancellation** - 2-minute cancellation window for customers
- **Soft Delete** - Recoverable deletion for menu items, categories, and tables
- **Responsive Design** - Works on desktop, tablet, and mobile

## 🛠️ Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade, Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Assets:** Vite

## 📸 Screenshots
<img width="1600" height="4655" alt="DND Cafe (1)" src="https://github.com/user-attachments/assets/bbe4b5e3-3865-4444-a0dd-689dac0bc3fb" />


## 🚀 Installation
```bash
# Clone repository
git clone https://github.com/YOUR-USERNAME/dnd-cafe.git
cd dnd-cafe

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate --seed

# Link storage
php artisan storage:link

# Build assets
npm run build

# Start server
php artisan serve
```

## 📝 Default Credentials

**Admin:**
- Email: admin@cafe.com
- Password: (set in .env)

**Kitchen:**
- Email: kitchen@cafe.com
- Password: (set in .env)

## 🏪 About DND Cafe

Located in Jaipur, Rajasthan - serving delicious burgers, momos, pizza, and more!

**Address:** Chawand ka Mand, Jamva Ramgar Road, Jaipur

## 📄 License

This project is for DND Cafe internal use.

## 🤝 Contributing

This is a private project for DND Cafe.
