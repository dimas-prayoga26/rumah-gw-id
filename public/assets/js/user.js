$(document).ready(function () {
    $("#usersTable").DataTable({
        responsive: true,
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excelHtml5",
                text: "Export Excel",
                className: "btn btn-success",
                title: "Data User",
                exportOptions: {
                    columns: [0, 1, 2, 3], // hanya ID, Nama, Email, Role
                    format: {
                        body: function (data, row, column, node) {
                            // Hapus semua HTML, ambil hanya teks
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
    const editButtons = document.querySelectorAll(".btn-edit");
    const modalEl = document.getElementById("editUserModal");
    const modal = new bootstrap.Modal(modalEl);
    const form = document.getElementById("editUserForm");
    const btn = document.getElementById("btnUser");

    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            document.getElementById("id").value = this.dataset.id;
            document.getElementById("namaUser").value = this.dataset.nama;
            document.getElementById("emailUser").value = this.dataset.email;

            modal.show();
        });
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        // loading state
        btn.querySelector(".btn-text").classList.add("d-none");
        btn.querySelector(".btn-loading").classList.remove("d-none");
        btn.disabled = true;

        axios
            .put(`/admin/edit-user/${document.getElementById("id").value}`, {
                namaUser: document.getElementById("namaUser").value,
                emailUser: document.getElementById("emailUser").value,
            })
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text:
                        response.data.message ??
                        "Data user berhasil diperbarui",
                    timer: 1500,
                    showConfirmButton: false,
                });

                modal.hide();
                setTimeout(() => location.reload(), 1500);
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: error.response?.data?.message ?? "Terjadi kesalahan",
                });
                // console.log(error);

                // reset tombol
                btn.querySelector(".btn-text").classList.remove("d-none");
                btn.querySelector(".btn-loading").classList.add("d-none");
                btn.disabled = false;
            });
    });

    // Form Tambah
    const formTambah = document.getElementById("addUserForm");
    const btnTambah = document.getElementById("btnTambahUser");
    const btnText = btnTambah.querySelector(".btn-text");
    const btnLoading = btnTambah.querySelector(".btn-loading");

    formTambah.addEventListener("submit", function (e) {
        e.preventDefault();

        btnTambah.disabled = true;
        btnText.classList.add("d-none");
        btnLoading.classList.remove("d-none");

        const formData = new FormData(formTambah);

        axios
            .post("/admin/tambah-user", formData)
            .then((res) => {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.data.message ?? "User berhasil ditambahkan",
                    timer: 1500,
                    showConfirmButton: false,
                }).then(() => location.reload());
            })
            .catch((err) => {
                let msg = "Terjadi kesalahan";
                if (err.response?.status === 422) {
                    msg = Object.values(err.response.data.errors)[0][0];
                }
                Swal.fire({ icon: "error", title: "Gagal", text: msg });
            })
            .finally(() => {
                btnTambah.disabled = false;
                btnText.classList.remove("d-none");
                btnLoading.classList.add("d-none");
            });
    });
});

document.querySelectorAll(".form-delete-user").forEach((form) => {
    form.addEventListener("submit", function (e) {
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
                    .delete(`/admin/hapus-user/${userId}`, {
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
                            location.reload(); // atau hapus row tabel
                        });
                    })
                    .catch((err) => {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Data gagal dihapus",
                        });
                        // console.log(err);
                    });
            }
        });
    });
});
