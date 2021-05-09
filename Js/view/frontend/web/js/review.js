define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';
    return Component.extend({
        reviewerName: ko.observable(''),
        reviewerMessage: ko.observable(''),
        isLoading: ko.observable(false),
        url: '',
        initialize: function () {
            this._super();
            this.nextReview();
            return this;
        },
        nextReview: function () {
            this.isLoading(true);
            var self = this;
            var response = {};
            $.ajax({
                url: self.url,
                type: 'post',
                dataType: 'json'})
                .done(function (data) {
                    response = JSON.parse(data);
                    if (response.name && response.message) {
                        self.reviewerName(response.name);
                        self.reviewerMessage(response.message);
                    }
                }).always(function () {
                self.isLoading(false);
            });
        }
    });
});
