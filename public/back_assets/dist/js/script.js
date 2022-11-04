$("body").on("click", ".btn-delete", function () {
    event.preventDefault();
    let me = $(this),
        url = me.attr("href"),
        csrf_token = $("meta[name=csrf-token]").attr("content");
    Swal.fire({
        text: "Setelah dihapus, Anda tidak akan dapat memulihkannya!?",
        icon: "question",
        showCancelButton: true,
        cancelButtonText: "Tidak!",
        confirmButtonColor: "#28A745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    _method: "DELETE",
                    _token: csrf_token,
                },
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Sukses!",
                        timer: 5000,
                        text: response.message,
                    }).then((result) => {
                        table.ajax.reload();
                    });
                },
                error: function (xhr) {
                    let error = xhr.responseJSON;
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        timer: 5000,
                        text: error.message,
                    });
                },
            });
        }
    });
});
