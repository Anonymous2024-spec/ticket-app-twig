# Ticket Management System - Twig (PHP) Implementation

<div align="center">


A modern, full-featured ticket management web application built with Twig templating engine and PHP, featuring secure authentication, CRUD operations, and a beautiful responsive design.


</div>

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [Authentication](#authentication)
- [Design System](#design-system)
- [Accessibility](#accessibility)
- [Known Issues](#known-issues)
- [Contributing](#contributing)

---

## 🎯 Overview

This is the **Twig/PHP implementation** of a multi-framework ticket management system. The application provides a complete solution for managing support tickets with server-side rendering, focusing on user experience, security, and design consistency.

### Key Highlights

- ✅ **Full CRUD Operations** - Create, Read, Update, Delete tickets
- 🔐 **Secure Authentication** - Session-based auth with PHP sessions
- 🎨 **Modern Design** - Wavy hero sections, decorative circles, and card-based layouts
- 📱 **Fully Responsive** - Mobile-first design that adapts to all screen sizes
- ♿ **Accessible** - WCAG compliant with semantic HTML and ARIA labels
- ⚡ **Server-Side Validation** - Robust form validation with PHP
- 🎭 **Flash Messages** - Session-based success/error notifications
- 🏗️ **Template Inheritance** - DRY principle with Twig's block system
- 🔄 **No JavaScript Required** - Progressive enhancement approach

---

## ✨ Features

### 1. Landing Page
- Eye-catching hero section with SVG wavy background
- Decorative circular elements for visual appeal
- Clear call-to-action buttons (Login & Get Started)
- Feature showcase with card-style sections
- Responsive footer across all pages
- Centered layout with max-width of 1440px
- Server-side rendered for optimal SEO

### 2. Authentication System
- **Login Page** - Secure user login with server validation
- **Signup Page** - New user registration with PHP validation
- **Form Validation** - Server-side error checking and sanitization
- **Flash Messages** - Session-based success/error feedback
- **Session Management** - Secure PHP sessions with httpOnly cookies
- **Protected Routes** - Middleware-style authentication checks

### 3. Dashboard
- **Statistics Overview**
  - Total Tickets count
  - Open Tickets count
  - Resolved Tickets count
- Quick navigation to Ticket Management
- Prominent Logout functionality
- Welcome message with user context
- Real-time data from JSON storage

### 4. Ticket Management (CRUD)
- **Create Tickets** - Form with server-side validation
- **View Tickets** - Card-style display with status badges
- **Edit Tickets** - Update existing ticket details
- **Delete Tickets** - Remove with POST confirmation
- **Status Management** - Visual indicators (Open, In Progress, Closed)
- **Persistent Storage** - JSON file-based data storage
- **Flash Messages** - Feedback for all CRUD operations

---

## 🛠 Tech Stack

### Core Technologies
- **PHP** 8.x - Server-side scripting language
- **Twig** 3.x - Modern template engine for PHP
- **Composer** - Dependency management

### Backend Architecture
- **Procedural PHP** - Simple, straightforward approach
- **Session Management** - Native PHP sessions
- **JSON Storage** - File-based data persistence
- **Input Validation** - Server-side sanitization and validation

### Styling
- **Custom CSS** - Pure CSS without frameworks
- **Responsive Design** - Mobile-first approach
- **CSS Variables** - Consistent design tokens

### Development Tools
- **Composer** - Package management
- **PHP Built-in Server** - Development environment

---

## 📁 Project Structure

```
ticket-app-twig/
├── data/
│   └── tickets.json                 # JSON-based ticket storage
├── public/
│   ├── css/                         # Stylesheets
│   └── js/                          # Optional JavaScript
├── src/
│   ├── Auth.php                     # Authentication logic
│   └── TicketManager.php            # Ticket CRUD operations
├── templates/
│   ├── 404.html.twig                # 404 error page
│   ├── base.html.twig               # Base layout template
│   ├── dashboard.html.twig          # Dashboard page
│   ├── landing.html.twig            # Landing/Home page
│   ├── login.html.twig              # Login page
│   └── tickets.html.twig            # Ticket management page
├── vendor/                          # Composer dependencies
├── .gitignore
├── composer.json                    # Composer configuration
├── composer.lock                    # Locked dependencies
├── index.php                        # Application entry point & router
└── README.md                        # This file
```

### Architecture Overview

#### PHP Classes
- **`Auth.php`** - Handles authentication, session management, and user operations
- **`TicketManager.php`** - Manages all ticket CRUD operations and JSON persistence

#### Twig Templates

**Base Template**:
- **`base.html.twig`** - Master layout with blocks for content, navigation, and footer

**Page Templates**:
- **`landing.html.twig`** - Homepage extending base template
- **`login.html.twig`** - Authentication page with tab switching
- **`dashboard.html.twig`** - Statistics dashboard
- **`tickets.html.twig`** - Full ticket management interface
- **`404.html.twig`** - Custom error page

#### Twig Features Used
- **Template Inheritance** - `{% extends %}` and `{% block %}`
- **Variables** - `{{ variable }}`
- **Control Structures** - `{% if %}`, `{% for %}`
- **Filters** - `|date`, `|upper`, `|escape`
- **Functions** - Template functions for dynamic content
- **Includes** - Reusable template components

---

## 🚀 Getting Started

### Prerequisites

- **PHP** 8.0 or higher
- **Composer** 2.x or higher
- **Web Server** (Apache/Nginx) or PHP built-in server

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ticket-app-twig
   ```

2. **Install Composer dependencies**
   ```bash
   composer install
   ```

3. **Set up data directory permissions**
   ```bash
   chmod 755 data/
   chmod 644 data/tickets.json
   ```

4. **Start the PHP development server**
   ```bash
   php -S localhost:8000
   ```

5. **Open your browser**
   ```
   Navigate to: http://localhost:8000
   ```

### Apache Configuration

If using Apache, create a `.htaccess` file:

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

### Nginx Configuration

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

---

## 🔐 Authentication

### How It Works

The application uses **PHP native sessions** for secure, server-side authentication.

#### Session Management
- **Session Key**: `ticketapp_session`
- **Storage**: Server-side PHP sessions
- **Cookie Settings**: 
  - `httpOnly: true` - Prevents JavaScript access
  - `secure: true` (production) - HTTPS only
  - `sameSite: Strict` - CSRF protection

#### Test Credentials

For **Login**:
```
Email: test@example.com
Password: password123
```

Or **Sign Up** with any valid email/password combination.

#### Protected Routes

The following routes require authentication:
- `/dashboard` - Dashboard page
- `/tickets` - Ticket management page

**Unauthorized access** automatically redirects to `/login` with a flash message.

#### Logout Process

1. User clicks "Logout" button
2. Server destroys session
3. Clears session cookie
4. Redirects to landing page

---

## 🎨 Design System

### Layout Specifications

- **Max Width**: 1440px (centered on large screens)
- **Responsive Breakpoints**:
  - Mobile: < 768px
  - Tablet: 768px - 1024px
  - Desktop: > 1024px

### Visual Elements

#### Hero Section
- **Wavy Background**: Inline SVG with smooth bezier curves
- **Decorative Circles**: CSS positioned with gradient backgrounds
- **Call-to-Action**: Prominent buttons with hover states

#### Card Components
- **Box Shadow**: `0 2px 8px rgba(0,0,0,0.1)`
- **Border Radius**: 12px
- **Padding**: 24px
- **Hover Effect**: Transform and shadow elevation

### Color Palette

#### Status Colors
| Status | Color | Hex Code | Usage |
|--------|-------|----------|-------|
| Open | Green | `#10b981` | New tickets |
| In Progress | Amber | `#f59e0b` | Active tickets |
| Closed | Gray | `#6b7280` | Resolved tickets |

#### Primary Colors
- **Primary**: `#3b82f6` (Blue)
- **Success**: `#10b981` (Green)
- **Error**: `#ef4444` (Red)
- **Warning**: `#f59e0b` (Amber)

### Typography
- **Font Family**: System fonts stack
- **Headings**: 700 weight
- **Body**: 400 weight
- **Line Height**: 1.6

---

## 🎭 Twig Templates

### Template Inheritance

Twig uses template inheritance to maintain consistency across pages:

- **Base Template** - Contains common layout structure (header, navigation, footer)
- **Child Templates** - Extend base and override specific blocks
- **Block System** - Defines sections that can be overridden

### Common Template Features

- Dynamic content rendering
- Conditional displays based on user authentication
- Loop through tickets and display cards
- Flash message system for user feedback
- Form rendering with error handling
- Status-based styling for tickets

---

## 🗄️ Data Management

### JSON Storage

The application uses JSON file storage for simplicity:

- **Location**: `data/tickets.json`
- **Structure**: Contains tickets and user data
- **Operations**: Read/Write operations handled by PHP classes
- **Persistence**: Data persists across sessions

### Data Operations

- **Create**: Add new tickets to JSON file
- **Read**: Retrieve all or filtered tickets
- **Update**: Modify existing ticket data
- **Delete**: Remove tickets from storage

---

## ♿ Accessibility

### Compliance
- **WCAG 2.1 Level AA** compliant
- **Semantic HTML5** elements throughout
- **ARIA labels** on interactive elements
- **Keyboard navigation** fully supported
- **Server-side rendering** ensures content available without JavaScript

### Features
- **Focus Indicators**: Visible on all interactive elements
- **Alt Text**: All images have descriptive alt attributes
- **Color Contrast**: Minimum 4.5:1 ratio for text
- **Screen Reader**: Proper heading hierarchy
- **Form Labels**: All inputs properly associated with labels
- **Skip Links**: Jump to main content option
- **Landmark Regions**: Proper use of semantic HTML elements

### Keyboard Navigation
- `Tab` - Navigate forward through interactive elements
- `Shift + Tab` - Navigate backward
- `Enter` - Submit forms / Follow links
- `Esc` - Close modals (if applicable)

---

## 📊 Data Validation

### Server-Side Validation

All form inputs are validated on the server before processing:

#### Ticket Validation Rules
- **Title**: Required, minimum 3 characters, maximum 100 characters
- **Status**: Required, must be "open", "in_progress", or "closed"
- **Description**: Optional, maximum 500 characters
- **Priority**: Optional, must be "low", "medium", or "high"

#### Authentication Validation
- **Email**: Required, valid email format
- **Password**: Required, minimum 6 characters
- **Name**: Required for signup, minimum 2 characters

### Error Messages

User-friendly error messages are displayed:
- ❌ "Title is required"
- ❌ "Invalid status value. Must be: open, in_progress, or closed"
- ❌ "Your session has expired - please log in again"
- ❌ "Failed to load tickets. Please retry"
- ❌ "Email format is invalid"

---

## 🔒 Security Considerations

### Current Implementation
- Session tokens stored securely in server-side sessions
- Password hashing with PHP's built-in functions
- Input sanitization to prevent XSS attacks
- CSRF protection for form submissions
- httpOnly cookies to prevent JavaScript access
- Secure session configuration

### Production Recommendations
- Enable HTTPS only
- Implement rate limiting for login attempts
- Add CAPTCHA for repeated failed logins
- Use environment variables for sensitive configuration
- Implement proper database instead of JSON storage
- Add security headers (CSP, X-Frame-Options, etc.)
- Regular security audits and updates
- Implement proper logging system
- Add input validation whitelist approach

---

## ⚠️ Known Issues & Limitations

### Current Limitations
1. **JSON Storage** - Not suitable for production; should migrate to database
2. **No Concurrent Access Handling** - Race conditions possible with file operations
3. **Limited Scalability** - Single-server architecture
4. **No Transaction Support** - Atomic operations not guaranteed
5. **File Size Growth** - JSON file can become large with many tickets
6. **No Image Upload** - Ticket attachments not supported
7. **Limited Query Capabilities** - No advanced filtering on large datasets
8. **No Caching Layer** - Performance may degrade with many tickets

### Browser Compatibility
- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Internet Explorer 11 (with minimal JavaScript)

### Future Enhancements
- [ ] Migrate to MySQL/PostgreSQL database
- [ ] Implement proper ORM (Doctrine, Eloquent)
- [ ] Add Redis for session storage and caching
- [ ] Implement file upload functionality
- [ ] Add email notifications
- [ ] Create admin panel for user management
- [ ] Add ticket assignment to users
- [ ] Implement ticket comments/history
- [ ] Add advanced search and filtering
- [ ] Export tickets to CSV/PDF
- [ ] Implement REST API endpoints
- [ ] Add pagination for large datasets
- [ ] Implement proper logging system
- [ ] Add unit and integration tests
- [ ] Docker containerization
- [ ] CI/CD pipeline setup

---

## 🐛 Troubleshooting

### Common Issues

**Issue**: Permission denied on `data/tickets.json`
```bash
# Solution: Set correct permissions
chmod 755 data/
chmod 644 data/tickets.json
```

**Issue**: Composer dependencies not found
```bash
# Solution: Install dependencies
composer install
```

**Issue**: Sessions not working
```bash
# Solution: Check PHP session configuration
# Verify session.save_path is writable
php -i | grep session.save_path
```

**Issue**: Twig templates not loading
```bash
# Solution: Verify templates directory path
# Check file permissions on templates folder
chmod 755 templates/
```

**Issue**: 404 errors for all routes
```bash
# Solution: Check web server configuration
# Ensure mod_rewrite is enabled (Apache)
# Verify .htaccess file exists
```

**Issue**: JSON file corrupted
```bash
# Solution: Validate JSON syntax
# Reset file if necessary with valid JSON structure
```

---

## 📱 Responsive Design

### Mobile (< 768px)
- Single column layout
- Stacked form fields
- Full-width cards
- Touch-optimized buttons (minimum 44x44px)
- Collapsible navigation menu
- Simplified ticket display

### Tablet (768px - 1024px)
- Two-column grid for tickets
- Side-by-side form layouts
- Expanded navigation
- Optimized spacing and padding

### Desktop (> 1024px)
- Three-column grid for tickets
- Full navigation bar
- Maximum width constraint (1440px)
- Hover effects enabled
- Multi-column forms where appropriate

---

## 🧪 Testing

### Manual Testing Checklist

**Landing Page**:
- [ ] Hero section displays correctly
- [ ] Wavy background renders properly
- [ ] CTA buttons are clickable and functional
- [ ] Footer displays on all pages

**Authentication**:
- [ ] Login with valid credentials succeeds
- [ ] Login with invalid credentials shows error
- [ ] Signup creates new account successfully
- [ ] Session persists across page loads
- [ ] Logout clears session and redirects

**Dashboard**:
- [ ] Statistics display correct ticket counts
- [ ] Navigation links work properly
- [ ] Protected route redirects when not authenticated
- [ ] Welcome message shows user information

**Ticket Management**:
- [ ] Create form validates all required fields
- [ ] Created ticket appears in list immediately
- [ ] Edit form pre-fills with existing data
- [ ] Update saves changes correctly
- [ ] Delete removes ticket with proper confirmation
- [ ] Status badges display with correct colors
- [ ] Flash messages appear for all actions

**Responsive Design**:
- [ ] Mobile layout stacks properly
- [ ] Tablet uses appropriate grid layout
- [ ] Desktop respects max-width constraint
- [ ] Forms are usable on all screen sizes

**Accessibility**:
- [ ] Can navigate entire site with keyboard only
- [ ] Screen reader announces content correctly
- [ ] Focus indicators are visible
- [ ] All images have appropriate alt text
- [ ] Form labels are properly associated

---

## 📄 License

This project is part of a technical assessment and is for demonstration purposes only.

---

## 👥 Contributing

This is a showcase project for a technical assessment. For other framework implementations, please refer to their respective repositories:

- **React Implementation**: [Link to React repo]
- **Vue.js Implementation**: [Link to Vue repo]

---

## 🌟 Twig/PHP Advantages

### Why Twig for This Project?

1. **Server-Side Rendering** - SEO-friendly, content available immediately
2. **Template Inheritance** - DRY principle with block system
3. **Auto-Escaping** - Built-in XSS protection
4. **Clean Syntax** - Readable and maintainable templates
5. **No Build Step** - Simple deployment process
6. **Progressive Enhancement** - Works without JavaScript
7. **PHP Integration** - Seamless integration with PHP backend
8. **Mature Ecosystem** - Well-established and documented

---

## 📞 Support

For questions or issues with this Twig/PHP implementation, please:
1. Check the [Known Issues](#known-issues) section
2. Review the [Troubleshooting](#troubleshooting) guide
3. Consult the official [Twig documentation](https://twig.symfony.com/)
4. Contact the development team

### Useful Resources
- [Twig Documentation](https://twig.symfony.com/doc/)
- [PHP Manual](https://www.php.net/manual/en/)
- [Composer Documentation](https://getcomposer.org/doc/)
- [PHP The Right Way](https://phptherightway.com/)

---

<div align="center">

**Built with 💙 using Twig & PHP**

[Back to Top](#ticket-management-system---twig-php-implementation)

</div>