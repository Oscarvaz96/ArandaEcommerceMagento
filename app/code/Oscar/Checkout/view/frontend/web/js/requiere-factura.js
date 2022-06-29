define(
    [
        'ko',
        'jquery',
        'uiComponent',
        'mage/url'
    ],
    function (ko, $, Component,url) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Oscar_Checkout/checkout/requiereFactura'
            },
            initObservable: function () {
    
                this._super()
                    .observe({
                        CheckVals: ko.observable(false) //default checked(true)
                    });
                var checkVal=0;
                self = this;
                this.CheckVals.subscribe(function (newValue) {
                    
                    var linkUrls  = url.build('custom/checkout/saveInQuote');
                    if(newValue) {
                        checkVal = 1;
                    }
                    else{
                        checkVal = 0;
                    }
                    $.ajax({
                        showLoader: true,
                        url: linkUrls,
                        data: {checkVal : checkVal},
                        type: "POST",
                        dataType: 'json'
                    }).done(function (data) {
                        console.log('success');
                    });
                });
                return this;
            }
        });
    });