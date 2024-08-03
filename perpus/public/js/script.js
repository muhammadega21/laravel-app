// Confirm Delete Image
function confirmDeleteImage(e) {
    e.preventDefault();
    const url = e.currentTarget.getAttribute("href");

    swal({
        title: "Anda Yakin?",
        text: "Foto profil akan kembali ke gambar default",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((cancel) => {
        if (cancel) {
            window.location.href = url;
        }
    });
}

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

// Confirm Logout
function confirmLogout(e) {
    e.preventDefault();
    const url = e.currentTarget.getAttribute("href");

    swal({
        title: "Logout?",
        icon: "warning",
        buttons: true,
        className: "confirmKembali",
    }).then((cancel) => {
        if (cancel) {
            window.location.href = url;
        }
    });
}

// preview image
function previewImage() {
    const image = document.querySelector("#inputImage");
    const preview = document.querySelector("#profilePreview");
    const fileReader = new FileReader();

    fileReader.readAsDataURL(image.files[0]);
    fileReader.onload = function (e) {
        preview.src = e.target.result;
    };
}
