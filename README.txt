- Database is imported in DatabaseConfiguration.sql file, just need to import this file and it will 
  create the database and create tables and add data into them automatically.
- Database connectivity is implemented through Database.php file. 'Database' class handles the 
  responsibility to create connection to database.
- The class UserDB is inherited from Database class. It handles all types of database operations of
  two tables. That are: 'users' and 'user_profile'.
- User login, registration, logout and update profile functionality is added.

