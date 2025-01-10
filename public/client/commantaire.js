let params = new URLSearchParams(document.location.search);
let articleId= params.get("article_id")
const addCommentForme = document.getElementById('addcommentForm')
const commentContainer = document.getElementById('comment-container')
const articleContainer = document.getElementById('article-container')
let totalComments 
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
async function showArticle()
{
    const totalLike = await getTotalLike(articleId)
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
            <button class="flex items-center space-x-1 text-gray-600 hover:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span>${totalLike.totalFavori} Favori</span>
            </button>
        </div>
        <div class="flex items-center space-x-2">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
            </svg>
            <p id = 'comentField'>${totalComments}</p>
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
async function showComments()
{
    const comments = await getComments()
    console.log("aa",comments)
    totalComments = comments[0].total
        if(comments[0].total >0 )
    {
        
        commentContainer.innerHTML=``
        comments.forEach(comment => {
            commentContainer.innerHTML+=` <div class="border-b pb-6">
                <div class="flex items-center mb-2">
                    <img src="../image/userimage.png" alt="Commenter" class="w-10 h-10 object-cover rounded-full mr-2"/>
                    <div>
                        <h4 class="font-bold">${comment.fullName}</h4>
                        <span class="text-gray-600 text-sm">${comment.createdAt}</span>
                    </div>
                </div>
                <p class="text-gray-700">${comment.Commantaire}</p>
            </div>`
            
        });

    } else{
        console.log('Khawi')
    }
}
showComments()

