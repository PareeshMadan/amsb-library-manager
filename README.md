# Library Management System

A comprehensive CRUD application built with CodeIgniter 4 for managing library books, featuring book cover image uploads and a responsive Bootstrap interface.

## Features

### Core Functionality
- ✅ **Create Book Records**: Add new books with title, author, genre, publication year, and optional cover image
- ✅ **Read/View Book Records**: Browse all books in a table format with cover images
- ✅ **Update Book Records**: Edit existing book information with pre-filled forms
- ✅ **Delete Book Records**: Remove books with confirmation dialog
- ✅ **Form Validation**: Required field validation with user-friendly error messages
- ✅ **Image Upload**: Upload and manage book cover images with automatic resizing and file management

### Additional Features
- 📱 **Responsive Design**: Mobile-friendly Bootstrap 5 interface
- 🖼️ **Image Management**: Automatic file handling, cleanup on delete/update
- 🎨 **Visual Appeal**: Default placeholder images for books without covers
- 📊 **Book Details View**: Dedicated page for viewing complete book information
- 🔍 **User Experience**: Intuitive navigation and confirmation dialogs

## Technology Stack

- **Backend**: CodeIgniter 4.6.2 (PHP Framework)
- **Database**: MySQL 8.0
- **Frontend**: Bootstrap 5.1.3, Font Awesome 6.0
- **Environment**: Docker & Docker Compose
- **Web Server**: Apache 2.4
- **PHP Version**: 8.1

## Setup Instructions

### Prerequisites

Ensure you have the following installed on your local machine:
- **Docker Desktop** (latest version)
- **Git** (for version control)

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/PareeshMadan/amsb-library-manager.git
   cd amsb-library-manager
   ```

2. **Start the Application**
   ```bash
   docker-compose up -d
   ```
   This command will:
   - Build the PHP/Apache container with all required extensions
   - Start the MySQL database container
   - Set up networking between containers

3. **Install Dependencies**
   ```bash
   docker exec amsb-library-manager-web-1 php composer-setup.php
   docker exec amsb-library-manager-web-1 php composer.phar install
   ```

4. **Configure Environment**
   ```bash
   docker exec amsb-library-manager-web-1 cp env .env
   ```
   Then add database configuration to `.env`:
   ```bash
   docker exec amsb-library-manager-web-1 bash -c "cat >> .env << 'EOF'

# Database Configuration for Docker
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080'

database.default.hostname = db
database.default.database = library_db
database.default.username = user
database.default.password = pass
database.default.DBDriver = MySQLi
database.default.port = 3306
EOF"
   ```

5. **Run Database Migrations**
   ```bash
   docker exec amsb-library-manager-web-1 php spark migrate
   ```

6. **Seed Sample Data** (optional)
   ```bash
   docker exec amsb-library-manager-web-1 php spark db:seed Books
   ```

7. **Access the Application**
   - Open your web browser and navigate to: [http://localhost:8080](http://localhost:8080)
   - You should see the Library Management System with sample books

### Environment Configuration

The application requires manual configuration of the `.env` file with the following settings:

- **Database Host**: `db` (Docker container name)
- **Database Name**: `library_db`
- **Database User**: `user`
- **Database Password**: `pass`
- **Application URL**: `http://localhost:8080`

These settings are defined in:
- `.env` file (application configuration - **must be manually configured as shown in step 4**)
- `docker-compose.yml` (container configuration)

## Usage Guide

### Adding a New Book

1. Click the "Add New Book" button from the main page or navigation
2. Fill in the required fields:
   - **Title** (required)
   - **Author** (required)
   - **Publication Year** (required, must be between 1000 and current year)
3. Optionally fill in:
   - **Genre**
   - **Book Cover Image** (JPG, PNG, GIF up to 2MB)
4. Click "Save Book"

### Viewing Books

- **List View**: Main page shows all books in a table with cover images
- **Detail View**: Click the eye icon to view complete book information
- Books without cover images display a default placeholder

### Editing a Book

1. Click the edit icon (pencil) for any book
2. Modify any fields as needed
3. Upload a new cover image if desired (replaces the old one)
4. Click "Update Book"

### Deleting a Book

1. Click the delete icon (trash) for any book
2. Confirm the deletion in the popup dialog
3. The book and its associated image file will be permanently removed

## Development Decisions & Design Choices

### Architecture Decisions

1. **MVC Pattern**: Used CodeIgniter's built-in MVC structure for clean separation of concerns
2. **RESTful Routes**: Implemented semantic URLs following REST conventions
3. **Single Responsibility**: Each controller method handles one specific action

### Database Design

1. **Simple Schema**: Books table with essential fields plus image path storage
2. **Timestamps**: Automatic created_at and updated_at tracking
3. **Nullable Fields**: Genre and image_path are optional for flexibility

### User Experience Decisions

1. **Bootstrap Framework**: Chose Bootstrap 5 for responsive, professional appearance
2. **Confirmation Dialogs**: Added JavaScript confirmations for delete operations
3. **Image Previews**: Real-time preview when uploading images
4. **Default Placeholders**: Elegant fallback for books without cover images

### File Management Strategy

1. **Local Storage**: Images stored in `public/uploads/books/` directory
2. **Unique Filenames**: Random names prevent conflicts and security issues
3. **Cleanup Process**: Automatic deletion of old images when updating/deleting books
4. **File Validation**: Strict validation for image types and sizes

### Security Considerations

1. **Input Validation**: Server-side validation for all form inputs
2. **File Upload Security**: Restricted file types and size limits
3. **SQL Injection Prevention**: Used CodeIgniter's Query Builder and model methods
4. **XSS Protection**: Applied `esc()` function to all user-generated content

### Performance Optimizations

1. **Efficient Queries**: Direct model methods without unnecessary joins
2. **Image Sizing**: CSS-based responsive images rather than server-side resizing
3. **Minimal Dependencies**: Only essential libraries included

## License

This project is open source and available under the [MIT License](LICENSE).

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
