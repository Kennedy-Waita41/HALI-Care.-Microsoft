# HALI-Care.-Microsoft

# Local Set up
1. Ensure that you have `composer` installed
2. Run `composer install`
3. Set up your passwords.inc.php in `api/includes/` by following the example provided in the example in the same folder
5. set up your env.json following the env example
7. run the `php hali --migrate` command.


# Sequence Diagrams
## Consultation initiation and Symptoms collection
Here, the patient requests a consulation for which a ticket is given. Afterwards, they are taken to AzureHealth chatbot for their symptoms collection. Azure then sents the compiled result to HaliCare database.
![System Sequence for Symptoms collection](https://user-images.githubusercontent.com/56189552/145804351-3bf0e556-1e96-4b38-84c4-64ce24f8ba29.png)

## Vital signs addition by the patient
In this diagram, only the patient is present and is adding their own vital signs for their consultation
![Adding vital signs by patient](https://user-images.githubusercontent.com/56189552/145809488-d86c6ce2-49a8-4a71-9111-693f9ba3d6ae.png)
  
  
## Vital signs addition by a medical assistant
In this diagram, the patient has visited a facility and a medical assistant is adding their vital signs for a consultation they have already requested.
![Adding vital signs by medical assistant](https://user-images.githubusercontent.com/56189552/145810505-1bce0dba-b308-4c24-bc9a-b7a9ff079220.png)

## Assignment of Doctor to a Consultation by a Medical Assistant
In this diagram, a consultation gets assigned to a medical doctor by a medical assistant. We assume that the patient visited the healthcare facility.
![Assign Consultation to doctor by Medical Assistant](https://user-images.githubusercontent.com/56189552/145813358-60970cce-fa63-4ef9-a9d0-a4cf2a994698.png)

## Doctor assigns self to consultation
In this diagram, the doctor assigns themselves to a consultation.
![Doctor Assigns Self to Consultation](https://user-images.githubusercontent.com/56189552/145816017-0c2c5ed2-683d-4f72-903d-bb3ef3fbb6bc.png)
