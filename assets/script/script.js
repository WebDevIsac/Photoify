const postPhoto = document.querySelectorAll('.post .image-container');
const likeBtn = document.querySelectorAll('.text-container .like-button');
const likeInfo = document.querySelectorAll('.text-container .like-info');

const uploadImage = document.querySelector('.add-form .upload-image');
const uploadInput = document.querySelector('.add-form .upload-input');

const changeImage = document.querySelector('.edit-profile-form .upload-image');
const changeInput = document.querySelector('.edit-profile-form .upload-input');



for (let i = 0; i < postPhoto.length; i++) {
	if (likeInfo[i].innerHTML === 'Like') {
		likeBtn[i].style.backgroundImage = "url('assets/images/svg-images/heart-lines.svg')";
	} else {
		likeBtn[i].style.backgroundImage = "url('assets/images/svg-images/heart-filled.svg')";
		likeBtn[i].style.color = "#F4F4F4";
	}
}

if (document.URL.indexOf("add.php") >= 0){ 
	
	uploadImage.addEventListener('click', () => {
		uploadInput.click();
	});
} 

else if (document.URL.indexOf("edit-profile.php") >= 0) {
	
	changeImage.addEventListener('click', () => {
		changeInput.click();
	});
}

const uploadFile = function(e) {
	uploadImage.src = URL.createObjectURL(e.target.files[0]);
};


const changeFile = function(e) {
	changeImage.src = URL.createObjectURL(e.target.files[0]);
};
