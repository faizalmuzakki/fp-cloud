# Final Project Cloud Computing
### 3rd group
### Group Member
1. Ubut Eka Putra **05111640000008**
2. Hafid Sriwijaya Bahrun **05111640000030**
3. Faizal Khilmi Muzakki **05111640000120**
4. Akmal Darari Rafif Baskoro **05111640000148**
5. Abyan Dzaka’ **05111640007003**

### Installation
1. Clone this project
2. `composer install`
3. `php artisan key:generate`
4. `php artisan migrate`
5. `php artisan passport:install`

## API Documentation
- Header
  - Content-Type: application/json
  - X-Requested-With: XMLHttpRequest

### Auth
1. Sign Up (/api/auth/signup) **POST**
   - Body
     - (string) name
     - (string) email
     - (string) password
     - (string) password_confirmation

2. Login (/api/auth/login) **POST**
   - Body
     - (string) email
     - (string) password
     - (bool) remember_me

3. Logout (/api/auth/logout) **GET**
   - Header
     - Authorization: "Bearer {insert token here}"

4. Get User LoggedIn Data (/api/auth/user) **GET**
   - Header
     - Authorization: "Bearer {insert token here}"