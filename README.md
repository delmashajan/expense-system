# 💼 Expense Submission & Review System

A Laravel-based prototype tool for employees to submit expenses and for admins to review, filter, approve, or reject them. Includes both a user-facing UI and RESTful APIs.

---

## 🚀 Features

- Role-based registration and login (Admin or Employee)
- Employee dashboard to submit expenses with receipt upload and view their submissions
- Admin dashboard to view, filter and manage all expenses
- Secure file upload with validation and public access via storage
- RESTful API to create and fetch expenses with token-based auth
- Role-based access: Employee (1), Admin (0)
- Simple, responsive UI using Laravel Breeze

---

## 🛠️ Tech Stack

- Laravel 12
- Laravel Breeze (Authentication scaffolding)
- Sanctum (API authentication)
- MySQL

---

## ⚙️ Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/delmashajan/expense-system.git
cd expense-system
````

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

> Update `.env` with your DB credentials

### 4. Migrate and Seed Database

```bash
php artisan migrate --seed
```

This will create required tables and insert test users.

---

## 👥 Test Users

### 🔑 Admin

* Email: `admin@example.com`
* Password: `password`

### 👤 Employee

* Email: `employee1@example.com`
* Password: `password`

### 👤 Employee 

* Email: `employee2@example.com`
* Password: `password`

---

## 📦 API Endpoints

All API endpoints require **Sanctum Token** authentication via Bearer token.

### 🔐 Login

**POST** `/api/user/login`

```json
{
  "email": "employee@example.com",
  "password": "password"
}
```

Returns `token` for future requests.

---

### 📥 Create Expense

**POST** `/api/expenses`
Form-data with:

| Key         | Value              |
| ----------- | ------------------ |
| title       | Taxi Fare          |
| amount      | 300                |
| description | Travel for meeting |
| receipt     | File (jpg/png/pdf) |

---

### 📃 List Expenses

**GET** `/api/expenses`

* Admin: returns all
* Employee: returns own
* Optional filter: `?status=pending|approved|rejected`

---

### 📄 View Single Expense

**GET** `/api/expenses/{id}`

---

## 🖥️ Web App Flow (UI)

* Users register with a selected role
* Employees:

  * Log in
  * Submit new expenses with file upload
  * View submitted expenses and their status
* Admin:

  * Log in to view all submitted expenses
  * Filter expenses by status
  * Approve or reject pending expenses
* Role-based UI via Breeze layout
* Receipts can be downloaded/viewed


---

## 📂 Project Structure

* `/app/Http/Controllers`
* `/app/Http/Requests` - Validation Rules
* `/app/Http/Resources` - JSON API Structure
* `/app/Models/Expense.php`– Expense, Receipt, User models
* `/resources/views` – Blade templates
* `/routes/web.php` – Web routes
* `/routes/api.php` – API routes

---




