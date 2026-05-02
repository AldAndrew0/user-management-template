# 🗂️ Management System Template

A reusable boilerplate for building web management systems in pure PHP.
Allows you to manage users, students, clients, or any type of entity
with the basic operations: create, read, update, and delete (CRUD).

---

## 🚀 Technologies Used

- **PHP** — backend logic
- **MySQL** — database
- **Composer** — PHP package manager
- **vlucas/phpdotenv** — environment variables management
- **HTML + CSS + JavaScript** — frontend
- **Laragon** — local development environment

---

## 📁 Project Structure

```
user-management-template/
│
├── assets/                  # Static files (styles, scripts, images)
│   ├── css/style.css
│   ├── js/main.js
│   └── img/
│
├── config/
│   └── database.php         # Database connection configuration
│
├── database/
│   └── user-management.sql  # Database schema
│
├── includes/                # Reusable components
│   ├── auth.php             # Page protection — redirects to login if not authenticated
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
│
├── pages/
│   ├── auth/                # Login and logout
│   │   ├── login.php
│   │   └── logout.php
│   └── Users/               # Users CRUD
│       ├── index.php        # Users list
│       ├── create.php       # Create user
│       ├── edit.php         # Edit user
│       └── delete.php       # Delete user
│
├── .env.example             # Environment variables example → rename to .env
├── composer.json            # PHP dependencies
├── index.php                # Homepage / Dashboard
└── README.md
```

---

## ⚙️ Installation

1. Clone the repository into Laragon's `www` folder:
```bash
   git clone https://github.com/AldAndrew0/user-management-template.git
```

2. Install PHP dependencies with Composer:
```bash
   composer install
```

3. Start **Laragon** (Apache + MySQL)

4. Import the database:
   database/user-management.sql

5. Copy the `.env.example` file, rename it to `.env` and fill in your credentials:
   DB_HOST=your_host
   DB_USER=your_username
   DB_PASS=your_password
   DB_NAME=your_database_name

6. Open your browser and go to:
```bash
http://user-management-template.test/
```

---

## 🔄 How to Reuse This Template

This project is designed to be a **boilerplate**. To adapt it to a new management system:

1. Rename the `pages/Users/` folder with your entity name (e.g. `Students/`, `Clients/`)
2. Update variable names and database fields
3. Change the title and theme in `includes/header.php`

---

## 📌 Features

- [x] Base project structure
- [x] Database configuration with environment variables
- [x] Database connection
- [x] Authentication system (login/logout)
- [x] Full users CRUD
- [x] Session management
- [x] Form validation
- [ ] Migration to Laravel

---

## 👤 Author

**Andrea**