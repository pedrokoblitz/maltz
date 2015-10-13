var Content = function (view, ajax) {

    var displayCallback = function (response) {
        view.render(response);
    };

    var showCallback = function (response) {
        view.render(response);
    };

    var saveCallback = function (response) {

    };

    var removeCallback = function (response) {

    };

    var find = function (type, pg, key, order) {
        route = '';
        ajax.get(route, displayCallback);
    };

    var displayTree = function (type) {
        route = '';
        ajax.get(route, displayCallback);
    };
    
    var show = function (id) {
        route = '';
        ajax.get(route, showCallback);
    };
    
    var save = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    var remove = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    var addAttachment = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    var removeAttachment = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    var addMeta = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    var removeMeta = function (data) {
        route = '';
        ajax.post(route, data, removeCallback);
    };
    
    var area = function () {
        route = '';
        ajax.get(route, displayCallback);
    };
    
    var showArea = function (id) {
        route = '';
        ajax.get(route, showCallback);
    };

    var addBlock = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    var removeBlock = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    var removeArea = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    var saveArea = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    var showBlock = function (id) {
        route = '';
        ajax.get(route, saveCallback);
    };

    var saveBlock = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    var block = function () {
        route = '';
        ajax.get(route, saveCallback);
    };

    return {

    };
}

var ContentCtrl = function (content, form) {

    var setSaveButton = function (buttonId) {
        var button = document.getElementById(buttonId);
        button.onclick(save);
    };

    var save = function () {
        var data = form.serialize();
        content.save(data);
    };

    var route = function () {
        routie('block/:id/show', content.showBlock(id));
        routie('block', content.block());
        routie('area/:id/show', content.showArea(id));
        routie('areas', content.area());
        routie('content/:type/tree', content.displayTree(type));
        routie('content/:type/:pg/:key/:order', content.find(type, pg, key, order));
        routie('content/:id/show', content.show(id));
    };

    return {
        button : setSaveButton,
        save : save,
        route : route
    };
};
