function confirm(e) {
    e.preventDefault();
    const url = e.currentTarget.getAttribute("href");

    swal({
        title: "Are You Sure?",
        text: "This delete will be premanent",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((cancel) => {
        if (cancel) {
            window.location.href = url;
        }
    });
}

function editTodo(e) {
    const li = e.parentNode.parentNode;
    const inpt = li.querySelector(".inputWrapper input");
    const btnSubmit = li.querySelector(".btnSubmit");
    inpt.disabled = false;
    inpt.select();
    btnSubmit.classList.remove("!hidden");
}
