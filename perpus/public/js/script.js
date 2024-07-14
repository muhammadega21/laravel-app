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
