# PHP-REST_API

This PHP program represents a simple REST API for a Blog. It allows you to perform CRUD operations on blog entries.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Project Structure](#project-structure)
- [API Endpoints](#api-endpoints)
- [Database Schema](#database-schema)

## Getting Started

### Prerequisites

Make sure you have PHP and a MySQL database server installed on your machine.

### Installation

1. Clone the repository:

   ```bash
   git clone <repository-url>

2. Import the database schema and data from database.sql into your MySQL database.

3. Update the database connection details in the Database class constructor within Database.php.

4. Configure your web server to use the provided .htaccess file for URL rewriting.

## Project Structure

- index.php: 
    Main entry point for the REST API. Handles autoloading, error handling, and routing.

- ErrorHandler.php: 
    Class for handling exceptions and errors.

- BlogController.php: 
    Controller class for processing blog-related requests.

- BlogGateway.php: 
    Gateway class for interacting with the database for blog entries.

- Database.php: 
    Class for establishing a database connection.

- .htaccess: 
    Configuration for URL rewriting.

- database.sql: 
    SQL file containing the database schema and sample data.

## API Endpoints

- Get all blogs: 
    GET /blog

- Get a specific blog:
    GET /blog/{id}

- Create a new blog:
    POST /blog

- Update a blog:
    PATCH /blog/{id}

- Delete a blog :
    DELETE /blog/{id}

## Database Schema

The database consists of a single table blog with the following structure:

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `header` varchar(128) NOT NULL,
  `contex` varchar(256) NOT NULL,
  `author` varchar(30) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
