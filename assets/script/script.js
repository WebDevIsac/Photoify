const postPhoto = document.querySelectorAll('.post .image-container');
const likeBtn = document.querySelectorAll('.like-container .like-button');
const likes = document.querySelectorAll('.like-container .likes');

for (let i = 0; i < postPhoto.length; i++) {
	likeBtn[i].addEventListener('click', () => {
		if (likeBtn[i].innerHTML === 'Like') {
			likeBtn[i].innerHTML = 'Unlike';
			updatedLikes = parseInt(likes[i].innerHTML);
			updatedLikes++;
			updatedLikes = updatedLikes.toString();
			likes[i].innerHTML = updatedLikes + ' likes';
		} else {
			likeBtn[i].innerHTML = 'Like';
			updatedLikes = parseInt(likes[i].innerHTML);
			updatedLikes--;
			updatedLikes = updatedLikes.toString();
			likes[i].innerHTML = updatedLikes + ' likes';
		}
	});
}

