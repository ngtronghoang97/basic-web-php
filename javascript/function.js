//checkall
document.getElementById("btn_checkall").onclick = function (){
    var checkboxes = document.getElementsByName('name[]');
    for (var i = 0; i < checkboxes.length; i++){
        checkboxes[i].checked = true;
    }
};
//uncheckall
document.getElementById("btn_uncheckall").onclick = function (){
    var checkboxes = document.getElementsByName('name[]');
    for (var i = 0; i < checkboxes.length; i++){
        checkboxes[i].checked = false;
    }  
};
