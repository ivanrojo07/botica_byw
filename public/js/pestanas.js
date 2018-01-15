$(document).ready(function () {
        $('.collapse').collapse({
        toggle: false,
    });
});
$(window).resize(function () {
    var heigh = parseInt($(window).height()) - 150;
    $("iframe").height(heigh);
});
function openNav(obj) {
    closeNav();
    if ($("#mySidenav").width() == "0") {
        $(obj).addClass('active');
        document.getElementById("mySidenav").style.width = "250px";
    }
}


function closeNav() {
    $('.collapse').removeClass('in');
    $('.navbar-nav li').removeClass("active");
}

function AgregarNuevoTab(url, nombre) {
    closeNav();
    var tabs = document.getElementById("tabsApp");
    console.log(tabs);
    var obj = tabs.getElementsByTagName("li");
    for (var i = 0; i < obj.length; i++) {
        var anombre = obj[i].innerText.substring(0, obj[i].innerText.length - 2);
        if (anombre === nombre) {
            CambiarAtributoElementosTag("li", "tabsApp", "class", "");
            CambiarAtributoElementosTag("div", "contenedortab", "class", "tab-pane fade");
            obj[i].className = "active";
            var nombre = $(obj[i].getElementsByTagName("a")[0]).attr("href");
            var iframen = document.getElementById(nombre.replace("#", ""));
            iframen.className = "tab-pane fade in active";
            return false;
        }
    }
    var lblTab = document.createElement("li");
    var numTab = tabs.getElementsByTagName("li").length + 1;
    var titulo = document.createElement("a");
    var heigh = parseInt($(window).height()) - 150;
    titulo.setAttribute("data-toggle", "tab");
    titulo.setAttribute("href", "#tab" + numTab);
    titulo.innerHTML = nombre + "  <span class='close alignright' onclick='CerrarTab(this);'><i class='fa fa-times-circle' aria-hidden='true'></i></span>";
    lblTab.appendChild(titulo);
    tabs.appendChild(lblTab);
    CambiarAtributoElementosTag("li", "tabsApp", "class", "");
    lblTab.className = "active";
    var iframes = document.getElementById("contenedortab");
    var srcTab = document.createElement("div");
    srcTab.id = "tab" + numTab;
    srcTab.innerHTML = " <iframe src='" + url + "' style='height:" + heigh + "px'></iframe>";
    CambiarAtributoElementosTag("div", "contenedortab", "class", "tab-pane fade");
    srcTab.className = "tab-pane fade in active";
    iframes.appendChild(srcTab);
}

function CerrarTab(objeto) {
    var nombre = $(objeto.parentNode).attr("href");
    var iframen = document.getElementById(nombre.replace("#", ""));
    iframen.parentNode.removeChild(iframen);
    objeto.parentNode.parentNode.removeChild(objeto.parentNode);
}

function CambiarAtributoElementosTag(tipo, idContenedor, atributo, valor) {
    var contenedor = document.getElementById(idContenedor);
    var elementos = contenedor.getElementsByTagName(tipo);
    for (var i = 0; i < elementos.length; i++) {
        elementos[i].setAttribute(atributo, valor);
    }
}
function autoCerrar(obj) {
    var url = String(obj)
    url = url.substring(1, url.length);
    $("iframe").each(function () {
        var src = $(this).attr('src');
        if (src === url) {
            var tab = "#" + $(this).parent().attr('id');
            $("#tabsApp> li> a").each(function () {
                var a = $(this).attr("href");
                if (tab === a) {
                    var iframen = document.getElementById(tab.replace("#", ""));
                    var li = $(this).parent();
                    iframen.parentNode.removeChild(iframen);
                    this.parentNode.parentNode.removeChild(this.parentNode);
                }
                return 0;
            });
        }
        return 0;
    });
}

