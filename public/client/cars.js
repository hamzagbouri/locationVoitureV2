const carCardsContainer = document.getElementById('carCards');

fetch('../../app/actions/getCount.php')
.then(response => response.json())
.then(carsNumber => {
    const totalPages = Math.ceil(carsNumber.totalCars /6);
    console.log(totalPages);
    document.getElementById('pagesContainer').innerHTML=``;
    for(let i=1;i<=totalPages;i++)
    document.getElementById('pagesContainer').innerHTML+=`<p class="page border border-gray-200 rounded-md px-3 py-1">${i}</p>`;
    document.querySelectorAll('.page').forEach(page=>{
        
        page.addEventListener('click', function () {
            const startIndex = (parseInt(page.textContent) - 1) * 6;

            const formData = new FormData();
            formData.append('start', startIndex);

            fetch('../../app/actions/getCustomCar.php', {
                method: 'POST',
                body: formData,
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then((cars) => {
                    if (cars.error) {
                        console.error('Server error:', cars.error);
                    } else {
                        console.log('Fetched cars:', cars);
                        showAllCars(cars); 
                    }
                })
                .catch((err) => {
                    console.error('Error fetching cars:', err);
                });
        });

    })

})

.catch(err => console.error('Error fetching Count:', err));
function showCars(cars)
{
     cars.forEach(car => {          
                carCardsContainer.innerHTML += `
                    <div class="w-full sm:w-1/3 md:w-1/4 p-4">
                        <div class="bg-white p-4 rounded-md shadow-lg hover:shadow-2xl transition-all">
                            <img src="../../app/${car.image_path}" alt="${car.modele}" class="w-full h-48 object-contain rounded-md" />
                            <div class="pt-4">
                                <h3 class="text-xl font-semibold text-gray-800">${car.modele}</h3>
                                <p class="text-gray-600">Marque: ${car.marque}</p>
                                <p class="text-gray-600">Category: ${car.nom}</p>
                                <p class="text-gray-600">Year: ${car.annee}</p>
                                <p class="text-gray-600">Price: $${car.prix}</p>
                                <!-- Book Button -->
                                  <button 
                                        class="mt-4 bg-primary hover:bg-primary-dark text-white py-2 px-6 rounded-md w-full transition-colors"
                                        onclick="openModal(${car.car_id})">
                                        Book Now
                                    </button>
                                               <button 
                                        class="mt-4 bg-primary hover:bg-primary-dark text-white py-2 px-6 rounded-md w-full transition-colors"
                                        onclick="openReviewsModal(${car.car_id})">
                                        Reviews
                                    </button>
                            </div>
                        </div>
                    </div>
                `;
           
    });
}
function showCustomCars(nbrPage)
{
   
}
const bookingModal = document.getElementById('bookingModal');
const bookingForm = document.getElementById('bookingForm');
const cancelBooking = document.getElementById('cancelBooking');

function openModal(carId) {
    document.getElementById('carId').value = carId; 
    bookingModal.classList.remove('hidden'); 
}

cancelBooking.addEventListener('click', () => {
    bookingModal.classList.add('hidden'); 
});
document.getElementById("categoryFilter").addEventListener('change', function(){
    const categoryId = document.getElementById("categoryFilter").value;
    console.log(categoryId)
    if(categoryId == "")
    {
        showAllCars();
    } else {
    const formData = new FormData();
    formData.append('idCategory',categoryId);
    document.getElementById('carCards').innerHTML = ``
    fetch ('../../app/actions/filterCategory.php',{
        method: "post",
        body: formData,
    })
    .then(response => response.json())
    .then(cars => {
        showCars(cars)
    })
   
}
})
document.getElementById('carSearch').addEventListener('keyup', function(){
    const valueSearch = document.getElementById('carSearch').value.trim()
    if(valueSearch == "")
    {
        showCarsOnLoad();
    }
    else {
        const formData = new FormData();
        formData.append('modele',valueSearch);
        document.getElementById('carCards').innerHTML = ``
        fetch ('../../app/actions/searchCar.php',{
            method: "post",
            body: formData,
        })
        .then(response => response.json())
        .then(cars => {
            if(cars )
            {
                console.log(cars)
            }
            showCars(cars)
        })

    }
})
function showAllCars(cars){
    carCardsContainer.innerHTML = ''; 
    showCars(cars)
}

function showCarsOnLoad()
{
    const formDatat = new FormData();
let start = 0;
formDatat.append('start', start);



fetch('../../app/actions/getCustomCar.php',{
    method: "post",
    body: formDatat,
})
.then(response => response.json())
.then(cars => {
    showAllCars(cars)
})
.catch(err => console.error('Error fetching cars:', err));
}
showCarsOnLoad();
function openReviewsModal(idCar) {
    const formData = new FormData();
    formData.append('carId', idCar);

    fetch('../../app/actions/getAvisByCar.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data) && data.length > 0) {
                const reviewsContainer = document.getElementById('reviewsContainer');
                reviewsContainer.innerHTML = '';

                data.forEach(review => {
                    const reviewElement = `
                        <div class="p-4 border-b">
                            <p class="text-sm ">${review.avis}</p>
                            <p class="text-yellow-500">
                                ${'★'.repeat(review.stars)}${'☆'.repeat(5 - review.stars)}
                            </p>
                        </div>
                    `;
                    reviewsContainer.innerHTML += reviewElement;
                });
            } else {
                document.getElementById('reviewsContainer').innerHTML = `
                    <p class="text-gray-600 text-center">No reviews available for this car.</p>
                `;
            }

            document.getElementById('reviewsModal').classList.remove('hidden');
        })
        .catch(error => console.error('Error fetching reviews:', error));
}
