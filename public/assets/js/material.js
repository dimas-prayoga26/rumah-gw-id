$(document).ready(function () {
    $("#materialsTable").DataTable({
        responsive: true,
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excelHtml5",
                text: "Export Excel",
                className: "btn btn-success",
                title: "Data Material",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
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
    const modalEl = document.getElementById("editMaterialModal");
    const modal = new bootstrap.Modal(modalEl);
    const form = document.getElementById("editMaterialForm");
    const btn = document.getElementById("btnMaterial");

    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            document.getElementById("id").value = this.dataset.id;
            document.getElementById("namaMaterial").value = this.dataset.nama;
            document.getElementById("harga").value = this.dataset.harga;
            document.getElementById("rasio").value = this.dataset.rasio;

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
            .put(
                `/admin/update-material/${document.getElementById("id").value}`,
                {
                    harga: document.getElementById("harga").value,
                    rasio: document.getElementById("rasio").value,
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                },
            )
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text:
                        response.data.message ??
                        "Data material berhasil diperbarui",
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
                console.log(error.response);

                // reset tombol
                btn.querySelector(".btn-text").classList.remove("d-none");
                btn.querySelector(".btn-loading").classList.add("d-none");
                btn.disabled = false;
            });
    });
});
