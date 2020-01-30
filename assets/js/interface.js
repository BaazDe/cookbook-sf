import '../css/interface.scss';

const addingCard = document.getElementById('add-item');
const addForm = document.getElementById('js-form-add');

const closeAddFormBtn = document.getElementById('close-add-form');

addingCard.addEventListener('click', () => {
    addForm.classList.toggle('closed');
});

closeAddFormBtn.addEventListener('click', () => {
    addForm.classList.add('closed');
});
