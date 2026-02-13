```
SIMPLE BANKING / CLIENT MANAGER (PHP/MYSQL)
===========================================
VERSION:  1.0
UI STYLE: RETRO / BRUTALIST
STATUS:   REFACTORING IN PROGRESS


!!! NOTICE TO REVIEWERS !!!
---------------------------
The core logic of this project is fully functional and tested. 
The source code is currently undergoing a REFACTORING PROCESS to 
migrate variable naming conventions from Hungarian to English standards.


DESCRIPTION
-----------
A lightweight, web-based project designed to 
track account balances in real-time. 

It implements a strict Access Control System: data visibility and CRUD 
operations are restricted to authenticated users only.

SYSTEM SPECIFICATIONS
---------------------
* LANGUAGE:  PHP
* DATABASE:  MySQL
* FRONTEND:  HTML5 / CSS3 (Custom Retro Styling)
* LOCALIZATION: Hungarian (Magyar)


VISUAL DEMONSTRATION
--------------------
```
<img width="1330" height="626" alt="image" src="https://github.com/user-attachments/assets/467df2e2-b0ad-46f1-9e99-5645a7e78695" />


```
FIGURE 1: The Retro Dashboard. Shows the authenticated view with 
client list, real-time balance, and CRUD controls.


KEY CAPABILITIES
----------------
1. AUTHENTICATION & ACCESS CONTROL
   The data is protected by a Login/Registration gateway. 
   - Public View: Restricted (Redirects to Login).
   - Logged in view: Full access to the dashboard and data modification.

2. CRUD OPERATIONS (Create, Read, Update, Delete)
   Authenticated users can:
   - CREATE: Add new clients to the database.
   - READ: View the list of clients and balances.
   - UPDATE: Modify client name or balance.
   - DELETE: Remove obsolete records from the registry.

4. SEARCH AND ORDERING FUNCTION
   The list can be searched to only list data entries containing a specific character or string.
   The list can be ordered in any direction by clicking on the column titles in the header.

5. REAL-TIME AGGREGATION
   The dashboard displays some live statistics and charts (e.g., "Teljes Vagyon" / Total Assets) 
   calculated dynamically via SQL queries from the underlying dataset.

6. DATA EXPORT / REPORTING
   One-click generation of structured .CSV files. This allows the financial 
   data to be extracted from the web environment and opened directly in 
   Microsoft Excel or other programs for further analysis or auditing.

DESIGN PHILOSOPHY (UI/UX)
-------------------------
The interface was intentionally designed with a "Form follows Function" 
industrial aesthetic.
* High-contrast visibility (Green/Gray palette).
* Block-style buttons with hard shadows.
* Immediate access to data without simplified abstraction layers.

DATA STRUCTURE
----------------------------
The 1.0 version of the system utilizes a simple database with two, non-related tables:

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

2.0 version is planned to have a more complex, relational database.

================================================================================
AUTHOR: Princzinger Krisztián
LICENSE: MIT
================================================================================
```
