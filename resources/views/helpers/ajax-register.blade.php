<script type="text/javascript">
    $(document).ready(function() {
        $("#register-contact, #edit-contact").mask("(99) 9 9999-9999");

        $("#register-contact, #edit-contact").keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        $("#register-name").on("change", function() {
            var name = $("#register-name").val();

            if (name.length < 5) {
                $("#register-name").addClass("is-invalid");
                $("#register-name").removeClass("is-valid");
            } else {
                $("#register-name").addClass("is-valid");
                $("#register-name").removeClass("is-invalid");
            }

        });

        $("#register-contact").on("change", function() {
            var contact = $("#register-contact").val();

            if (contact.length < 16) {
                $("#register-contact").addClass("is-invalid");
                $("#register-contact").removeClass("is-valid");
            } else {
                $("#register-contact").addClass("is-valid");
                $("#register-contact").removeClass("is-invalid");
            }
        });

        $("#register-email").on("change", function() {
            var email = $("#register-email").val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (!regex.test(email)) {
                $("#register-email").addClass("is-invalid");
                $("#register-email").removeClass("is-valid");
            } else {
                $("#register-email").addClass("is-valid");
                $("#register-email").removeClass("is-invalid");
            }
        });
    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#register-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('registerContact') }}",
            type: "POST",
            dataType: "json",
            data: $('#register-form').serialize(),
            success: function(data) {
                if (data.success == true) {
                    $("#msg").removeClass("alert alert-danger text-center").addClass("alert alert-success text-center").html(data.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $("#msg").removeClass("alert alert-success text-center").addClass("alert alert-danger text-center").html(data.message);
                }
            }
        });
    });
</script>
