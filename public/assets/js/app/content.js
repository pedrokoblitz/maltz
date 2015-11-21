/**
 * /
 * @param {[type]} view [description]
 * @param {[type]} ajax [description]
 */
var Content = function (view, ajax) {

    /**
     * /
     * @param  {[type]} response [description]
     * @return {[type]}          [description]
     */
    var displayCallback = function (response) {
        view.render(response);
    };

    /**
     * /
     * @param  {[type]} response [description]
     * @return {[type]}          [description]
     */
    var showCallback = function (response) {
        view.render(response);
    };

    /**
     * /
     * @param  {[type]} response [description]
     * @return {[type]}          [description]
     */
    var saveCallback = function (response) {

    };

    /**
     * /
     * @param  {[type]} response [description]
     * @return {[type]}          [description]
     */
    var removeCallback = function (response) {

    };

    /**
     * /
     * @param  {[type]} type  [description]
     * @param  {[type]} pg    [description]
     * @param  {[type]} key   [description]
     * @param  {[type]} order [description]
     * @return {[type]}       [description]
     */
    var find = function (type, pg, key, order) {
        route = '';
        ajax.get(route, displayCallback);
    };

    /**
     * /
     * @param  {[type]} type [description]
     * @return {[type]}      [description]
     */
    var displayTree = function (type) {
        route = '';
        ajax.get(route, displayCallback);
    };
    
    /**
     * /
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    var show = function (id) {
        route = '';
        ajax.get(route, showCallback);
    };
    
    /**
     * /
     * @param  {[type]} data [description]
     * @return {[type]}      [description]
     */
    var save = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    /**
     * /
     * @param  {[type]} data [description]
     * @return {[type]}      [description]
     */
    var remove = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    /**
     * /
     * @param {[type]} data [description]
     */
    var addAttachment = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    /**
     * /
     * @param  {[type]} data [description]
     * @return {[type]}      [description]
     */
    var removeAttachment = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    /**
     * /
     * @param {[type]} data [description]
     */
    var addMeta = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };
    
    /**
     * /
     * @param  {[type]} data [description]
     * @return {[type]}      [description]
     */
    var removeMeta = function (data) {
        route = '';
        ajax.post(route, data, removeCallback);
    };
    
    /**
     * /
     * @return {[type]} [description]
     */
    var area = function () {
        route = '';
        ajax.get(route, displayCallback);
    };
    
    /**
     * /
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    var showArea = function (id) {
        route = '';
        ajax.get(route, showCallback);
    };

    /**
     * /
     * @param {[type]} data [description]
     */
    var addBlock = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    /**
     * /
     * @param  {[type]} data [description]
     * @return {[type]}      [description]
     */
    var removeBlock = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    /**
     * /
     * @param  {[type]} data [description]
     * @return {[type]}      [description]
     */
    var removeArea = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    /**
     * /
     * @param  {[type]} data [description]
     * @return {[type]}      [description]
     */
    var saveArea = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    /**
     * /
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    var showBlock = function (id) {
        route = '';
        ajax.get(route, saveCallback);
    };

    /**
     * /
     * @param  {[type]} data [description]
     * @return {[type]}      [description]
     */
    var saveBlock = function (data) {
        route = '';
        ajax.post(route, data, saveCallback);
    };

    /**
     * /
     * @return {[type]} [description]
     */
    var block = function () {
        route = '';
        ajax.get(route, saveCallback);
    };

    return {

    };
}

/**
 * /
 * @param {[type]} content [description]
 * @param {[type]} form    [description]
 */
var ContentCtrl = function (content, form) {

    /**
     * /
     * @param {[type]} buttonId [description]
     */
    var setSaveButton = function (buttonId) {
        var button = document.getElementById(buttonId);
        button.onclick(save);
    };

    /**
     * /
     * @return {[type]} [description]
     */
    var save = function () {
        var data = form.serialize();
        content.save(data);
    };

    /**
     * /
     * @return {[type]} [description]
     */
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
