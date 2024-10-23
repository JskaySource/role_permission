function showLoader() {
    document.getElementById('loader').classList.remove('d-none')
}
function hideLoader() {
    document.getElementById('loader').classList.add('d-none')
}

function successToast(msg) {
    Toastify({
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        text: msg,
        className: "mb-5",
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
          },
    }).showToast();
}

function errorToast(msg) {
    Toastify({
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        text: msg,
        className: "mb-5",
        style: {
           // background: "red",
            background: "linear-gradient(to right, #F45C43, #EB3349)",
           

        }
    }).showToast();
}

