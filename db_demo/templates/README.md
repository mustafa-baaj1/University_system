# University Management System - HTML/CSS Template

A complete, modern HTML/CSS template for managing a university database system. This template is framework-free and ready to be integrated with your backend API.

## 📁 File Structure

```
templates/
├── index.html              # Dashboard page
├── styles.css              # Main stylesheet
├── students.html           # Student management
├── departments.html        # Department management
├── programs.html           # Program management
├── courses.html            # Course management
├── sections.html           # Section management
├── semesters.html          # Semester management
├── classrooms.html         # Classroom management
├── instructors.html        # Instructor management
├── offices.html            # Office management
├── enrollments.html        # Enrollment management
├── assignments.html        # Assignment management
├── submissions.html        # Submission management
└── teacher-assignments.html # Teacher assignment management
```

## 🎨 Features

- **Modern Design**: Clean, professional interface with a modern color scheme
- **Responsive Layout**: Works on desktop, tablet, and mobile devices
- **Sidebar Navigation**: Easy navigation between all sections
- **Modal Forms**: Add/Edit forms in modal dialogs
- **Data Tables**: Clean, sortable tables for displaying data
- **Search & Filter**: Search boxes and filter dropdowns
- **Status Badges**: Visual indicators for status fields
- **No Dependencies**: Pure HTML/CSS/JavaScript - no frameworks required

## 🚀 Usage

1. **Open the template**: Simply open `index.html` in your browser
2. **Navigate**: Use the sidebar to navigate between different sections
3. **Add Records**: Click the "+ Add" button to open the modal form
4. **Edit/Delete**: Use the action buttons in each table row

## 🔌 Backend Integration

To connect this template to your Laravel backend:

1. **Update Form Actions**: Change form `action` attributes to point to your API endpoints
2. **Add JavaScript**: Implement AJAX calls to fetch and submit data
3. **Dynamic Content**: Replace static table data with data from your API
4. **Authentication**: Add login/logout functionality as needed

### Example API Integration:

```javascript
// Fetch students
fetch('/api/students')
    .then(response => response.json())
    .then(data => {
        // Populate table with data
    });

// Submit form
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('/api/students', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Handle response
    });
});
```

## 🎨 Customization

### Colors

Edit CSS variables in `styles.css`:

```css
:root {
    --primary-color: #4f46e5;
    --secondary-color: #10b981;
    --danger-color: #ef4444;
    /* ... more colors */
}
```

### Styling

All styles are in `styles.css`. Key sections:
- `.sidebar` - Sidebar navigation
- `.main-content` - Main content area
- `.data-table` - Table styling
- `.modal` - Modal dialogs
- `.form-group` - Form elements

## 📋 Database Schema Reference

This template supports the following entities:

- **Departments** (with hierarchical parent-child relationships)
- **Programs** (belongs to Department)
- **Courses** (belongs to Program)
- **Sections** (belongs to Course, Classroom, Semester)
- **Semesters** (start_date, end_date)
- **Classrooms** (building, room_number)
- **Students** (belongs to Program)
- **Instructors** (belongs to Department)
- **Offices** (belongs to Instructor)
- **Enrollments** (Student + Section, with status)
- **Assignments** (belongs to Section)
- **Submissions** (Student + Assignment, with grading)
- **Teacher Assignments** (Instructor + Section)

## 🔧 Form Fields Reference

### Students
- name, email, phone, address, program_id

### Departments
- name, parent_id (nullable)

### Programs
- name, type, department_id

### Courses
- name, code, description, program_id

### Sections
- name, code, course_id, classroom_id, semester_id

### Semesters
- name, start_date, end_date

### Classrooms
- building, room_number

### Instructors
- name, email, phone, address, department_id

### Offices
- building, room_number, instructor_id

### Enrollments
- student_id, section_id, status

### Assignments
- section_id, title, description, due_date, max_score

### Submissions
- assignment_id, student_id, file, submitted_at, status, score, feedback_comment

### Teacher Assignments
- section_id, instructor_id

## 📱 Responsive Breakpoints

- Desktop: Default (full sidebar)
- Tablet: 768px and below (collapsible sidebar)
- Mobile: Optimized for small screens

## 🎯 Next Steps

1. Connect forms to your Laravel API endpoints
2. Implement data fetching with JavaScript
3. Add form validation
4. Add loading states and error handling
5. Implement authentication if needed
6. Add pagination for large datasets
7. Add export functionality (CSV, PDF)

## 📝 Notes

- All forms use semantic HTML5 form elements
- Modals can be opened/closed with JavaScript
- Tables are ready for sorting and filtering (add your own logic)
- All pages share the same sidebar navigation
- CSS uses modern features (CSS Grid, Flexbox, CSS Variables)

## 🤝 Support

This is a template - customize it to fit your needs. All code is well-commented and easy to modify.


