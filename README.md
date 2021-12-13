# HALI-Care.-Microsoft

# Local Set up
1. Ensure that you have `composer` installed
2. Run `composer install`
3. Set up your passwords.inc.php in `api/includes/` by following the example provided in the example in the same folder
5. set up your env.json following the env example
7. run the `php hali --migrate` command.


# Diagrams
## System sequence diagram for symptoms collection
![System Sequence for Symptoms collection](https://user-images.githubusercontent.com/56189552/145804351-3bf0e556-1e96-4b38-84c4-64ce24f8ba29.png)

## Sequence diagram for vital signs addition by the patient
In this diagram, only the patient is present and are adding their own vital signs for their consultation
![Adding vital signs by patient](https://user-images.githubusercontent.com/56189552/145809488-d86c6ce2-49a8-4a71-9111-693f9ba3d6ae.png)
  
  
## Sequence diagram for vital signs addition by a medical assistant
In this diagram, the patient has visited a facility and a medical assistant is adding their vital signs for a consultation they have already requested.
![Adding vital signs by medical assistant](https://user-images.githubusercontent.com/56189552/145810505-1bce0dba-b308-4c24-bc9a-b7a9ff079220.png)


