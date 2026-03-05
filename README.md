My first web development project. Created in order to learn and practice basic HTML, PHP, SQL and CSS, as well as their interaction with each other.
The project is a lightweight, web-based project designed to track account balances in real-time. The system has fully operational CRUD system.
It also implements an Access Control System: data visibility and CRUD operations are restricted to authenticated users only.

This repo contains the latest, stable 1.0 version of the project. Future versions and features were planned, but are put on hold due to other uni projects.


VISUAL DEMONSTRATION
--------------------

<img width="1492" height="939" alt="image" src="https://github.com/user-attachments/assets/eb9c9c2e-987e-4dcf-97e1-5fed9826a0a6" />


Figure 1: The Retro Dashboard. Shows the authenticated view with client list, real-time balance, and CRUD controls.


KEY FEATURES
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

   The list can be searched to only list data entries containing a specific character or string. The list can be ordered in any direction by clicking on the column titles in the header.

5. REAL-TIME AGGREGATION

   The dashboard displays some live statistics and charts (e.g., "Teljes Vagyon" / Total Assets) calculated dynamically via SQL queries from the underlying dataset.

6. DATA EXPORT / REPORTING

   One-click generation of structured .CSV files. This allows the financial data to be extracted from the web environment and opened directly in Microsoft Excel or other programs for further analysis or auditing.

DESIGN PHILOSOPHY (UI/UX)
-------------------------
The interface was <u>intentionally</u> designed with a retro, "Form follows Function" aesthetic. This kind of UI is very nostalgic to me, and I always preferred this type of clean UI as opposed to a chaos of visual effects. 

Nonetheless, in early development versions I had a modern-style UI version as well, so the user could switch between styles, but as the new functions kept changing the layout, I decided to remove it for now. This is something for a future version.



DATA STRUCTURE
----------------------------
The 1.0 version of the system utilizes a simple database with two, non-related tables.
The full DB creation code with test data is in this repo's SQL folder.

```
CREATE TABLE accounts (
  id int NOT NULL AUTO_INCREMENT,
  client_name varchar(100) DEFAULT NULL,
  balance double DEFAULT 0,
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
```

2.0 version is planned to have a more complex, relational database.

--------------
AUTHOR: Princzinger Krisztián

LICENSE: MIT

