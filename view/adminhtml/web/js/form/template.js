define([
    'Magento_Ui/js/form/element/textarea',
    'underscore'
], function (Textarea, _) {
    'use strict';

    return Textarea.extend({
        defaults: {
            valueUpdate: 'afterkeydown',
            elementTmpl: 'Mitto_Core/form/template',
            len: 0,
            messages: 0,
            limit: 0
        },
        initObservable: function () {
            this.observe('len messages limit');
            return this._super();
        },
        onUpdate: function (val) {
            var str = val.replace(/{{var.*?}}/, '*'.repeat(10));
            var limit = /[^\u0000-\u00ff]/.test(str) ? 70 : 160;
            var messages = Math.ceil(str.length / limit);
            this.len(str.length);
            this.messages(messages);
            this.limit(limit * messages);
            this._super(val);
        }
    });
});
