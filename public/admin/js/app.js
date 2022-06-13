function toggle(source, name) {
    checkboxes = document.getElementsByName(name + '[]');
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}

function initSingleSwitchery(elem) {
    var init = new Switchery(elem, {size: 'small'});
}


// js switchery multiple
function initSwichery() {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });
}

initSwichery();