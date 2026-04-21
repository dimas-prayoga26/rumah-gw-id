function getRABDataFromDOM() {
    const rows = document.querySelectorAll("#table-rab tbody tr");

    let data = [];

    rows.forEach((row, index) => {
        const cells = row.querySelectorAll("td");

        if (cells.length >= 4) {
            const volume = cells[2].querySelector(".volume")?.innerText.trim();
            const unit = cells[2].querySelector(".unit")?.innerText.trim();

            const volumeWithUnit = unit ? `${unit} ${volume}` : volume;

            data.push({
                no: index + 1,
                pekerjaan: cells[1].innerText.trim(),
                volume: volumeWithUnit,
                jumlah_harga:
                    parseInt(cells[3].innerText.replace(/[^\d]/g, ""), 10) || 0,
            });
        }
    });

    // const konsep =
    //     parseInt(
    //         document
    //             .getElementById("konsep-biaya")
    //             .innerText.replace(/[^\d]/g, ""),
    //         10,
    //     ) || 0;
    const total =
        parseInt(
            document
                .getElementById("tot-biaya")
                .innerText.replace(/[^\d]/g, ""),
            10,
        ) || 0;

    data.push({
        // konsep_biaya: konsep,
        total_biaya: total,
    });

    return data;
}

function printRAB() {
    const rabData = getRABDataFromDOM();

    const csrf = document.querySelector("meta[name='csrf-token']").content;

    const btn = document.getElementById("print-btn");
    const btnText = btn.querySelector(".btn-text");
    const btnLoading = btn.querySelector(".btn-loading");

    btn.disabled = true;
    btnText.classList.add("d-none");
    btnLoading.classList.remove("d-none");

    // console.log(rabData);
    fetch("/preview-rab", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf,
        },
        body: JSON.stringify({
            rab: rabData,
        }),
    })
        .then((res) => res.blob())
        .then((blob) => {
            btn.disabled = false;
            btnText.classList.remove("d-none");
            btnLoading.classList.add("d-none");

            const url = URL.createObjectURL(blob);
            window.open(url, "_blank");
        })
        .catch((err) => {
            // console.log(err);
            btn.disabled = false;
            btnText.classList.remove("d-none");
            btnLoading.classList.add("d-none");
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "Terjadi kesalahan",
            });
        });
}

function sendRAB() {
    const form = document.getElementById("send-rab-form");
    if (form) {
        form.addEventListener("submit", function (e) {
            const btn = document.getElementById("email-btn");
            const btnText = btn.querySelector(".btn-text");
            const btnLoading = btn.querySelector(".btn-loading");

            btn.disabled = true;
            btnText.classList.add("d-none");
            btnLoading.classList.remove("d-none");

            e.preventDefault();

            const rabData = getRABDataFromDOM();
            const url = this.dataset.url;

            axios
                .post(
                    url,
                    {
                        rab: rabData,
                    },
                    {
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                "meta[name='csrf-token']",
                            ).content,
                        },
                    },
                )
                .then((response) => {
                    if (response.data.status) {
                        btn.disabled = false;
                        btnText.classList.remove("d-none");
                        btnLoading.classList.add("d-none");

                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Email sudah terkirim!",
                            showConfirmButton: false,
                            timer: 1500,
                            showProgressBar: true,
                        });
                    } else {
                        btn.disabled = false;
                        btnText.classList.remove("d-none");
                        btnLoading.classList.add("d-none");

                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Silahkan login terlebih dahulu!",
                            showConfirmButton: false,
                            timer: 1500,
                            showProgressBar: true,
                        }).then(() => {
                            window.location.href = "/login";
                        });
                    }
                })
                .catch((error) => {
                    btn.disabled = false;
                    btnText.classList.remove("d-none");
                    btnLoading.classList.add("d-none");

                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Email gagal terkirim!",
                        showConfirmButton: false,
                        timer: 1500,
                        showProgressBar: true,
                    });

                    // console.log(error.response);
                });
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    sendRAB();
});
