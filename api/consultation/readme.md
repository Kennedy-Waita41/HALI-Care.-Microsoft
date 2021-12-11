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
| **EXPECTS:**  |  **doctorId: int, ticket: string** in HTTP POST request |
| **OUTPUT OR RESPONSE** | As specified in the api/readme.md   |  
  
    
# complete.php
|   |   |
|---|---|
| **DESCRIPTION:**  | changes the status of a consultation to completed. and requires the session token (logged in)   |
| **EXPECTS:**  |  **ticket: string** in HTTP POST request |
| **OUTPUT OR RESPONSE** | As specified in the api/readme.md   |  
  
    
