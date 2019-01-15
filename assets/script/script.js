const postPhoto = document.querySelectorAll('.post .image-container');
const likeBtn = document.querySelectorAll('.text-container .like-button');
const likeInfo = document.querySelectorAll('.text-container .like-info');

const uploadImage = document.querySelector('.add-form .upload-image');
const uploadInput = document.querySelector('.add-form .upload-input');



for (let i = 0; i < postPhoto.length; i++) {
	if (likeInfo[i].innerHTML === 'Like') {
		likeBtn[i].style.backgroundImage = "url('assets/images/svg-images/heart-lines.svg')";
	} else {
		likeBtn[i].style.backgroundImage = "url('assets/images/svg-images/heart-filled.svg')";
		likeBtn[i].style.color = "#F4F4F4";
	}
}

// uploadImage.addEventListener('click', () => {
// 	uploadInput.click();
// });

// window.onload = () => {

// 	if (uploadInput.value) {
// 		console.log('Input has value');
		
// 		uploadImage.scroll(uploadInput.value);
// 	}
// }


