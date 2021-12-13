# consultation  
This folder contains consultation logic or procedures files, their expected input **parameters**, **what they do**, and **output or response**.
  
# addvitals.php
|   |   |
|---|---|
| **DESCRIPTION:**  | Does what the name suggests  and requires the session token |
| **EXPECTS:**  |  **ticket: string, bodyTemp: number, bloodPressure: number, pulseRate: number, respRate: number, pUsername: string** in HTTP POST request |
| **OUTPUT OR RESPONSE** | As specified in the api/readme.md   |  
  
    
# add.php
|   |   |
|---|---|
| **DESCRIPTION:**  | Does what the name suggests and requires a patient session token (logged in)   |
| **EXPECTS:**  |  |
| **OUTPUT OR RESPONSE** | As specified in the api/readme.md with the consultation ticket  |  
  
    
# setdoctor.php
|   |   |
|---|---|
| **DESCRIPTION:**  | this script assigns a doctor to a consultation. This can only be called by a medical assistant or a doctor and requires the session token (logged in)   |
| **EXPECTS:**  |  **doctorId: int, ticket: string, pUsername:string** in HTTP POST request |
| **OUTPUT OR RESPONSE** | As specified in the api/readme.md   |  
  
    
# complete.php
|   |   |
|---|---|
| **DESCRIPTION:**  | changes the status of a consultation to completed. and requires the session token (logged in)   |
| **EXPECTS:**  |  **ticket: string** in HTTP POST request |
| **OUTPUT OR RESPONSE** | As specified in the api/readme.md   |  
  
    
# list.php
|   |   |
|---|---|
| **DESCRIPTION:**  | lists consultations for a doctor based on the status and whether they were self assigned or not. Also requires the session token (logged in)   |
| **EXPECTS:**  |  **interval: int, page: int, selfAssigned: int (1|0), status: int (0|1|2)** in HTTP POST request |
| **OUTPUT OR RESPONSE** | As specified in the api/readme.md. Ok responses looks like this |  

`
{
    "status": "OK",
    "message": {
        "consultations": [
            {
                "id": 1, 
                "patientId": 2, 
                "doctorId": 3, 
                "symptoms": "XYZ",
                "patientVitals": { 
                    "bodyTemp": "38 C", 
                    "respRate": "x unit", 
                    "pulseRate": "y unit", 
                    "bloodPressure": "z unit",
                    "dateAdded": "31/1/2021"
                }, 
                "dateAdded": "31/1/2021", 
                "dateAssigned": "1/2/2021", 
                "status": 0, 
                "medAssistantId": 1,
                "isAssigned": true
            },
            ...
        ],
        "patients": {
            "c1": { 
                "id": 2, 
                "firstname": "John", 
                "lastname" : "Doe", 
                "dob": "13/06/2000", 
                "phone": "+254786908765",    
                "email": "john@doe.com", 
                "profileImageLink": "/storage/profile_images/1.jpg?xxx" 
            },
            ...
        },

        "medicalAssistants": {
            "c1": { 
                "id": 1, 
                "firstname": "Mary", 
                "lastname" : "Doe", 
                "dob": "13/06/2000", 
                "phone": "+254786908765",    
                "email": "mary@doe.com", 
                "profileImageLink": "/storage/profile_images/1.jpg?xxx" 
            },
            ...
        },
        
    }
}
`  
    
# info.php
|   |   |
|---|---|
| **DESCRIPTION:**  | gives the information whose ticket is given and requires the session token (logged in)   |
| **EXPECTS:**  |  **ticket: string** in HTTP POST request |
| **OUTPUT OR RESPONSE** | As specified in the api/readme.md   |  
  
    
# addsymptoms.php
|   |   |
|---|---|
| **DESCRIPTION:**  | Does what the name suggests and requires the session token (logged in)   |
| **EXPECTS:**  |  **parameter: type** in HTTP POST request |
| **OUTPUT OR RESPONSE** | As specified in the api/readme.md   |  
  
    
