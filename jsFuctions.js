/*
 * Regist form javascript validation
 * Written by: Sam - 18 May
 * OOSD APR 23 2015 - Threaded Project Workshop 1 - Team 5
 */

function jsValidate() 
{
    var message = "";
    var postalCodeRegEx = new RegExp(/^[A-Z][0-9][A-Z]\s?\d[A-Z]\d$/i);	
    var custRegForm = document.getElementById("register");
    if(custRegForm.CustFirstName.value.trim() == "") 
    {
        message += "First Name required <br/>";
    } 
    if (custRegForm.CustLastName.value.trim() == "") 
    {
        message += "Last Name required <br/>";
    }
    if (custRegForm.CustAddress.value.trim() == "") 
    {
        message += "Address required <br/>";
    }
    if (custRegForm.CustCity.value.trim() == "") 
    {
        message += "City required <br/>";
    }
    if (custRegForm.CustProv.value.trim() == "") 
    {
        message += "Province required <br/>";
    }
    if (custRegForm.CustPostal.value.trim() == "")
    {
        message += "Postal Code required <br/>";
    }
    if (!postalCodeRegEx.test(custRegForm.CustPostal.value)) 
    {
        message += "Invalid Postal code format<br/>";
    }
    if (custRegForm.CustCountry.value.trim() == "") 
    {
        message += "Country required <br/>";
    }
    if (custRegForm.CustHomePhone.value.trim() == "") 
    {
        message += "Home Phone required <br/>";
    }
    if (custRegForm.CustBusPhone.value.trim() == "") 
    {
        message += "Bus/Cell phone required <br/>";
    }
    if (custRegForm.CustEmail.value.trim() == "") 
    {
        message += "Valid email address is required <br/>";
    }
    if (custRegForm.username.value.trim() == "") 
    {
        message += "Please select a username for your account <br/>";
    }
    if (custRegForm.password.value.trim() == "") 
    {
        message += "Please enter a password for your account <br/>";
    }  
    
    if(message != "") 
    {      
        document.getElementById("errorMessage").innerHTML = message;
        return false;
    } 
    else 
    {
        return confirm("Continue submitting?");
    }
    
}
