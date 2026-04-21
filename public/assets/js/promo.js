$(document).ready(function () {
    $("#promosTable").DataTable({
        responsive: true,
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excelHtml5",
                text: "Export Excel",
                className: "btn btn-success",
                title: "Data Promo",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                    format: {
                        body: function (data, row, column, node) {
                            const div = document.createElement("div");
                            div.innerHTML = data;
                            return (
                                div.textContent.trim() || div.innerText.trim()
                            );
                        },
                    },
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
});

document.addEventListener("DOMContentLoaded", function () {
    const modalEl = document.getElementById("editPromoModal");
    const modal = new bootstrap.Modal(modalEl);
    const form = document.getElementById("editPromoForm");
    const btn = document.getElementById("btnEditPromo");

    // ✅ FIX: pakai delegation biar aman dengan DataTables
    $(document).on("click", ".btn-edit", function () {
        document.getElementById("id").value = this.dataset.id;
        document.getElementById("edit_judul").value = this.dataset.judul;
        document.getElementById("edit_diskon").value = this.dataset.diskon;
        document.getElementById("edit_tanggal_mulai").value =
            this.dataset.tanggal_mulai;
        document.getElementById("edit_tanggal_selesai").value =
            this.dataset.tanggal_selesai;

        modal.show();
    });

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            btn.querySelector(".btn-text").classList.add("d-none");
            btn.querySelector(".btn-loading").classList.remove("d-none");
            btn.disabled = true;

            const url = this.dataset.url.replace(
                "/0",
                "/" + document.getElementById("id").value,
            );

            axios
                .put(url, {
                    judul: document.getElementById("edit_judul").value,
                    diskon: document.getElementById("edit_diskon").value,
                    tanggal_mulai:
                        document.getElementById("edit_tanggal_mulai").value,
                    tanggal_selesai: document.getElementById(
                        "edit_tanggal_selesai",
                    ).value,
                })
                .then((response) => {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text:
                            response.data.message ??
                            "Data promo berhasil diperbarui",
                        timer: 1500,
                        showConfirmButton: false,
                    });

                    console.log(response.data.message);

                    modal.hide();
                    setTimeout(() => location.reload(), 1500);
                })
                .catch((error) => {
                    let msg = "Terjadi kesalahan";
                    if (error.response?.status === 422) {
                        if (error.response.data.errors) {
                            msg = Object.values(
                                error.response.data.errors,
                            )[0][0];
                        } else if (error.response.data.message) {
                            msg = error.response.data.message;
                        }
                    } else if (error.response?.data?.message) {
                        msg = error.response.data.message;
                    }
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text:
                            error.response?.data?.message ??
                            "Terjadi kesalahan",
                    });

                    btn.querySelector(".btn-text").classList.remove("d-none");
                    btn.querySelector(".btn-loading").classList.add("d-none");
                    btn.disabled = false;
                });
        });
    }

    // Form Tambah
    const formTambah = document.getElementById("addPromoForm");
    const btnTambah = document.getElementById("btnAddPromo");
    const btnText = btnTambah.querySelector(".btn-text");
    const btnLoading = btnTambah.querySelector(".btn-loading");

    if (formTambah) {
        formTambah.addEventListener("submit", function (e) {
            e.preventDefault();

            btnTambah.disabled = true;
            btnText.classList.add("d-none");
            btnLoading.classList.remove("d-none");

            const formData = new FormData(formTambah);
            const url = formTambah.dataset.url;

            axios
                .post(url, formData)
                .then((res) => {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: res.data.message ?? "Promo berhasil ditambahkan",
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(() => location.reload());
                })
                .catch((err) => {
                    let msg = "Terjadi kesalahan";
                    if (err.response?.status === 422) {
                        if (err.response.data.errors) {
                            msg = Object.values(err.response.data.errors)[0][0];
                        } else if (err.response.data.message) {
                            msg = err.response.data.message;
                        }
                    } else if (err.response?.data?.message) {
                        msg = err.response.data.message;
                    }
                    Swal.fire({ icon: "error", title: "Gagal", text: msg });
                })
                .finally(() => {
                    btnTambah.disabled = false;
                    btnText.classList.remove("d-none");
                    btnLoading.classList.add("d-none");
                });
        });
    }
});

// ✅ FIX: delegation untuk delete
$(document).on("submit", ".form-delete-user", function (e) {
    e.preventDefault();

    const userId = this.dataset.id;

    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Data user akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .delete(`/mitra/promo/${userId}`, {
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                })
                .then((res) => {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: res.data.message,
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(() => {
                        location.reload();
                    });
                })
                .catch(() => {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Data gagal dihapus",
                    });
                });
        }
    });
});
