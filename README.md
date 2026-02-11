```
SIMPLE BANKING / CLIENT MANAGER (PHP/MYSQL)
===========================================
VERSION:  1.0 (Single-table DB)
UI STYLE: RETRO / BRUTALIST
STATUS:   REFACTORING IN PROGRESS


!!! NOTICE TO REVIEWERS !!!
---------------------------
The core logic of this application is fully functional and tested. 
The source code is currently undergoing a strict REFACTORING PROCESS to 
migrate variable naming conventions from Hungarian to English standards.


DESCRIPTION
-----------
A lightweight, web-based financial ledger designed to 
track account balances in real-time. 

It implements a strict Access Control System: data visibility and CRUD 
operations are restricted to authenticated users only.

SYSTEM SPECIFICATIONS
---------------------
* LANGUAGE:  PHP (Native / Procedural)
* DATABASE:  MySQL (Relational)
* FRONTEND:  HTML5 / CSS3 (Custom Retro Styling)
* LOCALIZATION: Hungarian (Magyar)


VISUAL DEMONSTRATION
--------------------
```
<img width="1331" height="631" alt="image" src="https://github.com/user-attachments/assets/4d8db7fc-9db8-4516-938e-0377a9663150" />

```
FIGURE 1: The "Retro" Dashboard. Shows the authenticated Admin view with 
client list, real-time balance, and CRUD controls.


KEY CAPABILITIES
----------------
1. AUTHENTICATION & ACCESS CONTROL
   The system is protected by a Login/Registration gateway. 
   - Public View: Restricted (Redirects to Login).
   - Admin View: Full access to the dashboard and data modification.

2. CRUD OPERATIONS (Create, Read, Update, Delete)
   Authenticated users can:
   - CREATE: Add new partners/clients to the database.
   - READ: View the consolidated list of clients and balances.
   - UPDATE: Modify client details or balance corrections.
   - DELETE: Remove obsolete records from the registry.

3. REAL-TIME AGGREGATION
   The dashboard displays some live statistics and charts (e.g., "Teljes Vagyon" / Total Assets) 
   calculated dynamically via SQL queries from the underlying dataset.

4. DATA EXPORT / REPORTING
   One-click generation of structured .CSV files. This allows the financial 
   data to be extracted from the web environment and opened directly in 
   Microsoft Excel for further analysis or auditing.

DESIGN PHILOSOPHY (UI/UX)
-------------------------
The interface was intentionally designed with a "Form follows Function" 
industrial aesthetic.
* High-contrast visibility (Green/Gray palette).
* Block-style buttons with hard shadows.
* Immediate access to data without simplified abstraction layers.

DATA STRUCTURE (SQL SNIPPET)
----------------------------
The 1.0 version of the system utilizes a simple database, with two, non-related tables:

CREATE TABLE szamlakezeles (
  id int NOT NULL AUTO_INCREMENT,
  ugyfel varchar(100) DEFAULT NULL,
  egyenleg double DEFAULT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE users (
  id int NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password_hash varchar(255) NOT NULL,
  registration_date datetime DEFAULT current_timestamp(),
  PRIMARY KEY (id),
  UNIQUE KEY (username)
);



================================================================================
AUTHOR: Princzinger Krisztián
LICENSE: MIT
================================================================================
```
