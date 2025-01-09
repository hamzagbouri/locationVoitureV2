
const themeId = document.getElementById('theme').dataset.id 
const tagFilter = document.getElementById('tagFilter')
const searchInput = document.getElementById("search")
function likeArticle(articleId)
{
    fetch(`../../app/actions/blog/article/addToFavori.php?articleId=${articleId}`)
    .then(response=>response.json())
    .then(data => {
        if (data.status === 'success') {
            showAllArticles(themeId);
        }

    })
}
function dislikeArticle(articleId)
{
    fetch(`../../app/actions/blog/article/removeFromFavori.php?articleId=${articleId}`)
    .then(response=>response.json())
    .then(data => {
        if (data.status === 'success') {
            showAllArticles(themeId);        }

    })
}
searchInput.addEventListener('keydown',function(){
    searchValue = searchInput.value.trim()
    if(searchValue == "")
    {
        showAllArticles(themeId)
    } else {
        fetch(`../../app/actions/blog/article/searchArticle.php?themeId=${themeId}&titre=${searchValue}`)
        .then(data=>data.json())
        .then(data=> showArticlesHtml(data))
    }
})
tagFilter.addEventListener('change', function(){
    tagValue = tagFilter.value

    if(tagValue == "")
    {
        showAllArticles(themeId)
    } else 
    {
        fetch(`../../app/actions/blog/article/getAllJSON.php?themeId=${themeId}&tagId=${tagValue}`)
        .then(data=>data.json())
        .then(data=> showArticlesHtml(data))
    }
})

function createTagElement(tag) {

    return `
        <span 
            class="inline-flex items-center text-sm font-semibold px-3 py-1 rounded-full text-sm font-medium mr-2 mb-2"
            style="background-color: rgba(162,162,162,0.4); color: #36454F;"
        >
            ${tag.nom}
        </span>
    `;
}

