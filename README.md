
# Run Locally
## Requires system requirements of laravel v9

```bash
  git clone https://github.com/sejanH/laravel_coding_test.git
```

Go to the project directory

```bash
  cd laravel_coding_test
```

Install dependencies

```bash
  npm install
```

build css/js

```bash
  npm run build
```

modify .env to connect database
run the migrations and seeder to seed random names for Vaccine centers
```bash
php artisan migrate
```
```bash
php artisan db:seed --class=VaccineCenterSeeder
```