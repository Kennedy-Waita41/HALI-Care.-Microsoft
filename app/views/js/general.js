
var error = document.getElementById("error-div");
var successDiv = document.getElementById("success-div");

/**
 * 
 * @param {string} url - do add the ../src/ to the url, it will be added automatically 
 * @param {FormData} formData  - the formData to send
 * @param {Function} callback - callback if needed
 * @returns 
 */
async function makeRequest(url = '', formData, callback = null, login=false, signup=false) {
    url = `../../api/${url}`;   
    let user = {token: "nothing"};

    if(!login || !signup ){
        user = window.localStorage.getItem("user");
        if(!user){ //to make a request during login
            location.href = "login.php";
        }

        user = JSON.parse(user);
    }

    if(!user){
        user = {token: "nothing"};
    }

    // Default options are marked with *
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'auth': user.token
      },
      body: formData
    });

    const json = await response.json();
    handleError(json);

    if(callback){
        callback(json);
        return;
    }
    
    return json;
  }

  function showError(data, error_div = null){
    hideSuccess();
    if(error_div){
        error_div.style.opacity = "1";  
        error_div.addEventListener('transitionend', ()=>{
            error_div.innerHTML = data;
        });

        error_div.scrollIntoView({behavior: "smooth", block: "center"});
        setTimeout(() => {
            hideError(error_div);
        }, 5000);
        return;
    }
    error.style.opacity = "1";
    error.innerHTML = data;
    viewError();
    setTimeout(() => {
        hideError();
    }, 5000);
}

function hideError(error_div = null){
    if(error_div){
        error_div.style.opacity = "0";
        error_div.innerHTML = "";
        
        return;
    } 
    
    error.style.opacity = "0";
    error.addEventListener('transitionend', ()=>{
        error.innerHTML = "";
    });
}

function showSuccess(data)
{
    hideError();
    successDiv.style.opacity = "1"; 
    successDiv.innerHTML = data;
    viewSuccess();
    setTimeout(() => {
        hideSuccess();
    }, 5000);
}
 
function viewError(){
    error.scrollIntoView({behavior: "smooth", block: "nearest"});
}

function viewSuccess(){
    successDiv.scrollIntoView({behavior: "smooth", block: "nearest"});
}

function hideSuccess()
{
    successDiv.style.opacity = "0";
    successDiv.innerHTML = "";
}

function getFullStorageLink(link){
    return `../../api/storage/${link}?t=${(new Date()).getTime()}`;
}
//logout method
function logout() {
    let response = makeRequest("api/user/logout.php",null);
    if (response.status=="OK") {
        localStorage.setItem('user', null);
        location.href = "login.php";
    }
}

/**
 * 
 * @param {object} data - an associative array for key: data 
 */
function buildFormData(data){
    let formData = new FormData();

    for (const key in data) {
        formData.append(key, data[key]);
    }

    return formData;
}

function handleError(json){
    switch(json.status){
        case "NLIE":
            {
                location.href = "login.php";
                break;
            }
        case "ALIE":
            {
                location.href = "HomePage.php";
                break;
            }
        default:
            {

            }
    }
}