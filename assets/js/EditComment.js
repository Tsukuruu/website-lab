const editButtons = document.querySelectorAll('.comment__edit');

for(let btn of editButtons){
    const comment = btn.closest('.comment');
    btn.addEventListener('click', () => {
        comment.querySelector('.comment__edit').style.display = 'none';
        comment.querySelector('.comment__delete').style.display = 'none';
        const formHTML =  `
            <form action="?controller=comment&action=update" method="post" class="form">
                <input type="hidden" name="id" value="${comment.dataset.commentId}">
                <input type="hidden" name="user_id" value="${comment.dataset.userId}">
                <textarea class="form-control" placeholder="Write your comment..." name="text" rows="3" style="resize: none;" required>${comment.querySelector('.comment__text').innerText}</textarea>
                <button type="submit" class="btn btn-sm btn-dark btn float-end my-2">Save</button>
            </form>
        `

        const replacer = document.createElement('div');
        replacer.innerHTML = formHTML;

        comment.querySelector('.comment__text').replaceWith(replacer);
    });
}