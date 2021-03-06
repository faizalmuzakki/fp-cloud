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
3. `cp .env.example .env` + check the .env file for your own configuration
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan passport:install`

### Requirement Installation Deploy dengan docker
1. Install Docker
2. Install Docker Compose

### Installation deploy dengan docker
1. Clone dan jalankan command `sudo docker run --rm -v $(pwd):/app composer install` didalam folder fp-cloud
2. `sudo chown -R $USER:$USER` <- didalam folder fp-cloud dan `cp .env.example .env`
3. `sudo docker-compose up -d`
4. `sudo docker-compose exec app vim .env`
5. change .env to
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=fp-cloud
DB_USERNAME=root
DB_PASSWORD=estehmanis
6. `docker-compose exec app php artisan key:generate`
7. `docker-compose exec app php artisan config:cache`
8. `docker-compose exec app php artisan migrate`
9. `docker-compose exec app php artisan passport:install`
10. Terdapat 3 container dengan nama yaitu app,webserver,dan db saat menjalankan `sudo docker ps`
dan api file storage bisa diakses melalui ip address vm anda, karena docker berjalan di port 80 yaitu http lewat browser

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

### File Management
1. List All Files (/api/file) **GET**
   - Header
     - Authorization: "Bearer {insert token here}"

2. Upload File (/api/file) **POST**
   - Header
     - Authorization: "Bearer {insert token here}"

   - Body
     - (file) file

3. Download File (/api/file/download) **POST**
   - Header
     - Authorization: "Bearer {insert token here}"

   - Body
     - (string) filename

4. Update Filename (/api/file) **PUT**
   - Header
     - Authorization: "Bearer {insert token here}"

   - Body
     - (string) filename
     - (string) name_change_to


4. Delete File (/api/file) **DELETE**
   - Header
     - Authorization: "Bearer {insert token here}"

   - Body
     - (string) filename

### Upgrade Storage
1. List All Storage Types (/api/upgrade) **GET**
   - Header
     - Authorization: "Bearer {insert token here}"

2. Upgrade Storage (/api/upgrade) **PUT**
   - Header
     - Authorization: "Bearer {insert token here}"

   - Body
     - (int) upgrade_to [type_code from list]
