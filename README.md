# eHealth Management System

![eHealth Management](https://img.shields.io/badge/Health-Information%20System-1cc88a)
![Laravel](https://img.shields.io/badge/Laravel-Latest-red)
![License](https://img.shields.io/badge/License-MIT-blue)

A comprehensive health information system designed for healthcare professionals to efficiently manage clients, health programs, and enrollments. The system provides a secure, intuitive interface for healthcare management with advanced features for client tracking and program administration.

## Features

- **Secure Admin Authentication** - Role-based access control with admin authorization
- **Healthcare Program Management** - Create, view, update, and manage healthcare programs
- **Client Management** - Register and manage patient information securely
- **Program Enrollment** - Enroll clients in one or multiple healthcare programs
- **Advanced Search Functionality** - Find clients by name, ID, gender, or program
- **Dashboard Analytics** - Real-time statistics on clients, programs, and enrollments
- **Medical Records** - Comprehensive patient profiles with enrollment history
- **RESTful API** - Secure API endpoints for system integration

## System Requirements

- PHP 8.1+
- Composer
- SQLite (or other database of choice)
- Web server (Apache/Nginx)

## 🔧 Installation

### Clone the Repository

```bash
git clone https://github.com/yourusername/ehealth-management.git
cd ehealth-management
```

### Install Dependencies

```bash
composer install
cp .env.example .env
php artisan key:generate
```

### Database Setup

```bash
# For SQLite
touch database/database.sqlite

# Configure .env for SQLite
# DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database/database.sqlite

php artisan migrate --seed
```

### Start the Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

##  Admin Access

Default admin credentials:
- **Email:** admin@ehealth.com
- **Password:** password

Access the admin login at `/admin/login`

## Core Functionality

### 1. Program Management

The system allows healthcare administrators to create and manage health programs such as TB, Malaria, HIV, etc. Each program can have detailed information including:

- Program name and unique code
- Description and objectives
- Capacity limits and status
- Start and end dates

### 2. Client Registration

Comprehensive client registration with detailed information including:

- Personal details (name, DOB, gender)
- Contact information and address
- Identification numbers
- Emergency contacts
- Medical history notes

### 3. Program Enrollment

The system facilitates enrolling clients in one or multiple healthcare programs:

- Select client and program from available options
- Record enrollment date and status
- Add enrollment-specific notes
- Track enrollment history

### 4. Client Search

Advanced search functionality allowing healthcare workers to quickly find clients by:

- Name or ID number
- Gender
- Enrolled programs
- Multiple combined criteria

### 5. Client Profiles

Detailed client profiles showing comprehensive information:

- Personal and contact details
- Current and past program enrollments
- Enrollment dates and statuses
- Medical notes and history

### 6. API Integration

Secure RESTful API endpoints for integration with other healthcare systems:

- `GET /api/clients/{id}/info` - Get client information
- `GET /api/programs/{id}/info` - Get program information

##  Security Features

- Secure admin authentication system
- Password hashing and data encryption
- CSRF protection for all forms
- Input validation and sanitization
- Role-based access control

##  Testing

Run the automated tests with:

```bash
php artisan test
```

##  Technical Architecture

The eHealth Management System is built on a solid MVC architecture:

- **Models:** Client, Program, Enrollment, User
- **Controllers:** AdminController, ClientController, ProgramController, EnrollmentController
- **Views:** Blade templates with responsive design

### Database Schema

- **users:** Admin authentication
- **clients:** Client/patient information
- **programs:** Healthcare program details
- **enrollments:** Relationships between clients and programs

##  Innovations & Optimizations

1. **Healthcare-focused UI/UX** - Specially designed interface for medical professionals
2. **Dynamic Dashboard** - Real-time statistics and recent activities
3. **Smart Form Validation** - Immediate feedback during data entry
4. **SQLite Integration** - Lightweight database solution for portability
5. **Optimized Database Queries** - Eager loading for better performance

##  Data Security Considerations

- All routes protected behind authentication
- Input validation to prevent injection attacks
- Proper error handling to avoid information leakage
- Secure password policies and authentication flows

##  License

Free to anyone!

## 📬 Contact

For any questions or feedback, please reach out at steveopiyo12@gmail.com

---

© 2025 eHealth Management System. All rights reserved.
