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
                rfcFormat: ko.observable()
            },
            initObservable: function () {
    
                this._super()
                self = this;

                this.CheckVals.subscribe(function (newValue) {
                    if(newValue) {
                        //activa los campos requeridos
                        $("#rfc-field").prop('required',true);
                        $("#rs-field").prop('required',true);
                        $("#constanciaFile").prop('required',true);
                        $('button.checkout').attr('disabled', true);
                    }
                    else{
                        //desactiva los campos requeridos
                        $("#rfc-field").prop('required',false);
                        $("#rs-field").prop('required',false);
                        $("#constanciaFile").prop('required',false);
                        $('button.checkout').attr('disabled', false);
                    }
                });
                return this;
            },
            sendFactura: function(formElement){
                if(this.rfc().match(/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/)){
                    this.rfcFormat("");
                    var file = document.getElementById('constanciaFile').files[0];
                    var form;
                    if (typeof file != 'undefined') {
                        form = new FormData();
                        form.append('file', file);
                        form.append('requiereFactura',1);
                        form.append('rfc',this.rfc());
                        form.append('rs',this.rs());
                    }

                    var postUrl  = url.build('custom/checkout/saveInQuote');
                    $.ajax({
                        showLoader: true,
                        url: postUrl,
                        data: form,
                        type: "POST",
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                    }).done(function (data){
                        $('button.checkout').attr('disabled', false);
                    });
                    
                }
                else{
                    this.rfcFormat("RFC No valido");
                }

            }
        });
    });