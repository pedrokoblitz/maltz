var View = function (mustache) {
    var render = function (template, data) {
        return mustache.render(template, data);
    };

    return {
        render : render
    };
};