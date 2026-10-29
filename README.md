# 🌱 EcoVerse — Sustainability Engagement Platform

EcoVerse is a web-based sustainability platform designed to encourage users to participate in environmentally friendly activities through green points, sustainability challenges, rewards, and achievements. It aims to make sustainable living more engaging by allowing users to track their participation and progress.

## ✨ Features

### 👨‍💼 Sustainability Program Manager
- **Dashboard:** View sustainability statistics and program information.
- **Community Member Management:** Manage community member information and account status.
- **Challenge Management:** Create and manage sustainability challenges.
- **Green Reward Management:** Add, edit, and manage rewards that users can redeem with green points.
- **Achievement Badge Management:** Manage achievement badges and their requirements.
- **Leaderboard:** View user rankings based on sustainability participation or points.
- **Sustainability Intelligence Hub:** Review challenge performance and sustainability statistics.
- **Point Management:** Manage point-related settings and allocations.

### 👤 Participant
- View personal dashboard and sustainability progress.
- Explore and participate in sustainability challenges.
- Track green points earned through activities.
- Browse available rewards.
- View achievements and leaderboard rankings.
- Manage personal profile information.

### 🔐 Authentication and Access Control
- Login and session management.
- Role-based access to different parts of the platform.
- PHP and MySQL integration for handling application data.

## 🛠️ Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Development Environment:** Visual Studio Code, XAMPP
- **Version Control:** Git and GitHub

## 🚀 Getting Started

Follow these steps to run EcoVerse on your local computer.

### Prerequisites

Install the following software:

- [XAMPP](https://www.apachefriends.org/)
- [Visual Studio Code](https://code.visualstudio.com/)
- A web browser
- Git (optional, for cloning the repository)

### Installation

**1. Clone the repository**

Open your terminal and run:

```bash
git clone <YOUR_GITHUB_REPOSITORY_URL>
```

Replace `<YOUR_GITHUB_REPOSITORY_URL>` with your repository's actual URL.

Alternatively, download the repository as a ZIP file from GitHub.

**2. Move the project into XAMPP**

Place the EcoVerse project folder inside XAMPP's `htdocs` directory.

Example:

```text
C:\xampp\htdocs\EcoVerse\
```

**3. Start Apache and MySQL**

Open the XAMPP Control Panel and start:
- Apache
- MySQL

**4. Set up the database**

1. Open [phpMyAdmin](http://localhost/phpmyadmin/).
2. Create a database named `ecoverse`.
3. Import the project's SQL database file, if one is included in the repository.
4. Make sure the required tables and relationships are created correctly.

**5. Configure the database connection**

Open the database connection file, for example:

```text
includes/db_connect.php
```

Configure the connection details to match your local MySQL setup:

```php
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ecoverse";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
```

Adjust the database name, username, and password if your local configuration differs.

**6. Run EcoVerse**

Open your browser and visit:

```text
http://localhost/EcoVerse/
```

If your project folder has a different name, replace `EcoVerse` with that folder name.

## 📁 Project Structure

The following is an example structure. Your actual folders and filenames may differ.

```text
EcoVerse/
├── includes/
│   └── db_connect.php
├── css/
├── images/
├── ProgramManager/
├── Participant/
├── GreenReviewer/
├── index.php
└── README.md
```

## 🗄️ Database

EcoVerse uses MySQL to store application information, including user accounts, sustainability challenges, activity records, green points, rewards, and achievements.

The database must be imported or created before the application can work correctly.

## 🔒 Security Notes

- Do not commit real passwords, API keys, or other secrets to GitHub.
- Configure your database credentials locally.
- Use prepared SQL statements when handling user input.
- Use appropriate session and role checks to protect restricted pages.

## 🎯 Project Objective

The objective of EcoVerse is to promote environmental awareness and sustainable participation through an interactive platform that combines challenges, green points, rewards, achievements, and progress tracking.
