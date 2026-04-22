const portfolioGrid = document.getElementById("portfolioGrid");
const btnTambahPortfolio = document.getElementById("btnTambahPortfolio");

if (btnTambahPortfolio) {
    btnTambahPortfolio.addEventListener("click", async () => {
        const result = await Swal.fire({
            title: "Tambah Portofolio",
            html: `
                <input type="file" id="swalFileInput" class="form-control" accept="image/*">
                <img id="swalPreview" style="max-width:100%; margin-top:10px; display:none;">
            `,
            showCancelButton: true,
            confirmButtonText: "Upload",
            preConfirm: () => {
                const input = Swal.getPopup().querySelector("#swalFileInput");
                if (!input.files[0]) {
                    Swal.showValidationMessage("Silahkan pilih file gambar!");
                }
                return input.files[0];
            },
            didOpen: () => {
                const input = Swal.getPopup().querySelector("#swalFileInput");
                const preview = Swal.getPopup().querySelector("#swalPreview");
                input.addEventListener("change", () => {
                    if (input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            preview.src = e.target.result;
                            preview.style.display = "block";
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                });
            },
        });

        if (!result.isConfirmed) return;

        const file = result.value;
        const formData = new FormData();
        formData.append("portfolio", file);

        try {
            const res = await axios.post("/mitra/add-portofolio", formData, {
                headers: { "Content-Type": "multipart/form-data" },
            });
            if (res.data.success) {
                Swal.fire("Berhasil!", "Portofolio berhasil ditambahkan.", "success").then(() => location.reload());
            } else {
                Swal.fire("Gagal!", res.data.message || "Terjadi kesalahan", "error");
            }
        } catch (err) {
            Swal.fire("Gagal!", err.response?.data?.message || "Terjadi kesalahan", "error");
        }
    });
}

if (portfolioGrid) {
    portfolioGrid.addEventListener("click", async (event) => {
        const editBtn = event.target.closest(".btnEditPortfolio");
        if (editBtn) {
            const portfolioId = editBtn.dataset.id;
            const fileName = editBtn.dataset.file;
            const namaMitra = editBtn.dataset.nama;

            const result = await Swal.fire({
                title: "Edit Portofolio",
                html: `
                    <input type="file" id="swalEditFileInput" class="form-control" accept="image/*">
                    <img id="swalEditPreview"
                         src="/assets/img/Portfolio/${namaMitra}/${fileName}"
                         style="max-width:100%; margin-top:10px;">
                `,
                showCancelButton: true,
                confirmButtonText: "Update",
                didOpen: () => {
                    const input = document.getElementById("swalEditFileInput");
                    const preview = document.getElementById("swalEditPreview");

                    input.onchange = () => {
                        const file = input.files[0];
                        if (!file) return;

                        const reader = new FileReader();
                        reader.onload = () => {
                            preview.src = reader.result;
                        };
                        reader.readAsDataURL(file);
                    };
                },
                preConfirm: () => {
                    const file = document.getElementById("swalEditFileInput").files[0];
                    if (!file) {
                        Swal.showValidationMessage("Silahkan pilih file gambar baru.");
                        return null;
                    }
                    return file;
                },
            });

            if (!result.isConfirmed) return;

            const formData = new FormData();
            formData.append("id", portfolioId);
            formData.append("portfolio", result.value);
            formData.append("_method", "PUT");

            try {
                Swal.fire({
                    title: "Mengupdate...",
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });

                await axios.post("/mitra/edit-portofolio", formData, {
                    headers: { "Content-Type": "multipart/form-data" },
                });

                await Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Portofolio berhasil diubah",
                });

                location.reload();
            } catch (err) {
                Swal.fire("Gagal!", err.response?.data?.message || "Terjadi kesalahan", "error");
            }

            return;
        }

        const deleteBtn = event.target.closest(".btnDeletePortfolio");
        if (!deleteBtn) return;

        const portfolioId = deleteBtn.dataset.id;

        const result = await Swal.fire({
            title: "Yakin ingin menghapus?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
        });

        if (!result.isConfirmed) return;

        try {
            Swal.fire({
                title: "Menghapus...",
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading(),
            });

            await axios.delete("/mitra/delete-portofolio", {
                data: { id: portfolioId },
            });

            await Swal.fire({
                icon: "success",
                title: "Terhapus!",
                text: "Portofolio berhasil dihapus",
            });

            location.reload();
        } catch (err) {
            Swal.fire("Gagal!", err.response?.data?.message || "Terjadi kesalahan", "error");
        }
    });
}
