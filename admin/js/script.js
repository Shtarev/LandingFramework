/* при клике по статическому фото - вывод окна загрузки */
function fotoChoice(elem) {
    var divFileLoad = document.getElementById('divFileLoad');
    if(divFileLoad === null) {
        var div = document.createElement('div');
        div.className = 'divFileLoad';
        div.id = 'divFileLoad';
        var input = document.createElement('input');
        input.type = 'file';
        input.id = elem.id+'File';
        input.name = elem.id+'File';
        div.prepend(input);
        div.insertAdjacentHTML('afterbegin', '<h3 id="divFileLoadH3">Wählen Sie Foto</h3>');
        var clos = document.createElement('div');
        clos.className = 'clos';
        clos.id = 'clos';
        clos.insertAdjacentHTML('afterbegin', 'X')
        div.prepend(clos);
        document.body.append(div);
    }
}
/* при клике по крестику - закрытие окна загрузки */
document.addEventListener("click", function(event) {
    var id = event.target.id;
    if(id == 'clos') {
        var elem = document.getElementById('divFileLoad');
        elem.remove();
    }
});
/* вызов ассинхронное соединение при загрузке статич. фото или ввод в окно эдитора */
document.addEventListener('input', function(event) {
    var id = event.target.id;
    var pos = id.lastIndexOf('File')

    if(pos != -1) {
        var fotoName = id.substring(0, pos);
        datenFileIn(id, 'fotorobot');
        document.getElementById('divFileLoadH3').innerHTML = '<font color="#006600">Foto ist geladen</font>';
        var name = document.getElementById(fotoName+'File').files[0].name;
        var extension = name.split('.').pop();
        document.getElementById(fotoName).src=root+'images/uhr.gif';
        setTimeout(function(){
            var elem = document.getElementById('divFileLoad');
            elem.remove(); // удаляем тэг закрываем окно
            document.getElementById(fotoName).src='images/'+fotoName+'.'+extension;
        }, 3000);
    }
    else if(id == 'beschreibung' || id == 'foto') {
        // здесь при вводе описания фото или выбора фото - не делать ничего
    }
    else {
    // ввод либо из инпута-HTMLInputElement либо из редактора-HTMLDivElement
        var el = document.getElementById(id);
        if(el.constructor.name == 'HTMLDivElement') {
            var value = el.innerHTML;
        }
        else {
            var value = el.value;
        }
        datenIn(id, value, 'robotContent');
    }
});

/* загрузка статического фото */
function datenFileIn(id, robot) {
    var file = document.getElementById(id);
    var xmlhttp = getXmlHttp();
    form = new FormData();
    var upload_file = file.files[0];
    form.append(id, upload_file);
    
    xmlhttp.open('post', root+'src/'+robot+'.php', true);
    xmlhttp.send(form);
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {  
        if(xmlhttp.status == 200) {
        }  
      }  
    }  
}

/* удаление фото */
function fotoLoschen(elem) {
    flag = false;
	var res = confirm('Wollen Sie Foto löschen?'); // алерт перед удалением фото
	if(res) {
        var form = elem.parentElement;
        form[0].name = 'del';
		elem.type='submit';
	}
}

/* редактирование текстового контента */
function datenIn(id, value, robot) {
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', root+'src/'+robot+'.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("id=" + encodeURIComponent(id) + "&value=" + encodeURIComponent(value));
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {  
        }  
      }  
    }  
}

/* клик в окно эдитора */
function editor(elem) {
    var editor = document.getElementById('editor')
    if(editor !== null) {
        editor.remove();
        elem.insertAdjacentHTML('beforebegin', '<div id="editor" class="toolbar">\
                                                      <a href="#" class="toolbar-b fas fa-bold" title="Жирный"></a>\
                                                      <a href="#" class="toolbar-ul fas fa-list-ul" title="Маркированный список"></a>\
                                                      <select class="toolbar-size">\
                                                        <option selected="selected" disabled="disabled">Größe</option>\
                                                        <option value="1">10px</option>\
                                                        <option value="2">12px</option>\
                                                        <option value="3">14px</option>\
                                                        <option value="4">16px</option>\
                                                        <option value="5">18px</option>\
                                                        <option value="6">21px</option>\
                                                        <option value="7">26px</option>\
                                                      </select>\
                                                      <span>Text</span> <input class="toolbar-color" type="color" value="#ff0000">\
                                                      <span>Bg</span> <input class="toolbar-bg" type="color" value="#ffff00">\
                                                    </div>');
    }
    else {
            elem.insertAdjacentHTML('beforebegin', '<div id="editor" class="toolbar">\
                                                  <a href="#" class="toolbar-b fas fa-bold" title="Жирный"></a>\
                                                  <a href="#" class="toolbar-ul fas fa-list-ul" title="Маркированный список"></a>\
                                                  <select class="toolbar-size">\
                                                    <option selected="selected" disabled="disabled">Größe</option>\
                                                    <option value="1">10px</option>\
                                                    <option value="2">12px</option>\
                                                    <option value="3">14px</option>\
                                                    <option value="4">16px</option>\
                                                    <option value="5">18px</option>\
                                                    <option value="6">21px</option>\
                                                    <option value="7">26px</option>\
                                                  </select>\
                                                  <span>Text</span> <input class="toolbar-color" type="color" value="#ff0000">\
                                                  <span>Bg</span> <input class="toolbar-bg" type="color" value="#ffff00">\
                                                </div>');
    }
}

// открываем ассинхронное соединение
function getXmlHttp() {  
    var xmlhttp;  
    try {  
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");  
    } catch (e) {  
    try {  
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");  
    } catch (E) {  
      xmlhttp = false;  
    }  
    }  
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {  
      xmlhttp = new XMLHttpRequest();  
    }  
    return xmlhttp;  
}