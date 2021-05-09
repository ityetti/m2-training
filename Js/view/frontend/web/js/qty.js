define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';
    return Component.extend({
        productQtyInfo: ko.observable(''),
        isLoading: ko.observable(false),
        isVisible: ko.observable(false),
        url: '',
        id: '',
        initialize: function () {
            this._super();
            this.isVisible(false);
            return this;
        },
        getQty: function () {
            this.isLoading(true);
            var self = this;
            var response = {};
            $.ajax({
                url: self.url,
                type: 'post',
                dataType: 'json',
                data: {product_id: self.id}
            }).done(function (data) {
                    response = JSON.parse(data);
                    if (response) {
                        self.isVisible(true);
                        self.productQtyInfo(response);
                    }
                }).always(function () {
                self.isLoading(false);
            });
        }
    });
});
