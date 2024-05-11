
function UploadCategoryOptionCheck(option)
{
    value = document.getElementById("OptionOther").value;

    if(option){

        if(value == option.value){

            document.getElementById("fProductCustomCategory_Wrapper").style.display = "block";
            document.getElementById("fProductCustomCategory_Input").required = true;
        }else{

            document.getElementById("fProductCustomCategory_Wrapper").style.display = "none";
            document.getElementById("fProductCustomCategory_Input").removeAttribute("required");
        }
    }else{

        document.getElementById("fProductCustomCategory_Wrapper").style.display = "none";
        document.getElementById("fProductCustomCategory_Input").removeAttribute("required");
    }
}