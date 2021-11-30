# Interfaces Folder
Files in this folder have ***.interface.php*** as their extensions.

## Interfaces include:
 
 - **DatabaseInterface**: A contract that the database class must fulfil.
    - A database must have a connect method
    - A database must perform the following:
        - insert
        - query
        - delete
        - update
        - connect
        - close
 -  **`\w+TableInterface**": An interface that contains all the database table names of "/\w+/" class
 -  **`\w+ConstantsInterface**": An interface that contains all the constants of "/\w+/" class
 -  **`\w+DefaultsInterface**": An interface that contains all the default values of the fields of "/\w+/" class
