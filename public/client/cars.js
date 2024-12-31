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
    .then(response => {
        response.forEach(element => {
            document.getElementById('carCards').innerHTML += `
            <div class="w-full sm:w-1/3 md:w-1/4 p-4">
                <div class="bg-white p-4 rounded-md shadow-lg hover:shadow-2xl transition-all">
                    <img src="../../app/${element.image_path}" alt="${element.modele}" class="w-full h-48 object-contain rounded-md" />
                    <div class="pt-4">
                        <h3 class="text-xl font-semibold text-gray-800">${element.modele}</h3>
                        <p class="text-gray-600">Marque: ${element.marque}</p>
                        <p class="text-gray-600">Category: ${element.category}</p>
                        <p class="text-gray-600">Year: ${element.annee}</p>
                        <p class="text-gray-600">Price: $${element.prix}</p>
                        <p class="text-gray-600">Restantes: ${element.restantes}</p>
                        ${element.disponibilite === "1" 
                            ? `<p class="text-green-600 font-semibold">Available</p>` 
                            : `<p class="text-red-600 font-semibold">Not Available</p>`}
    
                        <!-- Book Button -->
                        <button 
                            class="mt-4 ${element.disponibilite === "1" ? 'bg-primary hover:bg-primary-dark' : 'bg-gray-500 cursor-not-allowed opacity-60'} text-white py-2 px-6 rounded-md w-full transition-colors"
                            ${element.disponibilite === "0" ? 'disabled' : ''}>
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
        `;
            
        });
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
        .then(response => {
            if(response )
            {
                console.log(response)
            }
            response.forEach(element => {
                document.getElementById('carCards').innerHTML += `
                <div class="w-full sm:w-1/3 md:w-1/4 p-4">
                    <div class="bg-white p-4 rounded-md shadow-lg hover:shadow-2xl transition-all">
                        <img src="../../app/${element.image_path}" alt="${element.modele}" class="w-full h-48 object-contain rounded-md" />
                        <div class="pt-4">
                            <h3 class="text-xl font-semibold text-gray-800">${element.modele}</h3>
                            <p class="text-gray-600">Marque: ${element.marque}</p>
                            <p class="text-gray-600">Category: ${element.category}</p>
                            <p class="text-gray-600">Year: ${element.annee}</p>
                            <p class="text-gray-600">Price: $${element.prix}</p>
                            <p class="text-gray-600">Restantes: ${element.restantes}</p>
                            ${element.disponibilite === "1" 
                                ? `<p class="text-green-600 font-semibold">Available</p>` 
                                : `<p class="text-red-600 font-semibold">Not Available</p>`}
        
                            <!-- Book Button -->
                            <button 
                                class="mt-4 ${element.disponibilite === "1" ? 'bg-primary hover:bg-primary-dark' : 'bg-gray-500 cursor-not-allowed opacity-60'} text-white py-2 px-6 rounded-md w-full transition-colors"
                                ${element.disponibilite === "0" ? 'disabled' : ''}>
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            `;
                
            });
        })

    }
})
function showAllCars(){
    document.getElementById('carCards').innerHTML = ``


fetch('../../app/actions/getAllCars.php')
.then(dara => dara.json())
.then(dara => {
    console.log(dara)
    dara.forEach(element => {
        document.getElementById('carCards').innerHTML += `
            <div class="w-full sm:w-1/3 md:w-1/4 p-4">
                <div class="bg-white p-4 rounded-md shadow-lg hover:shadow-2xl transition-all">
                    <img src="../../app/${element.image_path}" alt="${element.modele}" class="w-full h-48 object-contain rounded-md" />
                    <div class="pt-4">
                        <h3 class="text-xl font-semibold text-gray-800">${element.modele}</h3>
                        <p class="text-gray-600">Marque: ${element.marque}</p>
                        <p class="text-gray-600">Category: ${element.category}</p>
                        <p class="text-gray-600">Year: ${element.annee}</p>
                        <p class="text-gray-600">Price: $${element.prix}</p>
                        <p class="text-gray-600">Restantes: ${element.restantes}</p>
                        ${element.disponibilite === "1" 
                            ? `<p class="text-green-600 font-semibold">Available</p>` 
                            : `<p class="text-red-600 font-semibold">Not Available</p>`}
    
                        <!-- Book Button -->
                        <button 
                            class="mt-4 ${element.disponibilite === "1" ? 'bg-primary hover:bg-primary-dark' : 'bg-gray-500 cursor-not-allowed opacity-60'} text-white py-2 px-6 rounded-md w-full transition-colors"
                            ${element.disponibilite === "0" ? 'disabled' : ''}>
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    
})
}
showAllCars()