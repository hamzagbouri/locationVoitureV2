let params = new URLSearchParams(document.location.search);
let articleId= params.get("article_id")
const addCommentForme = document.getElementById('addcommentForm')
const commentContainer = document.getElementById('comment-container')
const articleContainer = document.getElementById('article-container')
const clientId = document.getElementById('clientId').value
console.log(clientId)
let allComments;
let totalComments =0
let currentEditCommentId = null;

function showEditModal(commentId) {
    currentEditCommentId = commentId;
    let commentToEdit;
   allComments.forEach(co => {
    if(co.id == currentEditCommentId)
    {
        commentToEdit = co;
    }
   })
    console.log(currentEditCommentId)
    document.getElementById('editCommentTextarea').value = commentToEdit.Commantaire;

   
    document.getElementById('editCommentModal').classList.remove('hidden');
}

function hideEditModal() {
    currentEditCommentId = null;
    document.getElementById('editCommentModal').classList.add('hidden');
}

function deleteComment(comId)
 {
    fetch(`../../app/actions/blog/commantaire/delete.php?deleteId=${comId}`)
   .then(response=> response.json())
   .then(data=>{
    if (data.status === 'success') {
       
        showComments();
    }
   })
   .catch(error => {
    console.error('Error occurred:', error);
    alert(`An unexpected error occurred: ${error.message}`);
});
 }
async function submitEdit() {
    const updatedComment = document.getElementById('editCommentTextarea').value;
    const forma = new FormData();
    forma.append('newComment', updatedComment)
    forma.append('commentId', currentEditCommentId)

    fetch(`../../app/actions/blog/commantaire/update.php`,
        {
            method: 'POST',
            body: forma
        }
    )
   .then(response=> response.json())
   .then(data=>{
    if (data.status === 'success') {
        hideEditModal();
        showComments();
    }
   })
   .catch(error => {
    console.error('Error occurred:', error);
    alert(`An unexpected error occurred: ${error.message}`);
});

    
}

console.log(articleId)
async function getTotalLike(articleId) {
    try {

        const response = await fetch(`../../app/actions/blog/article/addToFavori.php?totalFavori=${articleId}`);
        const totalLike = await response.json();

        return totalLike;
    } catch (error) {
        console.error(`Error fetching tags for article ${articleId}:`, error);
        return [];
    }
}
async function checkFavori(articleId)
{
    try {
        const response = await fetch(`../../app/actions/blog/article/addToFavori.php?checkId=${articleId}`);
        const favori = await response.json();
      
        return favori;
    }catch (error) {
        console.error(`Error fetching tags for article ${articleId}:`, error);
        return [];
    }
}
function likeArticle(articleId)
{
    fetch(`../../app/actions/blog/article/addToFavori.php?articleId=${articleId}`)
    .then(response=>response.json())
    .then(data => {
        if (data.status === 'success') {
            showArticle();
        }

    })
}
function dislikeArticle(articleId)
{
    fetch(`../../app/actions/blog/article/removeFromFavori.php?articleId=${articleId}`)
    .then(response=>response.json())
    .then(data => {
        if (data.status === 'success') {
            showArticle();        }

    })
}
async function showArticle()
{
    const totalLike = await getTotalLike(articleId)
    const favori = await checkFavori(articleId)

    console.log(totalLike)
    fetch(`../../app/actions/blog/article/get.php?article_id=${articleId}`)
.then(response=>response.json())
.then(article => {
    
    articleContainer.innerHTML=`
    <div class="mb-8">
        <h1 id="titi" class="text-4xl font-bold mb-4">${article.titre}</h1>
        <div class="flex items-center space-x-4 text-gray-600">
            <div class="flex items-center">
                <img src="../image/userimage.png" alt="Author" class="w-10 h-10 object-cover rounded-full mr-2"/>
                <span>${article.fullName}</span>
            </div>
            <span>${article.created_at}</span>
        </div>
    </div>

    <!-- Article Image -->
    <div class="mb-8">
        <img src="../../app/${article.image_path}" alt="Article Cover" class="w-full h-[400px] object-cover rounded-lg"/>
    </div>

    <!-- Article Content -->
    <div class="prose max-w-none mb-8">
        <p class="text-lg mb-4">
        ${article.description}        </p>
        
    </div>

    <!-- Article Engagement -->
    <div class="flex items-center space-x-6 mb-8 border-t border-b py-4">
        <div class="flex items-center space-x-2">
            <div class="flex items-center space-x-1 text-gray-600 hover:text-blue-600">
            ${favori.favori == 0 ? `
                <button class="hover:text-primary transition-colors" onclick="likeArticle(${article.id})">
                    <i class="fa-regular fa-star"></i>
                </button>
            ` : `
                <button class="hover:text-primary transition-colors" onclick="dislikeArticle(${article.id})">
                    <i class="fa-solid fa-star" style="color: #ff2465;"></i>
                </button>
             `}
                <span>${totalLike.totalFavori} Favori</span>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
            </svg>
            <p id = 'comentField'>${totalComments} Comment</p>
        </div>
    `
})
}
showArticle()
addCommentForme.addEventListener('submit', function(event){
    event.preventDefault()
    const formData = new FormData(this);
    formData.append('article_id', articleId)
    fetch(`../../app/actions/blog/commantaire/add.php`,
        {
            method: 'POST',
            body: formData,
        }
      
    )
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json(); 
    })
    .then(data => {
        console.log(data); 
        if (data.status === 'success') {
            addCommentForme.reset()
            showComments()
        } else {
            alert(`Error: ${data.message}`);
        }
    })
    .catch(error => {
        console.error('Error occurred:', error);
        alert(`An unexpected error occurred: ${error.message}`);
    });

})
async function getComments() {
    try {
        const response = await fetch(`../../app/actions/blog/commantaire/get.php?articleId=${articleId}`);
        const comments = await response.json();
       
        return comments;
    } catch (error) {
        console.error(`Error fetching tags for article ${articleId}:`, error);
        return [];
    }
}
async function showComments() {
    const comments = await getComments();
    console.log("aa", comments);
    allComments = comments
    const totalComments = comments[0].total || 0;
    if (totalComments > 0) {
        commentContainer.innerHTML = ``;

        comments.forEach(comment => {
            const isCurrentUser = comment.user_id === clientId;

            commentContainer.innerHTML += `
                <div class="border-b pb-6">
                    <div class="flex items-center mb-2">
                        <img src="../image/userimage.png" alt="Commenter" class="w-10 h-10 object-cover rounded-full mr-2"/>
                        <div>
                            <h4 class="font-bold">${comment.fullName}</h4>
                            <span class="text-gray-600 text-sm">${comment.createdAt}</span>
                        </div>
                        ${
                            isCurrentUser
                                ? `<div class="ml-auto flex items-center gap-2">
                                    <button onclick="showEditModal(${comment.id})" class="text-blue-600">Edit</button>
                                    <button onclick="deleteComment(${comment.id})" class="text-red-600">Delete</button>
                                   </div>`
                                : ''
                        }
                    </div>
                    <p class="text-gray-700">${comment.Commantaire}</p>
                </div>`;
        });
    } else {
        console.log('Khawi');
    }
}
showComments();



