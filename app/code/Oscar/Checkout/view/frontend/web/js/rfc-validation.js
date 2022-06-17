define(
    ['jquery'],
   function($) {
  "use strict";
    return function(validator) {
        validator.addRule(
            'validate-rfc',
                function(value) {
                    return value.match(/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/);
                },
            $.mage.__('El formato del RFC no coincide')
        );
        return validator;
    }
});