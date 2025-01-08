function showAllArticles() {
    fetch('../../app/actions/blog/article/getAllJSON.php')
        .then(response => response.json())
        .then(articles => {
            const articlesList = document.getElementById('articlesList');
            articlesList.innerHTML = ''; // Clear existing articles
            console.log(articles)
            articles.forEach(article => {
                // Create article card
                const articleCard = document.createElement('div');
                articleCard.classList.add('w-full', 'md:w-1/2', 'lg:w-1/3', 'p-4');

                articleCard.innerHTML = `
                    <div class="bg-white shadow rounded overflow-hidden">
                        <img src="../../app/${article.image_path}" alt="${article.titre}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-lg font-bold mb-2">${article.titre}</h2>
                            <p class="text-gray-700 mb-2">${article.description}</p>
                            <div class="tags mb-2"></div>
                            <div class="flex justify-between items-center">
                                <button class="add-fav px-4 py-2 bg-blue-500 text-white rounded">Add to Favorites</button>
                                <button class="add-comment px-4 py-2 bg-gray-200 rounded">Add Comment</button>
                            </div>
                        </div>
                    </div>
                `;

                articlesList.appendChild(articleCard);

                fetchTagsForArticle(articleCard.querySelector('.tags'), article.id);

                articleCard.querySelector('.add-fav').addEventListener('click', () => addToFavorites(article.id));
                articleCard.querySelector('.add-comment').addEventListener('click', () => addComment(article.id));
            });
        })
        .catch(error => {
            console.error('Error fetching articles:', error);
        });
}

function fetchTagsForArticle(container, articleId) {
    fetch(`../../app/actions/blog/article/getTagsForArticle.php?articleId=${articleId}`)
        .then(response => response.json())
        .then(tags => {
            container.innerHTML = ''; 
            tags.forEach(tag => {
                const tagSpan = document.createElement('span');
                tagSpan.classList.add('inline-block', 'bg-gray-200', 'text-gray-800', 'px-3', 'py-1', 'rounded', 'mr-2', 'text-sm');
                tagSpan.textContent = tag.nom;
                container.appendChild(tagSpan);
            });
        })
        .catch(error => {
            console.error(`Error fetching tags for article ${articleId}:`, error);
        });
}

showAllArticles()
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
openButton.addEventListener('click', () => modal.classList.remove('hidden'));
closeButton.addEventListener('click', () => {
    document.getElementById('addArticleForm').reset()
    selectedTagsContainer.innerHTML=``
    selectedTags = []
    modal.classList.add('hidden')});



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
            alert('Article created successfully!');
        } else {
            alert(`Error: ${data.message}`);
        }
    })
    .catch(error => {
        console.error('Error occurred:', error);
        alert(`An unexpected error occurred: ${error.message}`);
    });
    
});