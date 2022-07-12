<script>
    $('#edit-form{{ $contact->id }}').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('editContact') }}",
            type: "POST",
            dataType: "json",
            data: $('#edit-form{{ $contact->id }}').serialize(),
            success: function(data) {
                if (data.success == true) {
                    $("#msg{{ $contact->id }}").removeClass("alert alert-danger text-center").addClass("alert alert-success text-center").html(data.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $("#msg{{ $contact->id }}").removeClass("alert alert-success text-center").addClass("alert alert-danger text-center").html(data.message);
                }
            }
        });
    });
</script>