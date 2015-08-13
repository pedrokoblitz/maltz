function DataBinder(object_id) {

  var pubSub = {
        callbacks: {},

        on: function(msg, callback) {
          this.callbacks[msg] = this.callbacks[msg] || [];
          this.callbacks[msg].push(callback);
        },

        publish: function(msg) {
          this.callbacks[msg] = this.callbacks[msg] || []
          for (var i = 0, len = this.callbacks[msg].length; i < len; i++) {
            this.callbacks[msg][i].apply(this, arguments);
          }
        }
      },

      data_attr = "data-bind-" + object_id,
      message = object_id + ":change",

      changeHandler = function(evt) {
        var target = evt.target || evt.srcElement, // IE8 compatibility
            prop_name = target.getAttribute(data_attr);

        if (prop_name && prop_name !== "") {
          pubSub.publish(message, prop_name, target.value);
        }
      };

  // Listen to change events and proxy to PubSub
  if (document.addEventListener) {
    document.addEventListener("change", changeHandler, false);
  } else {
    // IE8 uses attachEvent instead of addEventListener
    document.attachEvent("onchange", changeHandler);
  }

  // PubSub propagates changes to all bound elements
  pubSub.on(message, function(evt, prop_name, new_val) {
    var elements = document.querySelectorAll("[" + data_attr + "=" + prop_name + "]"),
        tag_name;

    for (var i = 0, len = elements.length; i < len; i++) {
      tag_name = elements[i].tagName.toLowerCase();

      if (tag_name === "input" || tag_name === "textarea" || tag_name === "select") {
        elements[i].value = new_val;
      } else {
        elements[i].innerHTML = new_val;
      }
    }
  });

  return pubSub;
}


// In the model's setter:
function User(uid) {

  user = {

    set: function(attr_name, val) {
      this.attributes[attr_name] = val;
      binder.publish(uid + ":change", attr_name, val, this);
    }
  }

}