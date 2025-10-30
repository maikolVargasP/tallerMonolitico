const openModal = document.getElementById('openModal');
const modal = document.getElementById('infoModal');
const closeModal = document.getElementById('closeModal');

openModal.onclick = () => modal.style.display = 'flex';
closeModal.onclick = () => modal.style.display = 'none';
window.onclick = (e) => { if (e.target === modal) modal.style.display = 'none'; }