async function fetchTagsForArticle(articleId) {
    try {
        const response = await fetch(`../../app/actions/blog/article/getTagsForArticle.php?articleId=${articleId}`);
        const tags = await response.json();
        return tags;
    } catch (error) {
        console.error(`Error fetching tags for article ${articleId}:`, error);
        return [];
    }
}
async function getComments(articleId) {
    try {
        const response = await fetch(`../../app/actions/blog/commantaire/get.php?articleId=${articleId}`);
        const comments = await response.json();
        console.log(comments)
        return comments;
    } catch (error) {
        console.error(`Error fetching tags for article ${articleId}:`, error);
        return [];
    }
}
async function getTotalLike(articleId) {
    try {
        console.log("ana hna")
        const response = await fetch(`../../app/actions/blog/article/addToFavori.php?totalFavori=${articleId}`);
        const totalLike = await response.json();
        console.log("like",totalLike)
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
async function showArticlesHtml(articles)
{
    const articlesList = document.getElementById('articlesList');
    articlesList.innerHTML = '';
    console.log('articles',articles)
    for (const article of articles) {
        const tags = await fetchTagsForArticle(article.id);
        const comments = await getComments(article.id)
        const favori = await checkFavori(article.id)
       const totalLike = await getTotalLike(article.id)

        
        const tagsHtml = tags.map(tag => createTagElement(tag)).join('');
        
        const articleCard = `
            <div class="w-full md:w-1/2 h-auto p-4">
                <div class="bg-white rounded-lg h-full shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 relative">
                    <!-- Image Container -->
                    <div class="relative h-48 overflow-hidden">
                        <img 
                            src="../../app/${article.image_path}" 
                            alt="${article.title}" 
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                        />
                    </div>
                    
                    <!-- Content Container -->
                    <div class="p-6">
                        <!-- Tags Container -->
                        <div class="flex flex-wrap mb-3">
                            ${tagsHtml}
                        </div>

                        <h3 class="text-xl font-semibold mb-2 text-gray-800 hover:text-primary">
                            ${article.titre}
                        </h3>
                        
                        <!-- Description -->
                        <div class="text-gray-600 mb-4 line-clamp-1">
                            ${article.description}
                        </div>
                        
                        <!-- Metadata -->
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-4">
                                <!-- Likes -->
                                <div class="flex items-center space-x-1">
                                ${favori.favori == 0 ? `
                                    <button class="hover:text-primary transition-colors" onclick="likeArticle(${article.id})">
                                        <i class="fa-regular fa-star"></i>
                                    </button>
                                ` : `
                                    <button class="hover:text-primary transition-colors" onclick="dislikeArticle(${article.id})">
                                        <i class="fa-solid fa-star" style="color: #ff2465;"></i>
                                    </button>
                                `}
                                
                                    <span>${totalLike.totalFavori}</span>
                                </div>
                                
                                <!-- Comments -->
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-comment"></i>
                                    <span>${comments.totalComments}</span>
                                </div>
                            </div>
                            
                            <!-- Date -->
                            <div class="text-gray-400">
                                ${new Date(article.created_at).toLocaleDateString()}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Arrow Down Animated Circle -->
                    <div class="absolute bottom-4 z-50 left-1/2 transform -translate-x-1/2 translate-y-1/2">
                        <div class="w-10 h-10 rounded-full bg-gray-100 border border-gray-300 flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300 animate-bounce shadow-lg cursor-pointer">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        articlesList.innerHTML += articleCard;
    }
}
async function showAllArticles(themeId) {
    try {
       
        const response = await fetch(`../../app/actions/blog/article/getAllJSON.php?themeId=${themeId}`);
        const articles = await response.json();
        showArticlesHtml(articles)
    } catch (error) {
        console.error('Error fetching articles:', error);
    }
}



showAllArticles(themeId)
const quill = new Quill('#articleDescriptionEditor', {
    theme: 'snow',
    placeholder: 'Write your article description here...',
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }], 
            [{ 'align': [] }],
            ['link', 'image'],   
        ]
    }
});

const form = document.getElementById('addArticleForm');

form.addEventListener('submit', (event) => {
    event.preventDefault(); 
    const descriptionTextarea = document.getElementById('articleDescription');
    const articleTitle  = document.getElementById('articleDescription');
    const articleImage = document.getElementById('articleImage');
    const themeId = document.getElementById('themeId');

    descriptionTextarea.value = quill.root.innerHTML;




   
});


const modal = document.getElementById('addArticleModal');
const openButton = document.getElementById('openModal');
const closeButton = document.getElementById('closeModal');
const tagsInput = document.getElementById('articleTags');
const tagsList = document.getElementById('tagsList');
const selectedTagsContainer = document.getElementById('selectedTags');
let selectedTags = [];
function reserModal(){
    document.getElementById('addArticleForm').reset()
    selectedTagsContainer.innerHTML=``
    selectedTags = []
    modal.classList.add('hidden')
}
openButton.addEventListener('click', () => modal.classList.remove('hidden'));
closeButton.addEventListener('click', () => reserModal());



function fetchTags(query) {
    fetch(`../../app/actions/blog/tag/getJSON.php?query=${query}`)
        .then(response => response.json())
        .then(tags => {
            tagsList.innerHTML = '';
            tags.forEach(tag => {
                const tagItem = document.createElement('div');
                tagItem.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                tagItem.textContent = tag.nom;
                tagItem.setAttribute('data-id', tag.id);
                tagItem.setAttribute('data-name', tag.nom);
                tagsList.appendChild(tagItem);
                tagItem.addEventListener('click', function () {
                    addTag(tag);
                });
            });
            tagsList.classList.remove('hidden');
        });
}


function addTag(tag) {
    if (!selectedTags.some(t => t.id === tag.id)) {
        selectedTags.push(tag);
        updateSelectedTags();
    }
    tagsInput.value = ''; 
    tagsList.classList.add('hidden'); 
}

function removeTag(tag) {
    selectedTags = selectedTags.filter(t => t.id !== tag.id);
    updateSelectedTags();
}

function updateSelectedTags() {
    console.log(selectedTags)
    selectedTagsContainer.innerHTML = '';
    selectedTags.forEach(tag => {
        const tagElement = document.createElement('div');
        tagElement.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-1', 'rounded-full', 'flex', 'items-center', 'gap-2');
        tagElement.textContent = tag.nom;
        const removeIcon = document.createElement('span');
        removeIcon.textContent = '×';
        removeIcon.classList.add('cursor-pointer');
        removeIcon.addEventListener('click', () => removeTag(tag));
        tagElement.appendChild(removeIcon);
        selectedTagsContainer.appendChild(tagElement);
    });
}

tagsInput.addEventListener('input', function () {
    const query = tagsInput.value;
    if (query.length >= 2) {
        fetchTags(query);
    } else {
        tagsList.classList.add('hidden');
    }
});
cmp = 0
tagsInput.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && tagsInput.value.trim() !== '') {
        e.preventDefault(); 
        const newTag = { id: 'new'+cmp, nom: tagsInput.value.trim() };
        cmp++;
        addTag(newTag);
    }
});

document.getElementById('addArticleForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('selectedTags', JSON.stringify(selectedTags));
    fetch('/locationVoiture/app/actions/blog/article/add.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json(); 
    })
    .then(data => {
        console.log(data); 
        if (data.status === 'success') {
            console.log(themeId)
            showAllArticles(themeId);
            reserModal();

        } else {
            alert(`Error: ${data.message}`);
        }
    })
    .catch(error => {
        console.error('Error occurred:', error);
        alert(`An unexpected error occurred: ${error.message}`);
    });
    
});