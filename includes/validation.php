<script>
document.addEventListener("DOMContentLoaded", function() {
    // Trigger validation on tagsinput change
    $("input[name=\"validation-bs-tagsinput\"]").on("itemAdded itemRemoved", function() {
        $(this).valid();
    });
    // Initialize validation
    $("#validation-form").validate({
        ignore: ".ignore, .select2-input",
        focusInvalid: false,
        rules: {
            "validation-email": {
                required: true,
                email: true
            },
            "validation-password": {
                required: true,
                minlength: 6,
                maxlength: 20,
            },
            "validation-password-confirmation": {
                required: true,
                minlength: 6,
                equalTo: "input[name=\"validation-password\"]"
            },
            "validation-checkbox": {
                required: true
            },
        },

        // Errors
        errorPlacement: function errorPlacement(error, element) {
            var $parent = $(element).parents(".error-placeholder");
            // Do not duplicate errors
            if ($parent.find(".jquery-validation-error").length) {
                return;
            }
            $parent.append(
                error.addClass("jquery-validation-error small form-text invalid-feedback")
            );
        },
        highlight: function(element) {
            var $el = $(element);
            var $parent = $el.parents(".error-placeholder");
            $el.addClass("is-invalid");
            // Select2 and Tagsinput
            if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") ===
                "tagsinput") {
                $el.parent().addClass("is-invalid");
            }
        },
        unhighlight: function(element) {
            $(element).parents(".error-placeholder").find(".is-invalid").removeClass("is-invalid");
        }
    });
});
</script>