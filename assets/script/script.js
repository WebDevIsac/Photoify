const likeBtn = document.querySelectorAll('.like-container .like-button');
const likes = document.querySelectorAll('.like-container .likes');

for (let i = 0; i < likeBtn.length; i++) {
	likeBtn[i].addEventListener('click', () => {
		if (likeBtn[i].innerHTML === 'Like') {
			likeBtn[i].innerHTML = 'Unlike';
			updatedLikes = parseInt(likes[i].innerHTML);
			updatedLikes++;
			likes[i].innerHTML = updatedLikes;
		} else {
			likeBtn[i].innerHTML = 'Like';
			updatedLikes = parseInt(likes[i].innerHTML);
			updatedLikes--;
			likes[i].innerHTML = updatedLikes;
		}
	});
}

