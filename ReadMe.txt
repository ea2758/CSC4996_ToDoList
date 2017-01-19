Application: To Do List
Version: 1.011
Developer: Daniel Warrick
ID: ea2758
Course: CSC4996

::Instructions::

1. Download/Install Wampserver64
2. Open browser
3. enter:
	http://localhost/phpmyadmin/
4. Click the SQL tab (between Databases and Status)
5. Copy and paste the following code; press GO

CREATE DATABASE todolist;
USE todolist;
CREATE TABLE uncompleted_tasks (task_number int(11) not null 
auto_increment primary key,uncompleted_task varchar(50)); 
CREATE TABLE completed_tasks (task_number int(11) not null 
auto_increment primary key,completed_task varchar(50)); 

6. Open ToDoList.php
7. Change the path at line 6 to this folder's current location
8. Return to browser, enter: 
	http://localhost/todolist/ToDoList.php
9. The application should be all set!
