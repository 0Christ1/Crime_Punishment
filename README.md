# Overview
Our database-driven website offers a platform that enables users to efficiently manage data with functionalities like retrieving, adding, updating, deleting, and sorting. It supports multiple users, allowing concurrent database manipulation without interference. At the application level, we ensure robust security by verifying user credentials, protecting sensitive information from general access, and implementing auto-logout after 15 minutes. Additionally, our approach includes encrypting sensitive data in the database and designing tables to store information in a general format, enhancing security by avoiding the storage of highly sensitive details.

# Intro Page


# Design Database
Below is an Entity-Relationship (E-R) diagram that features a set of normalized tables, which are described using Schema statements.
![ERD](/Assets/ERD.png)

# Instructions to run
-- The database is hosted locally within an XAMPP development environment, accessible via 'localhost' on the default port '3306'
-- First, launch the XAMPP Control Panel. Then navigate to “htdocs” folder in your XAMPP and create a new folder named “NYUPD”. 
-- Afterward, access phpMyAdmin and import the SQL file provided. Last, go to the web browser, and enter “http://localhost/nyupd/”. Therefore, you can deploy our app.

# Database security at the database level
In the database, we create a role column for the users table, which classifies users as “junior” or “senior” with juniors granted read-only access and seniors granted adding, updating, deleting and sorting. The security is established for end users by adding a role column to the users database that allows users to be categorized as "junior" or "senior" with varying levels of access. With this configuration, users' access to the application or system is restricted, with different permissions granted to junior and senior users within the database. It is a type of user-facing security mechanism known as role-based access control, or RBAC.


