# Project Management System

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [API Endpoints](#api-endpoints)
- [Usage](#usage)
- [Authentication](#authentication)
- [Filtering](#filtering)
- [Dynamic Attributes (EAV)](#dynamic-attributes-eav)
- [Example Requests](#example-requests)
- [License](#license)

## Introduction
This project is a Project Management System built with Laravel, providing core functionality for managing users, projects, and timesheets. It also includes a dynamic attribute system for projects using the Entity-Attribute-Value (EAV) model.

## Features
- User management with authentication using Laravel Passport
- Project management with dynamic attributes
- Timesheet management linked to users and projects
- API endpoints for CRUD operations
- Flexible filtering system for projects and timesheets

## Requirements
- PHP >= 7.4
- Composer
- MySQL
- Laravel

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/project-management-system.git
   cd project-management-system
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

## Database Setup
1. Create a MySQL database and update the `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

2. Run the migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

3. Install Laravel Passport:
   ```bash
   php artisan passport:install
   ```

## API Endpoints
### Auth Endpoints
- `POST /api/register` - Register a new user
- `POST /api/login` - Login a user
- `POST /api/logout` - Logout a user (requires authentication)

### User Endpoints
- `GET /api/users` - List all users
- `GET /api/users/{id}` - Get a specific user
- `POST /api/users` - Create a new user
- `PUT /api/users/{id}` - Update a user
- `DELETE /api/users/{id}` - Delete a user

### Project Endpoints
- `GET /api/projects` - List all projects
- `GET /api/projects/{id}` - Get a specific project
- `POST /api/projects` - Create a new project
- `PUT /api/projects/{id}` - Update a project
- `DELETE /api/projects/{id}` - Delete a project

### Timesheet Endpoints
- `GET /api/timesheets` - List all timesheets
- `GET /api/timesheets/{id}` - Get a specific timesheet
- `POST /api/timesheets` - Create a new timesheet
- `PUT /api/timesheets/{id}` - Update a timesheet
- `DELETE /api/timesheets/{id}` - Delete a timesheet

### Attribute Endpoints
- `GET /api/attributes` - List all attributes
- `GET /api/attributes/{id}` - Get a specific attribute
- `POST /api/attributes` - Create a new attribute
- `PUT /api/attributes/{id}` - Update an attribute
- `DELETE /api/attributes/{id}` - Delete an attribute

### AttributeValue Endpoints
- `GET /api/attribute-values` - List all attribute values
- `GET /api/attribute-values/{id}` - Get a specific attribute value
- `POST /api/attribute-values` - Create a new attribute value
- `PUT /api/attribute-values/{id}` - Update an attribute value
- `DELETE /api/attribute-values/{id}` - Delete an attribute value

## Usage
To start the development server, run:
```bash
php artisan serve
```

## Authentication
Authentication is handled using Laravel Passport. To access protected routes, include the `Authorization: Bearer {token}` header in your requests.

## Filtering
You can filter projects and timesheets using query parameters. For example:
```http
GET /api/projects?filters[name]=ProjectA&filters[department]=IT
```

## Dynamic Attributes (EAV)
Projects can have dynamic attributes. You can create and update attributes and their values using the respective API endpoints.

## Example Requests
### Create a Project with Dynamic Attributes
```http
POST /api/projects
Content-Type: application/json
Authorization: Bearer {token}

{
  "name": "New Project Name",
  "status": "active",
  "attributes": {
    "1": "Department B",
    "2": "2024-02-15",
    "3": "2024-10-20"
  }
}
```

### Update a Project with Dynamic Attributes
```http
PATCH /api/projects/{id}
Content-Type: application/json
Authorization: Bearer {token}

{
  "name": "Updated Project Name",
  "status": "completed",
  "attributes": {
    "1": "New Department Name",
    "2": "2025-01-01",
    "3": "2025-12-31"
  }
}
```

### List Timesheets with Filters
```http
GET /api/timesheets?filters[user_id]=1&filters[project_id]=2&filters[date]=2025-02-11
Authorization: Bearer {token}
```

## Postman JSON
Postman JSON file is in storage/app/private/postman/2025_02_10_220452_laravel_collection.json. 

## License
This project is open-source and available under the [MIT License](LICENSE).