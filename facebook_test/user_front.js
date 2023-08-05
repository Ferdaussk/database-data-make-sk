
// JavaScript to handle the new post create popup functionality
const createPostLink = document.querySelector('.create_a_new_post');
const popupOverlay = document.querySelector('.popup-overlay');
const popupContent = document.querySelector('.popup-content');
const closePopupButton = document.getElementById('closePopup');
createPostLink.addEventListener('click', () => {
    popupOverlay.style.display = 'block';
    popupContent.style.display = 'block';
});
closePopupButton.addEventListener('click', () => {
    popupOverlay.style.display = 'none';
    popupContent.style.display = 'none';
});