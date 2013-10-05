define({
        util: {
            bind: function _bind(method, context) {
                context = context || this;

                return function __bind() {
                    return method.apply(context, arguments);
                };
            }
        }
    }
);