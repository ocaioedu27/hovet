
// habilitar dropdown quando o media query for habilitado 
function habilitaDropdown(idDropDownContent, displayType, bgColor=null) {
    let tagDropDownContent = document.getElementById(idDropDownContent)
    if (bgColor == null) {
        bgColor = "white";
    }

    let tagDisplayType = tagDropDownContent.style.display;
    console.log("Display da tag a ser habilitada ou desativada: '" + tagDisplayType + "'")

    if (tagDisplayType == "none" || tagDisplayType == '') {
        tagDropDownContent.style.display = displayType;
        tagDropDownContent.style.backgroundColor = bgColor;
    }else{
        tagDropDownContent.style.display = "none";
    }

}