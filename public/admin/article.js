let params = new URLSearchParams(document.location.search);
let themeId= params.get("themeId")

const articlesTable = document.getElementById('articlesTable');
function updateStatusArticle(articleId,status)
{   console.log(status)
    const formaa = new FormData()
    formaa.append('articleId',articleId)
    formaa.append('newStatus',status)
    fetch(`../../app/actions/blog/article/updateStatus.php`,{
        method: 'POST',
        body: formaa,
    })
    .then(response => response.json())
    .then(data => {
        showAll();
    })
    .catch(error => {
        console.error('Error fetching articles:', error);
    });
}
async function showAll()
{
    fetch(`../../app/actions/blog/article/getAllAdmin.php?themeId=${themeId}`)
    .then(response => response.json())
    .then(data => {
        populateArticles(data);
    })
    .catch(error => {
        console.error('Error fetching articles:', error);
    });
}
showAll()
function populateArticles(articles) {
    const articlesContainer = document.getElementById('articlesGrid');
    articlesContainer.innerHTML = ''; // Clear existing content

    articles.forEach(article => {
        const card = document.createElement('div');
        card.className = 'bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 hover:scale-[1.02]';
        
        const statusColor = getStatusColor(article.status);
        
        card.innerHTML = `
            <div class="relative">
                <img src="../../app/${article.image_path || '/api/placeholder/400/200'}" 
                     alt="${article.titre}" 
                     class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105"/>
                
                <div class="absolute top-4 right-4">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full ${statusColor}">
                        ${article.status}
                    </span>
                </div>
            </div>
            
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-1">
                    ${article.titre}
                </h3>
                
                <p class="text-gray-600 mb-4 line-clamp-2">
                    ${article.description}
                </p>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center text-gray-500">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span>1.2k</span>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                            <span>8</span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button onclick="updateStatusArticle(${article.id},'Accepted')" 
                                class="px-4 py-2 bg-green-500 text-white rounded-lg transform transition-transform duration-200 hover:scale-105 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            Accept
                        </button>
                        <button onclick="updateStatusArticle(${article.id},'Rejected')" 
                                class="px-4 py-2 bg-red-500 text-white rounded-lg transform transition-transform duration-200 hover:scale-105 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Hide
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        articlesContainer.appendChild(card);
    });
}

function getStatusColor(status) {
    const statusColors = {
        'Accepted': 'bg-green-100 text-green-800',
        'Rejected': 'bg-red-100 text-red-800',
        'Pending': 'bg-blue-100 text-blue-800'
    };
    return statusColors[status] || 'bg-gray-100 text-gray-800';
}

function animateArticlesIn() {
    const articles = document.querySelectorAll('#articlesGrid > div');
    articles.forEach((article, index) => {
        article.style.opacity = '0';
        article.style.transform = 'translateY(20px)';
        setTimeout(() => {
            article.style.transition = 'all 0.5s ease';
            article.style.opacity = '1';
            article.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

function acceptArticle(articleId) {
    alert(`Article ID ${articleId} accepted!`);
}

function hideArticle(articleId) {
    alert(`Article ID ${articleId} hidden!`);
}