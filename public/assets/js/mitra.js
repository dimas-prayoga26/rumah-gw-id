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
        if (!el) return;
        el.addEventListener("input", function () {
            let value = this.value.replace(/[^0-9]/g, "");
            this.value = value
                ? "Rp " + Number(value).toLocaleString("id-ID")
                : "";
        });
    }

    function initPortfolioDropzone(config) {
        const dropzoneEl = document.getElementById(config.dropzoneId);
        const inputEl = document.getElementById(config.inputId);
        const previewEl = document.getElementById(config.previewId);
        const maxFiles = 20;

        if (!dropzoneEl || !inputEl || !previewEl) {
            return {
                clear: () => {},
            };
        }

        let portfolioFiles = [];

        function syncInputFiles() {
            const dt = new DataTransfer();
            portfolioFiles.forEach((file) => dt.items.add(file));
            inputEl.files = dt.files;
        }

        function bytesToMB(bytes) {
            return `${(bytes / (1024 * 1024)).toFixed(2)} MB`;
        }

        function renderPreview() {
            previewEl.innerHTML = "";

            portfolioFiles.forEach((file, index) => {
                const col = document.createElement("div");
                col.className = "col-md-2 col-4";

                const card = document.createElement("div");
                card.className = "portfolio-preview-card";

                const img = document.createElement("img");
                img.alt = file.name;
                img.src = URL.createObjectURL(file);
                img.onload = () => URL.revokeObjectURL(img.src);

                const removeBtn = document.createElement("button");
                removeBtn.type = "button";
                removeBtn.className = "btn btn-sm btn-danger btn-remove-portfolio-image";
                removeBtn.setAttribute("data-index", String(index));
                removeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';

                const info = document.createElement("div");
                info.className = "p-2 small text-truncate";
                info.title = file.name;
                info.textContent = file.name;

                const sizeInfo = document.createElement("small");
                sizeInfo.className = "text-muted d-block pb-2 px-2";
                sizeInfo.textContent = bytesToMB(file.size);

                card.appendChild(img);
                card.appendChild(removeBtn);
                card.appendChild(info);
                card.appendChild(sizeInfo);
                col.appendChild(card);
                previewEl.appendChild(col);
            });
        }

        function pushFiles(fileList) {
            const files = Array.from(fileList || []);
            if (!files.length) return;

            const allowedTypes = ["image/jpeg", "image/png", "image/webp"];
            const currentSignatures = new Set(
                portfolioFiles.map((f) => `${f.name}_${f.size}_${f.lastModified}`),
            );

            let rejectedType = 0;
            let rejectedSize = 0;

            files.forEach((file) => {
                if (!allowedTypes.includes(file.type)) {
                    rejectedType += 1;
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    rejectedSize += 1;
                    return;
                }

                if (portfolioFiles.length >= maxFiles) {
                    return;
                }

                const sig = `${file.name}_${file.size}_${file.lastModified}`;
                if (currentSignatures.has(sig)) {
                    return;
                }

                currentSignatures.add(sig);
                portfolioFiles.push(file);
            });

            if (files.length && portfolioFiles.length >= maxFiles) {
                Swal.fire({
                    icon: "warning",
                    title: "Batas upload",
                    text: `Maksimal ${maxFiles} gambar portofolio.`,
                });
            }

            if (rejectedType > 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Format tidak valid",
                    text: "Hanya file JPG, JPEG, PNG, dan WEBP yang diperbolehkan.",
                });
            }

            if (rejectedSize > 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Ukuran terlalu besar",
                    text: "Ukuran maksimal tiap file adalah 2MB.",
                });
            }

            syncInputFiles();
            renderPreview();
        }

        dropzoneEl.addEventListener("click", () => {
            // Reset value first so selecting the same file again still fires change.
            inputEl.value = "";
            inputEl.click();
        });

        inputEl.addEventListener("change", (event) => {
            pushFiles(event.target.files);
        });

        dropzoneEl.addEventListener("dragover", (event) => {
            event.preventDefault();
            dropzoneEl.classList.add("is-dragover");
        });

        dropzoneEl.addEventListener("dragleave", () => {
            dropzoneEl.classList.remove("is-dragover");
        });

        dropzoneEl.addEventListener("drop", (event) => {
            event.preventDefault();
            dropzoneEl.classList.remove("is-dragover");
            pushFiles(event.dataTransfer?.files || []);
        });

        previewEl.addEventListener("click", (event) => {
            const btn = event.target.closest(".btn-remove-portfolio-image");
            if (!btn) return;
            const index = Number(btn.getAttribute("data-index"));
            if (Number.isNaN(index)) return;

            portfolioFiles = portfolioFiles.filter((_, i) => i !== index);
            syncInputFiles();
            renderPreview();
        });

        return {
            getFiles: () => [...portfolioFiles],
            clear: () => {
                portfolioFiles = [];
                syncInputFiles();
                renderPreview();
                inputEl.value = "";
            },
        };
    }

    const WILAYAH_API_BASE = "/api/wilayah";
    const PAGE_SIZE = 5;

    function initWilayahSelect2($el, config) {
        $el.select2({
            width: "100%",
            allowClear: true,
            placeholder: config.placeholder,
            dropdownParent: config.dropdownParent,
            ajax: {
                delay: 250,
                url: function () {
                    if (!config.getUrl) return "";
                    return config.getUrl();
                },
                dataType: "json",
                data: function (params) {
                    return {
                        q: params.term || "",
                        page: params.page || 1,
                        per_page: PAGE_SIZE,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.results || [],
                        pagination: {
                            more: data?.pagination?.more || false,
                        },
                    };
                },
                transport: function (params, success, failure) {
                    if (!params.url) {
                        success({ results: [], pagination: { more: false } });
                        return null;
                    }

                    const request = $.ajax(params);
                    request.then(success);
                    request.fail(function (xhr, textStatus) {
                        // Select2 will abort previous requests while user types.
                        // Do not treat aborted requests as real errors.
                        if (textStatus === "abort" || xhr?.statusText === "abort") {
                            return;
                        }

                        failure();
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: xhr?.status === 401 || xhr?.status === 419
                                ? "Sesi login habis. Silakan refresh halaman lalu login kembali."
                                : "Data lokasi tidak bisa dimuat.",
                        });
                    });
                    return request;
                },
            },
        });
    }

    function disableSelect2($el, disabled) {
        $el.prop("disabled", disabled).trigger("change.select2");
    }

    function clearSelect2($el) {
        $el.val(null);
        $el.find("option:not(:first)").remove();
        $el.trigger("change");
    }

    function getSelectedText($el) {
        const data = $el.select2("data");
        return data && data[0] ? data[0].text : "";
    }

    function normalizeText(value) {
        return String(value || "")
            .trim()
            .toLowerCase()
            .replace(/\s+/g, " ");
    }

    async function findWilayahOption(url, keyword) {
        if (!url || !keyword) return null;

        try {
            const response = await $.ajax({
                url,
                dataType: "json",
                data: {
                    q: keyword,
                    page: 1,
                    per_page: 50,
                },
            });

            const results = response?.results || [];
            if (!results.length) return null;

            const target = normalizeText(keyword);
            return (
                results.find((item) => normalizeText(item.text) === target) ||
                results.find((item) =>
                    normalizeText(item.text).includes(target) ||
                    target.includes(normalizeText(item.text)),
                ) ||
                results[0]
            );
        } catch (error) {
            return null;
        }
    }

    function bindLokasiCascade(config) {
        const $provinsi = $(`#${config.provinsiId}`);
        const $kabupaten = $(`#${config.kabupatenId}`);
        const $kecamatan = $(`#${config.kecamatanId}`);
        const $desa = $(`#${config.desaId}`);
        const $hiddenLokasi = $(`#${config.hiddenLokasiId}`);
        const $hiddenProvinsi = config.hiddenProvinsiId ? $(`#${config.hiddenProvinsiId}`) : null;
        const $hiddenKabupaten = config.hiddenKabupatenId ? $(`#${config.hiddenKabupatenId}`) : null;
        const $hiddenKecamatan = config.hiddenKecamatanId ? $(`#${config.hiddenKecamatanId}`) : null;
        const $hiddenDesa = config.hiddenDesaId ? $(`#${config.hiddenDesaId}`) : null;
        const $currentText = config.currentTextId ? $(`#${config.currentTextId}`) : null;
        const $dropdownParent = $(`#${config.dropdownParentId}`);
        let isPrefilling = false;

        if (
            !$provinsi.length ||
            !$kabupaten.length ||
            !$kecamatan.length ||
            !$desa.length ||
            !$hiddenLokasi.length
        ) {
            return null;
        }

        initWilayahSelect2($provinsi, {
            placeholder: "Pilih Provinsi",
            dropdownParent: $dropdownParent,
            getUrl: () => `${WILAYAH_API_BASE}/provinces`,
        });

        initWilayahSelect2($kabupaten, {
            placeholder: "Pilih Kabupaten/Kota",
            dropdownParent: $dropdownParent,
            getUrl: () => {
                const provinceCode = $provinsi.val();
                return provinceCode ? `${WILAYAH_API_BASE}/regencies/${provinceCode}` : "";
            },
        });

        initWilayahSelect2($kecamatan, {
            placeholder: "Pilih Kecamatan",
            dropdownParent: $dropdownParent,
            getUrl: () => {
                const regencyCode = $kabupaten.val();
                return regencyCode ? `${WILAYAH_API_BASE}/districts/${regencyCode}` : "";
            },
        });

        initWilayahSelect2($desa, {
            placeholder: "Pilih Desa/Kelurahan",
            dropdownParent: $dropdownParent,
            getUrl: () => {
                const districtCode = $kecamatan.val();
                return districtCode ? `${WILAYAH_API_BASE}/villages/${districtCode}` : "";
            },
        });

        disableSelect2($kabupaten, true);
        disableSelect2($kecamatan, true);
        disableSelect2($desa, true);

        function setSelectedOption($el, item) {
            if (!$el || !$el.length || !item) return;

            const optionId = item.id ?? item.code ?? "";
            const optionText = item.text ?? item.name ?? "";
            if (!optionId || !optionText) return;

            if (!$el.find(`option[value="${optionId}"]`).length) {
                $el.append(new Option(optionText, optionId, true, true));
            }

            $el.val(optionId).trigger("change");
        }

        function resetChildren(level) {
            if (level === "provinsi") {
                clearSelect2($kabupaten);
                clearSelect2($kecamatan);
                clearSelect2($desa);
                disableSelect2($kabupaten, !$provinsi.val());
                disableSelect2($kecamatan, true);
                disableSelect2($desa, true);
            }

            if (level === "kabupaten") {
                clearSelect2($kecamatan);
                clearSelect2($desa);
                disableSelect2($kecamatan, !$kabupaten.val());
                disableSelect2($desa, true);
            }

            if (level === "kecamatan") {
                clearSelect2($desa);
                disableSelect2($desa, !$kecamatan.val());
            }

            if (config.clearHiddenOnLevelChange) {
                $hiddenLokasi.val("");
                if ($hiddenProvinsi && $hiddenProvinsi.length) $hiddenProvinsi.val("");
                if ($hiddenKabupaten && $hiddenKabupaten.length) $hiddenKabupaten.val("");
                if ($hiddenKecamatan && $hiddenKecamatan.length) $hiddenKecamatan.val("");
                if ($hiddenDesa && $hiddenDesa.length) $hiddenDesa.val("");
                if ($currentText && $currentText.length) {
                    $currentText.text("Lokasi saat ini: -");
                }
            }
        }

        function updateHiddenLokasi() {
            const prov = getSelectedText($provinsi);
            const kab = getSelectedText($kabupaten);
            const kec = getSelectedText($kecamatan);
            const des = getSelectedText($desa);

            if (prov && kab && kec && des) {
                const lokasi = `${des}, ${kec}, ${kab}, ${prov}`;
                $hiddenLokasi.val(lokasi);
                if ($hiddenProvinsi && $hiddenProvinsi.length) $hiddenProvinsi.val(prov);
                if ($hiddenKabupaten && $hiddenKabupaten.length) $hiddenKabupaten.val(kab);
                if ($hiddenKecamatan && $hiddenKecamatan.length) $hiddenKecamatan.val(kec);
                if ($hiddenDesa && $hiddenDesa.length) $hiddenDesa.val(des);
                if ($currentText && $currentText.length) {
                    $currentText.text(`Lokasi saat ini: ${lokasi}`);
                }
            }
        }

        $provinsi.on("change", function () {
            if (isPrefilling) return;
            resetChildren("provinsi");
        });

        $kabupaten.on("change", function () {
            if (isPrefilling) return;
            resetChildren("kabupaten");
        });

        $kecamatan.on("change", function () {
            if (isPrefilling) return;
            resetChildren("kecamatan");
        });

        $desa.on("change", function () {
            if (isPrefilling) return;
            if (!$desa.val()) {
                if (config.clearHiddenOnLevelChange) {
                    $hiddenLokasi.val("");
                }
                return;
            }
            updateHiddenLokasi();
        });

        async function prefillByNames(names = {}) {
            const provinsiName = String(names.provinsi || "").trim();
            const kabupatenName = String(names.kabupaten || "").trim();
            const kecamatanName = String(names.kecamatan || "").trim();
            const desaName = String(names.desa || "").trim();

            if (!provinsiName || !kabupatenName || !kecamatanName || !desaName) {
                return false;
            }

            isPrefilling = true;

            try {
                const provinsiOpt = await findWilayahOption(
                    `${WILAYAH_API_BASE}/provinces`,
                    provinsiName,
                );
                if (!provinsiOpt) return false;
                setSelectedOption($provinsi, provinsiOpt);

                disableSelect2($kabupaten, false);
                const kabupatenOpt = await findWilayahOption(
                    `${WILAYAH_API_BASE}/regencies/${provinsiOpt.id}`,
                    kabupatenName,
                );
                if (!kabupatenOpt) return false;
                setSelectedOption($kabupaten, kabupatenOpt);

                disableSelect2($kecamatan, false);
                const kecamatanOpt = await findWilayahOption(
                    `${WILAYAH_API_BASE}/districts/${kabupatenOpt.id}`,
                    kecamatanName,
                );
                if (!kecamatanOpt) return false;
                setSelectedOption($kecamatan, kecamatanOpt);

                disableSelect2($desa, false);
                const desaOpt = await findWilayahOption(
                    `${WILAYAH_API_BASE}/villages/${kecamatanOpt.id}`,
                    desaName,
                );
                if (!desaOpt) return false;
                setSelectedOption($desa, desaOpt);

                updateHiddenLokasi();
                return true;
            } finally {
                isPrefilling = false;
            }
        }

        return {
            hiddenLokasi: $hiddenLokasi,
            hiddenProvinsi: $hiddenProvinsi,
            hiddenKabupaten: $hiddenKabupaten,
            hiddenKecamatan: $hiddenKecamatan,
            hiddenDesa: $hiddenDesa,
            currentTextEl: $currentText,
            prefillByNames,
            clearSelection: () => {
                clearSelect2($provinsi);
                clearSelect2($kabupaten);
                clearSelect2($kecamatan);
                clearSelect2($desa);
                disableSelect2($kabupaten, true);
                disableSelect2($kecamatan, true);
                disableSelect2($desa, true);
                $hiddenLokasi.val("");
                if ($hiddenProvinsi && $hiddenProvinsi.length) $hiddenProvinsi.val("");
                if ($hiddenKabupaten && $hiddenKabupaten.length) $hiddenKabupaten.val("");
                if ($hiddenKecamatan && $hiddenKecamatan.length) $hiddenKecamatan.val("");
                if ($hiddenDesa && $hiddenDesa.length) $hiddenDesa.val("");
                if ($currentText && $currentText.length) {
                    $currentText.text("Lokasi saat ini: -");
                }
            },
        };
    }

    const lokasiTambah = bindLokasiCascade({
        provinsiId: "provinsiMitraTambah",
        kabupatenId: "kabupatenMitraTambah",
        kecamatanId: "kecamatanMitraTambah",
        desaId: "desaMitraTambah",
        hiddenLokasiId: "lokasiMitraTambah",
        hiddenProvinsiId: "provinsiMitraTambahHidden",
        hiddenKabupatenId: "kabupatenMitraTambahHidden",
        hiddenKecamatanId: "kecamatanMitraTambahHidden",
        hiddenDesaId: "desaMitraTambahHidden",
        dropdownParentId: "addMitraModal",
        clearHiddenOnLevelChange: true,
    });

    const lokasiEdit = bindLokasiCascade({
        provinsiId: "provinsiMitraEdit",
        kabupatenId: "kabupatenMitraEdit",
        kecamatanId: "kecamatanMitraEdit",
        desaId: "desaMitraEdit",
        hiddenLokasiId: "lokasiMitraEdit",
        hiddenProvinsiId: "provinsiMitraEditHidden",
        hiddenKabupatenId: "kabupatenMitraEditHidden",
        hiddenKecamatanId: "kecamatanMitraEditHidden",
        hiddenDesaId: "desaMitraEditHidden",
        currentTextId: "lokasiLamaText",
        dropdownParentId: "editMitraModal",
        clearHiddenOnLevelChange: true,
    });

    const portfolioDropzoneAdd = initPortfolioDropzone({
        dropzoneId: "portfolioDropzone",
        inputId: "portfolioImagesInput",
        previewId: "portfolioPreviewGrid",
    });
    const portfolioDropzoneEdit = initPortfolioDropzone({
        dropzoneId: "portfolioDropzoneEdit",
        inputId: "portfolioImagesInputEdit",
        previewId: "portfolioPreviewGridEdit",
    });
    const existingPortfolioPreviewEl = document.getElementById(
        "existingPortfolioPreviewGrid",
    );

    function renderExistingPortfolioPreview(files = [], mitraName = "") {
        if (!existingPortfolioPreviewEl) return;

        existingPortfolioPreviewEl.innerHTML = "";

        if (!Array.isArray(files) || files.length === 0) {
            existingPortfolioPreviewEl.innerHTML =
                '<div class="col-12"><small class="text-muted">Belum ada image portofolio.</small></div>';
            return;
        }

        files.forEach((filename) => {
            if (!filename) return;

            const col = document.createElement("div");
            col.className = "col-md-2 col-4";

            const card = document.createElement("div");
            card.className = "portfolio-preview-card";

            const img = document.createElement("img");
            const encodedMitraName = encodeURIComponent(String(mitraName || ""));
            const encodedFile = encodeURIComponent(String(filename));
            img.src = `/assets/img/Portfolio/${encodedMitraName}/${encodedFile}`;
            img.alt = String(filename);
            img.loading = "lazy";

            const info = document.createElement("div");
            info.className = "p-2 small text-truncate";
            info.title = String(filename);
            info.textContent = String(filename);

            card.appendChild(img);
            card.appendChild(info);
            col.appendChild(card);
            existingPortfolioPreviewEl.appendChild(col);
        });
    }

    $("#addMitraModal").on("hidden.bs.modal", function () {
        if (lokasiTambah) lokasiTambah.clearSelection();
        if (portfolioDropzoneAdd) portfolioDropzoneAdd.clear();
    });

    $("#editMitraModal").on("hidden.bs.modal", function () {
        if (lokasiEdit) lokasiEdit.clearSelection();
        if (portfolioDropzoneEdit) portfolioDropzoneEdit.clear();
        renderExistingPortfolioPreview([], "");
    });

    formatRupiahInput(document.getElementById("hargaMitraTambah"));
    formatRupiahInput(document.getElementById("hargaMitraEdit"));

    // Open Edit Modal
    $(".btn-edit-mitra").click(function () {
        const modal = new bootstrap.Modal(
            document.getElementById("editMitraModal"),
        );
        if (portfolioDropzoneEdit) portfolioDropzoneEdit.clear();
        $("#id").val($(this).data("id"));
        $("#namaMitraEdit").val($(this).data("nama"));
        $("#emailMitraEdit").val($(this).data("email"));
        $("#alamatMitraEdit").val($(this).data("alamat"));
        $("#whatsappMitraEdit").val($(this).data("whatsapp"));
        $("#hargaMitraEdit").val(
            "Rp " + Number($(this).data("harga")).toLocaleString("id-ID"),
        );

        if (lokasiEdit) {
            lokasiEdit.clearSelection();
            const lokasiRaw = String($(this).data("lokasi") || "");
            lokasiEdit.hiddenLokasi.val(lokasiRaw);
            const lokasiParts = lokasiRaw
                .split(",")
                .map((item) => item.trim());

            const selectedNames = {
                desa: String($(this).data("desa") || lokasiParts[0] || "").trim(),
                kecamatan: String($(this).data("kecamatan") || lokasiParts[1] || "").trim(),
                kabupaten: String($(this).data("kabupaten") || lokasiParts[2] || "").trim(),
                provinsi: String($(this).data("provinsi") || lokasiParts[3] || "").trim(),
            };

            if (lokasiEdit.hiddenDesa && lokasiEdit.hiddenDesa.length) lokasiEdit.hiddenDesa.val(selectedNames.desa);
            if (lokasiEdit.hiddenKecamatan && lokasiEdit.hiddenKecamatan.length) lokasiEdit.hiddenKecamatan.val(selectedNames.kecamatan);
            if (lokasiEdit.hiddenKabupaten && lokasiEdit.hiddenKabupaten.length) lokasiEdit.hiddenKabupaten.val(selectedNames.kabupaten);
            if (lokasiEdit.hiddenProvinsi && lokasiEdit.hiddenProvinsi.length) lokasiEdit.hiddenProvinsi.val(selectedNames.provinsi);

            if (lokasiEdit.currentTextEl) {
                lokasiEdit.currentTextEl.text("Lokasi saat ini: memuat pilihan...");
            }

            lokasiEdit.prefillByNames(selectedNames).then((isPrefilled) => {
                if (!isPrefilled && lokasiEdit.currentTextEl) {
                    lokasiEdit.currentTextEl.text(`Lokasi saat ini: ${lokasiRaw || "-"}`);
                }
            });
        }

        $('#editMitraModal select[name="keahlianMitra"]').val(
            $(this).data("keahlian"),
        );
        $('#editMitraModal textarea[name="deskripsiMitra"]').val(
            $(this).data("deskripsi"),
        );

        const rawPortfolios = $(this).attr("data-portfolios");
        let portfolioFiles = [];
        if (rawPortfolios) {
            try {
                portfolioFiles = JSON.parse(rawPortfolios);
            } catch (error) {
                portfolioFiles = [];
            }
        }

        renderExistingPortfolioPreview(portfolioFiles, $(this).data("nama"));
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
        if (
            portfolioDropzoneEdit &&
            typeof portfolioDropzoneEdit.getFiles === "function"
        ) {
            const selectedFiles = portfolioDropzoneEdit.getFiles();
            formData.delete("portfolioImages[]");
            formData.delete("portfolioImages");
            selectedFiles.forEach((file) => {
                formData.append("portfolioImages[]", file);
            });
        }
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

        const lokasiValue = $("#lokasiMitraTambah").val();
        if (!lokasiValue) {
            Swal.fire({
                icon: "warning",
                title: "Lokasi belum lengkap",
                text: "Pilih lokasi sampai level desa/kelurahan dulu.",
            });
            return;
        }

        const btn = $("#btnTambahMitra");
        btn.prop("disabled", true);
        btn.find(".btn-text").addClass("d-none");
        btn.find(".btn-loading").removeClass("d-none");

        const formData = new FormData(this);

        if (
            portfolioDropzoneAdd &&
            typeof portfolioDropzoneAdd.getFiles === "function"
        ) {
            const selectedFiles = portfolioDropzoneAdd.getFiles();
            formData.delete("portfolioImages[]");
            formData.delete("portfolioImages");
            selectedFiles.forEach((file) => {
                formData.append("portfolioImages[]", file);
            });
        }

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
