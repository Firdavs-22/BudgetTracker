# BudgetTracker

Personal finance management system with smart budgeting and goal trackeing.

### Core Features

- **Transactions**
    - Add income/expenses with categories
    - Recurring transactions templates
    - CSV bulk import
- **Categories**
    - Customizable categories and subcategories
    - Category spending limits
- **Budgeting**
    - Monthly budget planning
    - Auto-budget suggestions (Fast Budgeting)
- **Goals**
    - Savings goals with progress tracking
    - Goal achievement badges
- **Reports**
    - Interactive charts (spending distribution, trends)
    - Custom date range filters

### Additional Features

- **Export Data**
    - PDF/CSV/Excel reports
    - Scheduled email reports
- **Notifications**
    - Budget limit alerts
    - Bill payment reminders
- **Multi-device Sync**
- **Dark/Light Theme**

## Technology Stack

- **Frontend**: Vue 3
- **Backend**: Laravel 12
- **Database**: PostgreSQL
- **SPA**: InertiaJS
- Graphs?
- Testing?

# Task List

[//]: # (33 tasks, 1 task precent: 3%)
![](https://geps.dev/progress/6)

### Backend

* [x] Setup project structure
* [ ] Authentication
    - [x] User registration/login
    - [ ] Password reset
    - [ ] Email verification
    - [ ] Social auth (Google)
* [ ] Models & Migrations
    - [ ] Transactions (+ relationships)
    - [ ] Categories (nested sets)
    - [ ] Budgets (monthly)
    - [ ] Goals
* [ ] Routes
    - [ ] Transactions CRUD
    - [ ] Budget calculations
    - [ ] Report generation
* [ ] Notifications and Alerts
    - [ ] Budget limit alerts
    - [ ] Bill reminders
    - [ ] Email/SMS integration
    - [ ] In-app notifications

### Frontend

* [ ] Core Pages
    - [ ] Dashboard (main stats)
    - [ ] Transactions List (with filters)
    - [ ] Budget Planner
    - [ ] Goals Progress
* [ ] Components
    - [ ] Interactive Pie/Line charts
    - [ ] Budget Category Cards
    - [ ] Notification Center
* [ ] Forms
    - [ ] Transaction Wizard (multi-step)
* [ ] Toasts/Alerts
    - [ ] Success/Error messages
    - [ ] Budget limit alerts

### Additional Features

* [ ] Export System
    - [ ] PDF Generator
    - [ ] CSV Export
    - [ ] Scheduled Exports
* [ ] Notifications
    - [ ] In-app notifications
    - [ ] Email/SMS integration
* [ ] Settings
    - [ ] Currency selector
    - [ ] Theme switcher


