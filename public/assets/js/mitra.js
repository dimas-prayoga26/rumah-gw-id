$(document).ready(function () {
    // DataTable
    $("#mitrasTable").DataTable({
        responsive: true,
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excel",
                text: "Export Excel",
                exportOptions: {
                    columns: ":not(:last-child)", // skip kolom terakhir
                },
            },
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: { next: "Next", previous: "Prev" },
        },
    });

    function formatRupiahInput(el) {
        el.addEventListener("input", function () {
            let value = this.value.replace(/[^0-9]/g, "");
            this.value = value
                ? "Rp " + Number(value).toLocaleString("id-ID")
                : "";
        });
    }

    formatRupiahInput(document.getElementById("hargaMitraTambah"));
    formatRupiahInput(document.getElementById("hargaMitraEdit"));

    // Open Edit Modal
    $(".btn-edit-mitra").click(function () {
        const modal = new bootstrap.Modal(
            document.getElementById("editMitraModal"),
        );
        $("#id").val($(this).data("id"));
        $("#namaMitraEdit").val($(this).data("nama"));
        $("#emailMitraEdit").val($(this).data("email"));
        $("#alamatMitraEdit").val($(this).data("alamat"));
        $("#whatsappMitraEdit").val($(this).data("whatsapp"));
        $("#hargaMitraEdit").val(
            "Rp " + Number($(this).data("harga")).toLocaleString("id-ID"),
        );
        $('#editMitraModal select[name="lokasiMitra"]').val(
            $(this).data("lokasi"),
        );
        $('#editMitraModal select[name="keahlianMitra"]').val(
            $(this).data("keahlian"),
        );
        $('#editMitraModal textarea[name="deskripsiMitra"]').val(
            $(this).data("deskripsi"),
        );
        $("#editMitraForm").data("id", $(this).data("id"));
        modal.show();
    });

    // Submit Edit
    $("#editMitraForm").submit(function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        const btn = $(this).find('button[type="submit"]');
        btn.prop("disabled", true);
        btn.find(".btn-text").addClass("d-none");
        btn.find(".btn-loading").removeClass("d-none");

        const formData = new FormData(this);
        // hilangkan formatting Rp
        formData.set(
            "hargaMitra",
            formData.get("hargaMitra").replace(/[^0-9]/g, ""),
        );

        axios
            .post(`/admin/edit-mitra/${id}?_method=PUT`, formData)
            .then((res) => {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.data.message,
                    timer: 1500,
                    showConfirmButton: false,
                }).then(() => location.reload());
            })
            .catch((err) => {
                let msg = "Terjadi kesalahan";
                if (err.response?.status === 422) {
                    const errors = err.response.data.errors;
                    msg = Object.values(errors)[0][0];
                }
                Swal.fire({ icon: "error", title: "Gagal", text: msg });
            })
            .finally(() => {
                btn.prop("disabled", false);
                btn.find(".btn-text").removeClass("d-none");
                btn.find(".btn-loading").addClass("d-none");
            });
    });

    // Submit Add
    $("#addMitraForm").submit(function (e) {
        e.preventDefault();
        const btn = $("#btnTambahMitra");
        btn.prop("disabled", true);
        btn.find(".btn-text").addClass("d-none");
        btn.find(".btn-loading").removeClass("d-none");

        const formData = new FormData(this);
        formData.set(
            "hargaMitra",
            formData.get("hargaMitra").replace(/[^0-9]/g, ""),
        );

        axios
            .post("/admin/tambah-mitra", formData)
            .then((res) => {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.data.message,
                    timer: 1500,
                    showConfirmButton: false,
                }).then(() => location.reload());
            })
            .catch((err) => {
                let msg = "Terjadi kesalahan";
                if (err.response?.status === 422) {
                    const errors = err.response.data.errors;
                    msg = Object.values(errors)[0][0];
                }
                // console.log(err.response);
                Swal.fire({ icon: "error", title: "Gagal", text: msg });
            })
            .finally(() => {
                btn.prop("disabled", false);
                btn.find(".btn-text").removeClass("d-none");
                btn.find(".btn-loading").addClass("d-none");
            });
    });

    // DELETE MITRA
    $(".form-delete-mitra").submit(function (e) {
        e.preventDefault(); // cegah submit default

        const id = $(this).data("id"); // ambil id dari data-id form
        const form = $(this);

        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data mitra akan dihapus permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                axios
                    .delete(`/admin/hapus-mitra/${id}`)
                    .then((res) => {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: res.data.message,
                            timer: 1500,
                            showConfirmButton: false,
                        }).then(() => {
                            // hapus row dari table langsung tanpa reload
                            form.closest("tr").remove();
                        });
                    })
                    .catch((err) => {
                        Swal.fire("Gagal", "Data gagal dihapus", "error");
                    });
            }
        });
    });
});
