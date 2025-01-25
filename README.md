# Library Management System

This is a **Library Management System** built using **Laravel**, a PHP framework. The system allows users to manage books, users, and borrowing/reservation processes. It includes features for admins to manage users, books, and penalties, while students can browse, borrow, reserve, and purchase books.

---

## Features

### Admin Features
- **User Management**: Admins can create, update, and delete users. They can also assign roles (e.g., Admin, Student) to users.
- **Book Management**: Admins can add, edit, and delete books. They can also manage book availability and upload PDFs and images for books.
- **Penalty Management**: Admins can assign penalties to students for overdue books and manage existing penalties.
- **Role-Based Access Control**: Admins have full access to the system, while students have limited access.

### Student Features
- **Browse Books**: Students can browse available books, view book details, and search for books by title, author, or category.
- **Borrow Books**: Students can borrow available books for a specified period.
- **Reserve Books**: Students can reserve books that are currently unavailable.
- **Purchase Books**: Students can purchase books if they are available for purchase.
- **View Borrowed/Reserved Books**: Students can view their borrowed and reserved books.

### General Features
- **Authentication**: Users can register, log in, and reset their passwords. The system supports role-based access control.
- **Responsive UI**: The system uses **Bootstrap** for a responsive and modern user interface.
- **PDF Viewer**: Students can read borrowed books using an integrated PDF viewer.
- **Penalty System**: Students with overdue books may receive penalties, restricting their ability to borrow or reserve books.

---

## Technologies Used

- **Backend**: Laravel (PHP Framework)
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **PDF Viewer**: PDF.js
- **File Uploads**: Handling of book PDFs and images
---

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-repo/library-management-system.git
   cd library-management-system
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Set Up Environment**:
   - Copy `.env.example` to `.env` and configure your database credentials:
     ```bash
     cp .env.example .env
     ```
   - Generate an application key:
     ```bash
     php artisan key:generate
     ```

4. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

5. **Seed the Database** (Optional):
   ```bash
   php artisan db:seed
   ```

6. **Start the Development Server**:
   ```bash
   php artisan serve
   ```

7. **Compile Assets**:
   ```bash
   npm run dev
   ```

---

## Usage

### Admin Access
- Admins can log in and access the dashboard to manage users, books, and penalties.
- Admins can create new users, assign roles, and manage user profiles.
- Admins can add, edit, and delete books, including uploading PDFs and images.

### Student Access
- Students can log in to browse books, borrow, reserve, or purchase books.
- Students can view their borrowed and reserved books.
- Students can read borrowed books using the integrated PDF viewer.

---

## Future Improvements
- **Email Notifications**: Send email notifications for overdue books or reserved books becoming available.
---

## License

This project is open-source and available under the **MIT License**. Feel free to modify and distribute it as per the license terms.

---

## Author

This project was developed as part of a programming exercise. Contributions and feedback are welcome!

---

## Screenshots

![users](https://github.com/user-attachments/assets/222db35a-bcfd-4c6d-8e89-c715549d5fcf)
![books](https://github.com/user-attachments/assets/83174b72-e02c-425c-a35b-fa77d78a64db)
![home](https://github.com/user-attachments/assets/43db3bb0-3851-4b9d-8028-563a9c1d3123)
![pdf viewer](https://github.com/user-attachments/assets/06343e32-e432-42fa-921d-c98312aee018)


---

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your changes.

---

## Acknowledgments

- **Laravel**: For providing a robust PHP framework.
- **Bootstrap**: For the responsive and modern UI components.
- **PDF.js**: For the integrated PDF viewer.
