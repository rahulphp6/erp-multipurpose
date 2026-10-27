<div align="center">
  <h1>🏢 ERP-Multipurpose - Dynamic CRM & ERP Generator Engine</h1>
  <p><b>A powerful Core PHP MVC-based dynamic engine that allows you to instantly spin up custom CRM/ERP modules (Sales, Finance, Reports, Property, Medical, etc.) with zero repetitive boilerplate code.</b></p>

  <p>
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
    <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" />
    <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" />
    <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" />
    <img src="https://img.shields.io/badge/Laragon-1E1E1E?style=for-the-badge&logo=laragon&logoColor=white" />
  </p>
</div>

---

## 📌 What Is ERP-Multipurpose? (यह प्रोजेक्ट क्या है?)
**ERP-Multipurpose** is a modular, pre-built MVC framework designed for developers and businesses who need to build multiple CRM verticals rapidly. Whether it's **Sales Tracking, Financial Accounts, Real-time Reports, Property Management, or Medical Records**, you don't need to write custom backend logic for every new module. 

The system automatically manages all standard actions: **Add, Edit, Delete, Bulk Operations, AJAX Table Filtration, and Pagination.**

---

## 🚀 How to Create a New Module in 3 Simple Steps (नया पेज/मॉड्यूल कैसे बनाएं?)

Creating a brand new CRM page/module takes less than a minute:

1. **Duplicate the Notes Page:**
   - Go to the `pages/` directory.
   - Copy an existing template (e.g., `notes` folder) and rename it to your target module (e.g., `xyz`).
2. **Configure Database & Columns:**
   - Pass your database table name (matching the page/folder name, e.g., `xyz`) inside the configuration.
   - Manually define your table columns and map them. The core engine will automatically handle all CRUD actions (Add, Edit, Delete) without writing manual handlers!
3. **Manage Form Fields:**
   - Head over to `pages/form/xyz/` to manage, add, or customize your form input fields.
4. **Launch & View:**
   - Open your browser and navigate to:
     ```text
     http://your-domain/admin.php?page=xyz
     ```
   - Your fully functional, secure CRM page with live tables, search, and automatic action handlers is instantly ready!

---

## ⚙️ Core Architecture & Features
- **Zero Boilerplate CRUD:** No need to write manual Insert, Update, or Delete queries for new entities.
- **Dynamic Form Handling:** Centralized form field management under the `pages/form/` directory.
- **Single-View & AJAX Tables:** Smooth, asynchronous data rendering, searching, and filtering.
- **Modular MVC Design:** Clean separation of concerns powered by Core PHP and MySQL.

---

## 🛠️ Local Installation & Setup
1. **Clone the repository:**
   ```bash
   git clone [https://github.com/rahulphp6/erp-multipurpose.git](https://github.com/rahulphp6/erp-multipurpose.git)
   cd erp-multipurpose