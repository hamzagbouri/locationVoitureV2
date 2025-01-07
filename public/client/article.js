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