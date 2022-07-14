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
                template: 'Oscar_Checkout/checkout/requiereFactura',
                CheckVals: ko.observable(false),
                rfc: ko.observable(''),
                rs: ko.observable(''),
                requiere_factura: ko.observable(false)
            },
            initObservable: function () {
    
                 this._super()

                //     .observe({
                //         CheckVals: ko.observable(false), //default checked(true)
                //     });
                // var checkVal=0;
                // self = this;
                // this.CheckVals.subscribe(function (newValue) {
                    
                //     var linkUrls  = url.build('custom/checkout/saveInQuote');
                //     if(newValue) {
                //         checkVal = 1;
                //     }
                //     else{
                //         checkVal = 0;
                //     }
                //     $.ajax({
                //         showLoader: true,
                //         url: linkUrls,
                //         data: {checkVal : checkVal},
                //         type: "POST",
                //         dataType: 'json'
                //     }).done(function (data) {
                //         console.log('success');
                //     });
                // });
                return this;
            },
            sendFactura: function(formElement){
                console.log(formElement);
                console.log('RFC: '+this.rfc());
                console.log('RS: '+this.rs());
                if(this.rfc().match(/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/)){
                    console.log("RFC valido")
                }
                else{
                    console.log("RFC NO valido") 
                }
            }
        });
    });