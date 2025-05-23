# ZenSpace - Your Personal Meditation Sanctuary

ZenSpace is a modern, calming meditation website where users can learn, practice, and track their meditation journey. Built with HTML, Tailwind CSS, JavaScript, and PHP, it provides a relaxing experience with clean, minimal design and soothing animations.

## Features

- 🧘‍♀️ **Guided Meditation Sessions**: Browse and filter meditations by duration (5, 10, 20 minutes)
- 📊 **Meditation Tracker**: Log and visualize your meditation progress
- 🔒 **User Authentication**: Create an account to save your meditation data
- 🌙 **Dark/Light Mode**: Toggle between themes for your preferred viewing experience
- 🎵 **Ambient Sounds**: Background music to enhance your meditation experience
- 🌬️ **Interactive Breathing Exercise**: Visual breathing guide with animation
- 📱 **Responsive Design**: Works on mobile, tablet, and desktop

## Setup Instructions

### Prerequisites

- PHP 7.4 or higher
- MySQL/MariaDB
- Web server (Apache/Nginx)
- XAMPP/WAMP/MAMP or similar for local development

### Installation

1. **Clone or download this repository** to your web server's document root (e.g., `htdocs` folder for XAMPP)

2. **Create the database**:
   - Open phpMyAdmin or your preferred MySQL client
   - Import the `setup_database.sql` file to create the database and tables

3. **Configure database connection**:
   - Open `includes/db.php`
   - Update the database credentials if needed:
     ```php
     $db_host = 'localhost';
     $db_user = 'root';    // Change if needed
     $db_pass = '';        // Change if needed
     $db_name = 'zenspace';
     ```

4. **Set up your web server**:
   - If using XAMPP: Start Apache and MySQL services
   - Navigate to `http://localhost/meditation` in your browser

### Demo Account

- Username: `demo`
- Password: `zenspace123`

## Website Structure

- **Home Page**: Welcome screen with feature overview
- **Meditation Page**: Access guided meditation sessions
- **Tracker Page**: Log and view your meditation progress
- **Blog Page**: Read articles about meditation techniques
- **Login/Register**: User authentication system
- **Profile Page**: Update your account details

## Technologies Used

- **Frontend**:
  - HTML5
  - Tailwind CSS
  - JavaScript
  - Chart.js (for visualization)

- **Backend**:
  - PHP
  - MySQL

## Customization

- **Theme Colors**: Edit the color variables in the Tailwind configuration
- **Meditation Sessions**: Add your own sessions by modifying the meditation.php file
- **Content**: Update text and images to match your branding

## License

This project is available for personal and commercial use.

## Support

For questions or support, please open an issue in the repository or contact the maintainer.
