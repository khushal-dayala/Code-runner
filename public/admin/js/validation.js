$(document).ready(function () {
    $("#booking-form").validate({
        rules: {
            reference: "required",
            reference_answer1: "required",
            reference_answer2: "required",
            reference_answer3: "required",
            reference_answer4: "required",
            state: "required",
            first_name: {
                required: !0,
                fnameCheck: !0,
                noInputSpaces: !0,
                maxlength: 40

            },
            last_name: {
                required: !0,
                lnameCheck: !0,
                noInputSpaces: !0,
                maxlength: 40

            },
            email_address: {
                required: !0,
                email: !0,
                emailCheck: true,
                maxlength: 250
            },
            primary_phone: {
                required: true,
                phoneUS: true,
                phoneValidate: true
            },
            current_situation_reason: {
                required: !0,
                maxlength: 255,
                customregex: !0
            },
            opt_special_offers: {
                required: true
            },
            phone_special_offers: {
                required: true
            },
            desired_position: {
                required: true
            },
            TCPA_checkbox: "required",
            "current_situation[]": {
                required: !0
            },
            wage_garnishment: "required",
            tax_debt: {
                required: true
            }

        },
        messages: {
            TCPA_checkbox: "Please agree terms",
            "current_situation[]": "Please select atleast one option"
        },
        submitHandler: function (e) {
            $("#loader").show(), e.submit()
        },
        ignore: ":hidden:not(:checkbox)"
    })


    jQuery.validator.addMethod("emailCheck", function (e, t) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z]{2,4})+$/;
        return regex.test(e);
    }, "Please enter a valid email address."),

        jQuery.validator.addMethod("phoneUS", function (value, element) {
            return this.optional(element) || /^\(\d{3}\) \d{3}-\d{4}$/.test(value) || /^[1-9]\d{2}-\d{3}-\d{4}$/.test(value);
        }, "Please enter a valid US phone number in the format (999) 999-9999");

    $.validator.addMethod("phoneValidate", function (e, t) {
        e = e.replace(/\\s+/g, "");
        return this.optional(t) || e.length > 9 && e.match(/^\([2-9]\d{2}\) [0-9]\d{2}-\d{4}$/) || e.length > 9 && e.match(/^[2-9]\d{2}-\d{3}-\d{4}$/);
    }, "Please don’t add '0' or '1' before your phone number");



    $.validator.addMethod("fnameCheck", function (e, t) {
        return this.optional(t) || /^[a-zA-Z ]+$/i.test(e)
    }, "First Name must contain only letters and characters"), $.validator.addMethod("lnameCheck", function (e, t) {
        return this.optional(t) || /^[a-zA-Z ]+$/i.test(e)
    }, "Last Name must contain only letters and characters"), $.validator.addMethod("noSpace", function (e, t) {
        return 0 > e.indexOf(" ") && "" != e
    }, "Space are not allowed"), $.validator.addMethod("customregex", function (e, t) {
        return this.optional(t) || /^[^-\s][a-zA-Z\s-]+$/i.test(e)
    }, "Only letters and characters accepted"), $.validator.addMethod("noInputSpaces", function (value, element) {
        return !/^\s+$/.test(value); // Returns true if the value doesn't contain only spaces
    }, "Input must not contain only spaces.");
});