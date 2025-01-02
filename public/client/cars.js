const carCardsContainer = document.getElementById('carCards');

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
        showAllCars();
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
function showAllCars(){
    document.getElementById('carCards').innerHTML = ``


    fetch('../../app/actions/getAllCars.php')
    .then(response => response.json())
    .then(cars => {
        carCardsContainer.innerHTML = ''; 

       
        showCars(cars)
    })
    .catch(err => console.error('Error fetching cars:', err));

}
showAllCars()

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
