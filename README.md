
# Online Reservation System

A Laravel 11-based web application for managing service reservations with separate guards for users and administrators.

## Setup Instructions

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/online_reservation.git
   cd online_reservation
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install front-end assets**:
   ```bash
   npm install
   npm run dev
   ```

4. **Create `.env` and generate key**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your `.env` file** (set DB credentials and other environment variables).

6. **Run database migrations**:
   ```bash
   php artisan migrate
   ```

7. **Serve the application**:
   ```bash
   php artisan serve
   ```
7. **seed database**:
   ```bash
   php artisan db:seed 
   ```
---

##  Tool Choices & Design Decisions

- **Laravel 11**: latest ease of use, and ecosystem.
- **Laravel Breeze**: Lightweight for user authentication.
- **Two Auth Guards**: Separate guards for `user` and `admin` to ensure separate session for each.
- **Blade Templates**: For clean UI structure.
- **MySQL**: Preferred for  performance in relational database management system.
- **Vite**:  fast and modern frontend .

---

##  Known Limitations

- Admin dashboard is functional but minimal — no advanced analytics yet.
- Currently supports  one language (English).
- No email verification or password reset yet.
- still No tests implemented.

---
##  Goal of System

- the goal of this system is to book appointment with expert in the type of session like
consultation,repair,coaching,expert receive reservation if
has availability to book on this time and make them done if its done or reject them
##  Feature Suggestion
- I can add table to show what is the available time and not available
to help user to find the suitable time without try date every time.


--- 

##  License

This project is licensed under the Mohamed Ashraf github License.
