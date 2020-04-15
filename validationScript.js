function validate(form) //This function validates form fields
{
    fail = validateName(form.name.value);
    fail += validateContactNo(form.contactNo.value);
    fail += validateAddress(form.address.value);
    fail += validatePassword(form.password.value);
    fail += validateDOB(form.DOB.value);
              
    if(fail == "")
    {
        return true;
    }
    else
    {
        alert(fail);
        return false;
    }
}
//This function validate if name field has been passed a value and a correct one
function validateName(field)
{
    if(field == ""){
        return "No Name was entered.\n";
    }
    else if(field.length <= 2)
    {
        return "Enter a valid name.\n";
    }
    return "";
}
//This function validate if ContactNo field has been passed a value and a correct one
function validateContactNo(field)
{
    if(field == "")
    {
        return "No Contact was entered.\n";
    } 
    else if(field.length < 10 || field.length > 10){
        return "Cellphone numbers have 10 digits.\n";
    }
    return "";
}
//This function validate if address field has been passed a value and a correct one
function validateAddress(field)
{
    if(field == "")
    {
        return "No Address was entered.\n";
    }
    else if(/[^a-zA-Z0-9.-\s]/.test(field))
    {
        return "Only spaces, a-z, A-Z, 0-9, - and . allowed in Addresses.\n";
    }
    return "";
}
/*This function validate if password field has been passed a value
 * and a correct one. It also validates if a given password passes
 * the requirement of alphanumeric values
 */ 
function validatePassword(field)
{
    if(field == "")
    {
        return "No Password was entered.\n";
    }
    else if(field.length < 6)
    {
        return "Password must be at least 6 characters.\n";
    }
    else if(!/[a-z]/.test(field) || ! /[A-Z]/.test(field) || 
                !/[0-9]/.test(field))
    {
        return "Passwords require one each of a-z, A-Z and 0-9.\n";
    }
    return "";
}
//This function validates if a given date of birt is correct
function validateDOB(field)
{
    if(field == "")
    {
        return "No Date of Birth was entered.\n";
    }
    else if(/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/.test(field))
    {
        return "Enter correct Date Of Birth.\n";
    }
    return "";
}