
function createToast(message, type = 'success') {
    const toastContainer = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerText = message;

    toastContainer.appendChild(toast);


    setTimeout(() => {
        toast.remove();
    }, 5000);
}
document.addEventListener('DOMContentLoaded', function() {
    if (window.Laravel.toast.success) {
        createToast(window.Laravel.toast.success, 'success');
    }

    if (window.Laravel.toast.error) {
        createToast(window.Laravel.toast.error, 'error');
    }
});
