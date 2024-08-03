// Input Harga
$(document).ready(function () {
    const hargaInput = $(".formatHarga");

    hargaInput.on("input", function () {
        const inputValue = $(this)
            .val()
            .replace(/[^0-9]/g, "");
        const formattedValue = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
        }).format(inputValue);

        $(this).val(formattedValue);
    });
});

// Select2
$(document).ready(function () {
    $(".select2AddSiswa").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#addSiswa"),
    });

    $(".select2AddRak").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#addBuku"),
    });

    $(".select2AddSiswaPeminjaman").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#addPeminjaman"),
    });
    $(".select2AddBukuPeminjaman").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#addPeminjaman"),
    });

    $(".select2AddIdPengembalian").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#addDenda"),
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

// Confirm Kembali
function confirmKembali(e) {
    e.preventDefault();
    const url = e.currentTarget.getAttribute("href");

    swal({
        title: "Buku Dikembalikan?",
        icon: "warning",
        buttons: true,
        className: "confirmKembali",
    }).then((cancel) => {
        if (cancel) {
            window.location.href = url;
        }
    });
}

// Buku Confirm Complete
function confirmComplete(e) {
    e.preventDefault();
    swal({
        title: "Buku Telah Dikembalikan",
        icon: "success",
        button: "Ok",
    });
}

// Confirm Bayar Denda
function confirmBayar(e) {
    e.preventDefault();
    const url = e.currentTarget.getAttribute("href");

    swal({
        title: "Lunasi Denda?",
        icon: "warning",
        buttons: true,
        className: "confirmKembali",
    }).then((cancel) => {
        if (cancel) {
            window.location.href = url;
        }
    });
}

// Denda Confirm Complete
function dendaComplete(e) {
    e.preventDefault();
    swal({
        title: "Denda Sudah Lunas",
        icon: "success",
        button: "Ok",
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
        $("#kelas_id")
            .val(siswa.kelas_id)
            .select2({
                theme: "bootstrap-5",
                dropdownParent: $("#updateSiswa"),
                placeholder: $(this).data("Pilih Kelas"),
            })[0];
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
        $("#rak_id")
            .val(buku.rak_id)
            .select2({
                theme: "bootstrap-5",
                dropdownParent: $("#updateBuku"),
                placeholder: $(this).data("Pilih Rak"),
            })[0];
        $("#sinopsis").val(buku.sinopsis);
        $("#pengarang").val(buku.pengarang);
        $("#penerbit").val(buku.penerbit);
        $("#tahun_terbit").val(buku.tahun_terbit);
        $("#tempat_terbit").val(buku.tempat_terbit);
        $("#jumlah").val(buku.jumlah);
        $("#bahasa").val(buku.bahasa);
        $("#halaman").val(buku.halaman);
        $("#oldImage").val(buku.image);
    });

    $("#updatePeminjaman").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);
        const peminjaman = button.data("peminjaman");
        const idpeminjaman = peminjaman.id;

        $("#updatePeminjaman form").attr(
            "action",
            "peminjaman/update/" + idpeminjaman
        );

        $("#siswa_id")
            .val(peminjaman.siswa_id)
            .select2({
                theme: "bootstrap-5",
                dropdownParent: $("#updatePeminjaman"),
                placeholder: $(this).data("Pilih Siswa"),
            })[0];
        $("#buku_id")
            .val(peminjaman.buku_id)
            .select2({
                theme: "bootstrap-5",
                dropdownParent: $("#updatePeminjaman"),
                placeholder: $(this).data("Pilih Buku"),
            })[0];
        $("#tgl_pinjam").val(peminjaman.tgl_pinjam);
        $("#tgl_kembali").val(peminjaman.tgl_kembali);
    });

    $("#updateDenda").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);
        const denda = button.data("denda");
        const idDenda = denda.id;

        $("#updateDenda form").attr("action", "denda/update/" + idDenda);

        $("#nama_denda").val(denda.nama_denda);
        $("#biaya_denda").val(denda.biaya_denda);
    });

    $("#updateDenda").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);
        const denda = button.data("denda");
        const idDenda = denda.id_denda;

        // Format Harga
        const hargaInput = $("#biaya_denda");
        const inputValue = hargaInput.val().replace(/[^0-9]/g, "");
        const formattedValue = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
        }).format(inputValue);

        $("#updateDenda form").attr("action", "denda/update/" + idDenda);

        $("#pengembalian_id")
            .append(
                `<option value="${denda.pengembalian_id}">${denda.pengembalian.id_kembali} - ${denda.pengembalian.siswa.name}</option>`
            )
            .val(denda.pengembalian_id)
            .select2({
                theme: "bootstrap-5",
                dropdownParent: $("#updateDenda"),
            })[0];
        $("#nama_denda").val(denda.nama_denda);
        hargaInput.val(formattedValue);
    });
});
// End Modal Update
