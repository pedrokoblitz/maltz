/**
 * /
 * @param {[type]} mustache [description]
 */
var View = function (mustache) {
    /**
     * /
     * @param  {[type]} template [description]
     * @param  {[type]} data     [description]
     * @return {[type]}          [description]
     */
    var render = function (template, data) {
        return mustache.render(template, data);
    };

    return {
        render : render
    };
};