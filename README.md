# Master Data Management System

## Features
- [x] User authentication and authorization
- [x] Create, read, update, and delete (CRUD) operations for master data entities
- [x] Data validation rules to ensure data integrity
- [ ] Filtering and sorting of master data records
- [ ] Export functionality for master data

## Setup Instructions

### Prerequisites
- PHP 8.4 or higher
- Composer
- MySQL or MariaDB
- Node.js and npm (for frontend dependencies)

### Run Application Locally

- Clone the repository
```bash
git clone https://github.com/nipunlakshank/mdm.git
cd mdm
```

- Install PHP dependencies
```bash
composer install
```

- Install Node.js dependencies
```bash
npm install
```

- Create a `.env` file from the `.env.example` file
```bash
cp .env.example .env
```

- Update the `.env` file with your database credentials
```env
DB_CONNECTION=mysql
DB_USERNAME=root
DB_PASSWORD=your_password
DB_DATABASE=mdm_db
```

- Generate the application key
```bash
php artisan key:generate
```

- Run the database migrations
```bash
php artisan migrate
```

- Seed the database with initial data
```bash
php artisan db:seed
```

- Start the local development server
```bash
composer dev
```

- If you are using Laravel Herd, you should link the project to the Herd environment
```bash
herd link
```

- Access the application in your web browser at `http://localhost:8000` or `http://project-directory-name.test` if using Herd.

