// AI tools were used during development to assist developers
// Robert Walters and Thadd McLeod
async function loadModal() {
    const response = await fetch('add_modal.html');
    const html = await response.text();

    const old = document.getElementById('productModal');
    if (old) old.remove();

    document.body.insertAdjacentHTML('beforeend', html);

    const modal = document.getElementById('productModal');
    console.log('Modal element:', modal); // Debug log
    if (modal) {
        modal.classList.add('active');
    }
}

function closeModal() {
    const modal = document.getElementById('productModal');
    if (modal) {
        modal.classList.remove('active');
    }
}

window.onclick = function (e) {
    const modal = document.getElementById('productModal');
    if (modal && e.target === modal) closeModal();
}

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeModal();
});