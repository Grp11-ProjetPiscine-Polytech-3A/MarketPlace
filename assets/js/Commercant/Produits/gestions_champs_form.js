$("#add_carac_button").click(add_carac_field)
$("#add_img_button").click(add_img_field)

// Ajoute un champ de caracteristique 
function add_carac_field() {
    var select_carac = document.createElement("select")
    select_carac.className = "form-control col-3"
    select_carac.name = "carac[]"

    for (var idcarac in carac_array) {
        var opt = document.createElement("option")
        opt.value = idcarac;
        opt.innerHTML = carac_array[idcarac];
        select_carac.append(opt)
    }

    var textarea_carac = document.createElement("textarea")
    textarea_carac.name = "carac_text[]"
    textarea_carac.className = "form-control col-12"

    var div_carac = document.createElement("div")
    div_carac.className = "carac"
    div_carac.append("Sélectionner la caractéristique : ")
    div_carac.append(select_carac)
    div_carac.append("Contenu : ")
    div_carac.append(textarea_carac)

    $("#carac").append("<br/>")
    $("#carac").append(div_carac)
}

// Ajoute un champ input pour les images
function add_img_field() {
    var input = document.createElement("input")
    input.type = "file"
    input.name = "image[]"
    input.size = "20"

    $("#input-img").append('<br/>');
    $("#input-img").append(input);
}