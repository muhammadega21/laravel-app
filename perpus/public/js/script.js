// Book Cover
$(document).ready(function () {
    const bookCoverImg = $(".cover");
    if (bookCoverImg.length) {
        const src = bookCoverImg.attr("src");
        const url = new URL(src);
        const filename = url.pathname.split("/").pop();
        const format = filename.split(".").pop().toLowerCase();
        if (format === "jpg") {
            bookCoverImg.addClass(
                "border",
                "border-2",
                "border-secondary-subtle",
                "shadow"
            );
        } else if (format === "png") {
            bookCoverImg.removeClass(
                "border",
                "border-2",
                "border-secondary-subtle",
                "shadow"
            );
        }
    }
});

// Search
$(document).ready(function () {
    const searchInput = $("#searchInput");
    const tableRows = $("#dataTable tbody tr");
    const noResultsMessage = $(
        "<tr><td colspan='100%' class='text-center'>No results match your search query</td></tr>"
    );

    searchInput.on("input", function () {
        const searchTerm = searchInput.val().toLowerCase();
        let anyFound = false;

        tableRows.each(function () {
            const rowData = $(this).find("td");
            let found = false;

            rowData.each(function () {
                const cellData = $(this).text().toLowerCase();
                if (cellData.includes(searchTerm)) {
                    found = true;
                    return false;
                }
            });

            if (found) {
                $(this).css("display", "");
                anyFound = true;
            } else {
                $(this).css("display", "none");
            }
        });

        if (!anyFound) {
            $("#dataTable tbody").append(noResultsMessage);
        } else {
            noResultsMessage.remove();
        }
    });
});

// Confirm Delete
function confirm(e) {
    e.preventDefault();
    const url = e.currentTarget.getAttribute("href");

    swal({
        title: "Anda Yakin?",
        text: "Data ini akan dihapus permanent",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((cancel) => {
        if (cancel) {
            window.location.href = url;
        }
    });
}

// Modal Update
$(document).ready(function () {
    $("#updatePetugas").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);
        const petugas = button.data("petugas");
        const idPetugas = petugas.id_petugas;

        $("#updatePetugas form").attr("action", "petugas/update/" + idPetugas);

        $("#name").val(petugas.name);
        $("#username").val(petugas.username);
        $("#email").val(petugas.user.email);
    });

    $("#updateSiswa").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);
        const siswa = button.data("siswa");
        const idSiswa = siswa.id_siswa;

        $("#updateSiswa form").attr("action", "siswa/update/" + idSiswa);

        $("#name").val(siswa.name);
        $("#username").val(siswa.username);
        $("#email").val(siswa.user.email);
        $("#nis").val(siswa.nis);
        $("#kelas_id").val(siswa.kelas_id);
    });

    $("#updateKelas").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);
        const kelas = button.data("kelas");
        const idKelas = kelas.id;

        $("#updateKelas form").attr("action", "kelas/update/" + idKelas);

        $("#nama_kelas").val(kelas.nama_kelas);
        $("#status").val(kelas.status);
    });

    $("#updateRak").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);
        const rak = button.data("rak");
        const idRak = rak.id_rak;

        $("#updateRak form").attr("action", "rak/update/" + idRak);

        $("#nama_rak").val(rak.nama_rak);
        $("#keterangan").val(rak.keterangan);
    });

    $("#updateBuku").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);
        const buku = button.data("buku");
        const slugBuku = buku.slug;

        $("#updateBuku form").attr("action", "buku/update/" + slugBuku);

        $("#judul").val(buku.judul);
        $("#isbn").val(buku.isbn);
        $("#rak_id").val(buku.rak_id);
        $("#sinopsis").val(buku.sinopsis);
        $("#pengarang").val(buku.pengarang);
        $("#penerbit").val(buku.penerbit);
        $("#tahun_terbit").val(buku.tahun_terbit);
        $("#tempat_terbit").val(buku.tempat_terbit);
        $("#jumlah").val(buku.jumlah);
        $("#bahasa").val(buku.bahasa);
        $("#halaman").val(buku.halaman);
    });
});
// End Modal Update
