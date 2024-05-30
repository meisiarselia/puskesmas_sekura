const Alert = Swal.mixin({
    buttonsStyling: false,
    timer: 1250,
    timerProgressBar: true,
    customClass: {
        confirmButton: "btn btn-success mx-1",
        cancelButton: "btn btn-light mx-1",
    },
});
const Question = Swal.mixin({
    buttonsStyling: false,
    icon: "warning",
    showCancelButton: true,
    title: 'Anda yakin?',
    customClass: {
        confirmButton: "btn btn-danger mx-1",
        cancelButton: "btn btn-light mx-1",
    },
});

const Success = Alert.mixin({
    icon: "success",
    title: "Berhasil",
    showConfirmButton: false,
});
const Fails = Alert.mixin({
    icon: "error",
    title: "Gagal",
    showConfirmButton: false,
    didOpen: (swal) => {
        swal.onmouseenter = Alert.stopTimer;
        swal.onmouseleave = Alert.resumeTimer;
    },
});
