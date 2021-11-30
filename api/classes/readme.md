# classes folder
This folder contains all the classes  

Files in this folder have entensions **.class.php**

# classes
The below are the list of classes, their relationships, and privileges. All roles having v2 represents implementation  will be done in hali care version two
- **User**: Contains all the general properties of a User such as firstname, lastname, email, phone number, country, etc. It facilitates the Authentication process.
A user can:  
    1. register
    2. login
    3. edit profile
    4. 
- **DbManager**: This represents the database management class. Every connection to the database will be handled by this class. It implements the DatabaseInterface. The database can:
  - query a table
  - insert into a table
  - update a table
  - delete from a table
  - run raw SQL queries
  - connect to the database

- **Utility**: This represents the class that contains only static methods to be used by other classes and scripts. The methods in this class will evolve as general functionalities arise.

