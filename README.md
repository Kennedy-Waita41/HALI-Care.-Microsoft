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
![System Sequence for Symptoms collection (1)](https://user-images.githubusercontent.com/56189552/145821810-546bd0ce-6bdb-4dd5-8ce0-30ebd91dc3fd.png)


## Vital signs addition by the patient
In this diagram, only the patient is present and is adding their own vital signs for their consultation
![Adding vital signs by patient (1)](https://user-images.githubusercontent.com/56189552/145820933-55b06338-1e81-4466-a4ce-48bd5c15d975.png)

  
  
## Vital signs addition by a medical assistant
In this diagram, the patient has visited a facility and a medical assistant is adding their vital signs for a consultation they have already requested.
![Adding vital signs by medical assistant (1)](https://user-images.githubusercontent.com/56189552/145820211-39192e82-d740-4ac9-bb4e-dca991e4bfe3.png)


## Assignment of Doctor to a Consultation by a Medical Assistant
In this diagram, a consultation gets assigned to a medical doctor by a medical assistant. We assume that the patient visited the healthcare facility.
![Assign Consultation to doctor by Medical Assistant (1)](https://user-images.githubusercontent.com/56189552/145819874-49c1e76f-b04e-4c7e-80a7-3ca5b01bc908.png)


## Doctor assigns self to consultation
In this diagram, the doctor assigns themselves to a consultation.
![Doctor Assigns Self to Consultation](https://user-images.githubusercontent.com/56189552/145816017-0c2c5ed2-683d-4f72-903d-bb3ef3fbb6bc.png)
