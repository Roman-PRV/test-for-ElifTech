import Swal from "sweetalert2";

export function askPermission() {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            return true;
        } else {
            return false;
        }
    });
}
