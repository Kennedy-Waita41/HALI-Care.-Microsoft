# api
This is the root directory of the Hali Care API

# whats in here?
1. **master.inc.php**: 
2. **auth.inc.php**

## Hali Command line tool
 The hali command line tool helps in creating different files following the convention and the directory structure of the Hali app.

 **These are the commands**  
 1. ***`php hali -help`***  
  This command lists the different commands available to you. 
 2. ***`php hali make:class ClassName`***  
This command tells hali to make a class if it doesn't exist with the specified class name and put the boilerplate code in it. The class will be created in the **logic/classes** folder with the extension ***.class.php***. There are various options for this command.
3. ***`php hali make:class ClassName [options]`***  
This command does what the above command do but with additional boilerplate code and actions.  

-  ***`[options]`*** : 
    -   ***`-p parentClassName`***: This creates the parent class of the class and adds *`extends ParentClassName`* to the code in the new class folder. If multiple classnames follow `-p`, only the first is consider as the parent class. If the parentClass exist, only the *`extends ParentClassName`* will be added to the boilerplate code.
    - ***`-i interfaceName1 interfaceName2 ...`*** : creates interfaces if they do not exist and adds the boilerplate code, `implements InterfaceName1, InterfaceName2, ...`, to the created class code. the interface names should not contain the word interface, it will be removed when creating the interface file.   
    For example, `php hali make:class NewClass -p NewClassParent NewClassParent2 -i NewClass NewClass2Interface NewClass3Interface ...Interface` will result in interfaces NewClass2 and NewClass3 and ..., observe that the interface name is removed.

    - ***`-t traitName1 traitName2 traitName3`*** : creates traites if they do not exist and adds the boilerplate code, `use traitName1, traitName2, ...;` in the created class. for example `php hali make:class newClass -p parentClass -i interfaceName -t traitName traitName2 ...` will result in a class that uses all the traits mentioned. Just like interface, no trait will be found in the name of the created traits. Please note that the `-p` means parent, `-i` means interface and `-t` means trait and can be written in any order. The trait is created in the `logic/trait` directory.  

    - ***`--private`*** : makes constructor of the created class private. 

    - ***`--re`***: this tells hali that the created class represents a real entity. Hence its response trait, defaults interface, constants interface, and table interface will be created. Its response trait will also be added to the Respond class.

    - ***`--md`***: tells hali to create a directory in the logic folder with the name of the class.
    **note: These options can be written in any order**

4.  ***`make:logic [camel case fileName] [-d directoryName] [-na]`***: - makes a logic file. 
        The `-na` is optional and tells hali not to include authentication (na) file (auth.inc.php) at the top of the created logic script.
        The `-d directoryName` tells hali to put the logic file in directoryName directory. If the directory doesn't exist, it is created and the default master.inc.php and auth.inc.php files are added to it.

5. ***`php hali make:include filename`*** : makes an include file in the `includes` folder. The include file has `.inc.php` as its extenstion.

6. ***`php hali --migrate`***: migrates the database named hali_db. Please ensure that this database is created first before running this command. When this command is ran, it will clean the database and create it at fresh, so mind your actions. The sql commands in the schema.sql will be run.