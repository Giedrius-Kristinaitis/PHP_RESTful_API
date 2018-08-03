/**
 * Makes an AJAX request to the server
 * 
 * @param {string} method - request method to use
 * @param {string} url - url of the requested file
 * @param {function} callback - callback function to be executed when the request finishes
 * @param {array} headers - array of header names
 * @param {array} headerValues - array of header values
 * @param {string} parameters - request parameters if the method used is POST
 */
function ajax(method, url, callback, headers, headerValues, parameters){
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(callback !== undefined){
                callback.apply(this);
            }
        }else if(this.readyState == 4 && this.status == 404){
            alert("404 File Not Found");
        }
    }

    xhttp.open(method, url, true);

    if(headers !== undefined && headerValues !== undefined && headers.length === headerValues.length){
        for(let i = 0; i < headers.length; i++){
            xhttp.setRequestHeader(headers[i], headerValues[i]);
        }
    }

    xhttp.send(parameters);
}

/**
 * Creates a car in the database using RESTful API
 * 
 * @param {string} model - model of the car (without spaces, slashes or other special symbols)
 * @param {integer} hp - horsepower
 * @param {integer} topSpeed - top speed
 * @param {integer} price - price of the car
 */
function createCar(model, hp, topSpeed, price){
    ajax('POST', '../api/create_car.php', 
    
    function(){
        var response = JSON.parse(this.responseText);
        document.writeln(response.message);
    },
    
    ['Content-Type'], ['application/x-www-form-urlencoded'], 'model=' + model + '&hp=' + hp + '&topSpeed=' + topSpeed + '&price=' + price);
}

/**
 * Updates a car in the database using RESTful API
 * 
 * @param {integer} id - id of the car
 * @param {string} model - model of the car (without spaces, slashes or other special symbols)
 * @param {integer} hp - horsepower
 * @param {integer} topSpeed - top speed
 * @param {integer} price - price of the car
 */
function updateCar(id, model, hp, topSpeed, price){
    ajax('POST', '../api/update_car.php', 
    
    function(){
        var response = JSON.parse(this.responseText);
        document.writeln(response.message);
    },
    
    ['Content-Type'], ['application/x-www-form-urlencoded'], 'id=' + id + '&model=' + model + '&hp=' + hp + '&topSpeed=' + topSpeed + '&price=' + price);
}

/**
 * Deletes a car in the database using RESTful API
 * 
 * @param {integer} id - id of the car
 */
function deleteCar(id){
    ajax('POST', '../api/delete_car.php', 
    
    function(){
        var response = JSON.parse(this.responseText);
        document.writeln(response.message);
    },
    
    ['Content-Type'], ['application/x-www-form-urlencoded'], 'id=' + id);
}

// code to be executed when the window is done loading
window.addEventListener('load', function(){
    // some api testing (requires some cars to be in the database)
    createCar('Mitsubishi_Lancer_Evolution', 456, 290, 50000);
    updateCar(4, 'Black_Jack', 1000, 333, 140000);
    deleteCar(2);
});