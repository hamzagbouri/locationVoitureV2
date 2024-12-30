
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />



    <style >
       
        input[type="search"]::-webkit-search-cancel-button
        {
        -webkit-appearance:none;
        }
        .nav-items {
        position: relative;
    }
        .nav-items::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #D97706;
            transition: width 0.3s ease;
        }

        .nav-items:hover::after {
            width: 100%;
        }
      
       
    </style>
        <script>
        tailwind.config = {
            theme: {
            extend: {
                colors: {
                primary: '#D97706',
                borderColor: '#5f5d5d',
                bgcolor: '#F3F3F3',
                },
                fontFamily: {
                // primary: ['Consolas', 'monospace'],
                primary: ['Playfair Display', 'serif'],
                // primary: ['EB Garamond', 'serif'],
                secondary: ['Pattaya', 'sans-serif'],
                },
            },
            },
        };
        </script>
</head>
<body class="w-full h-full min-h-screen text-white font-primary ">
    <?php include 'header.php';
    ?>

    <section class="flex flex-col md:flex-row w-full h-full p-4 md:p-32  items-center justify-center text-black">
            <div class=" flex ">
                <img class=" w-[90%] rounded-tl-3xl rounded-tr-full rounded-bl-full rounded-br-full " src="../image/image22.jpg" alt="">
                <!-- <img class="w-[40%] rounded-tr-3xl rounded-tl-full rounded-bl-full rounded-br-full " src="../image/image.webp" alt=""> -->
                     
            </div>
            <div class="text-center">
                    <p class="text-[#757575] ">Chef Pro Hamza</p>
                  <h2 class="text-[40px] font-bold ">Welcome to <span class="text-primary font-bold">Chef</span>  PRO,
                    A <span class="text-primary font-bold">Feast</span> for the Senses</h2>
                  <p class="">
                    Immerse yourself in an unparalleled dining experience where flavors, aromas, and ambiance come together to create a feast for all your senses. Welcome to Royalx restaurant.
                    Join us at Royalx restaurant and discover a world of culinary excellence. Our chefs craft each dish with passion and precision, bringing you the finest flavors from around the globe.
                  </p>
                  <p class="font-bold">Mr. Hamza GBOURI</p>
                  <div class='flex justify-center'>
                  <img class="w-24 h-24 text-center" src="../image/signature.png" alt="">

                  </div>
            </div>
    </section>
    <section class="text-black w-full px-4 pb-4  md:px-32 md:pb-32 flex gap-4 flex-col h-full items-center justify-center">
    <div class="py-16 flex flex-col gap-12">
        <div class="flex justify-center gap-2">
            <img src="../image/left-shape.svg" alt="">
            <h2>   Explore Our Car Rentals</h2>
            <img src="../image/right-shape.svg" alt="">
        </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">


                <div class="relative group overflow-hidden rounded-xl shadow-md">
                    <img class="w-full h-120 object-cover group-hover:scale-110 transition-transform duration-300"
                        src="../assets/luxury-collection.jpg" alt="Sport Car">
                    <div
                        class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition-colors duration-300">
                    </div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">Sport Car</h3>
                    </div>
                    <a href="#"
                        class="absolute bottom-4 right-4 bg-orange-600 text-white p-2 rounded-full group-hover:bg-orange-500 transition-colors duration-300">
                        <i class="ri-arrow-right-up-line text-xl"></i>
                    </a>
                </div>


                <div class="relative group overflow-hidden rounded-xl shadow-md">
                    <img class="w-full h-120 object-cover group-hover:scale-110 transition-transform duration-300"
                        src="../assets/luxecar.jpg" alt="Convertible Car">
                    <div
                        class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition-colors duration-300">
                    </div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">Convertible Car</h3>
                    </div>
                    <a href="#"
                        class="absolute bottom-4 right-4 bg-orange-600 text-white p-2 rounded-full group-hover:bg-orange-500 transition-colors duration-300">
                        <i class="ri-arrow-right-up-line text-xl"></i>
                    </a>
                </div>


                <div class="relative group overflow-hidden rounded-xl shadow-md">
                    <img class="w-full h-120 object-cover group-hover:scale-110 transition-transform duration-300"
                        src="../assets/sedancar.jpg" alt="Sedan Car">
                    <div
                        class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition-colors duration-300">
                    </div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">Sedan Car</h3>
                    </div>
                    <a href="#"
                        class="absolute bottom-4 right-4 bg-orange-600 text-white p-2 rounded-full group-hover:bg-orange-500 transition-colors duration-300">
                        <i class="ri-arrow-right-up-line text-xl"></i>
                    </a>
                </div>


                <div class="relative group overflow-hidden rounded-xl shadow-md">
                    <img class="w-full h-120 object-cover group-hover:scale-110 transition-transform duration-300"
                        src="../assets/luxury.jpg" alt="Luxury Car">
                    <div
                        class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition-colors duration-300">
                    </div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">Luxury Car</h3>
                    </div>
                    <a href="#"
                        class="absolute bottom-4 right-4 bg-orange-600 text-white p-2 rounded-full group-hover:bg-orange-500 transition-colors duration-300">
                        <i class="ri-arrow-right-up-line text-xl"></i>
                    </a>
                </div>

            </div>
        </div>
       

    </section>
    <section class="text-black w-full px-4 pb-4  md:px-32 md:pb-32 flex gap-4 flex-col h-full items-center justify-center">
        <div class="flex gap-2">
            <img src="../image/left-shape.svg" alt="">
            <h2> Our Best Reviews</h2>
            <img src="../image/right-shape.svg" alt="">
        </div>
        <div class="w-full flex flex-wrap md:flex-no-wrap justify-center gap-4 pt-8">
            <div class="flex flex-col w-[50%] md:w-[20%]">
                <img class="rounded-t-full" src="../image/1.jpg" alt="">
                <p class="font-bold text-center">Hamza Gbouri</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, odit nam neque excepturi, illo, nulla </p>

            </div>
            <div class="flex flex-col w-[50%] md:w-[20%]">
                <img class="rounded-t-full" src="../image/2.jpg" alt="">
                <p class="font-bold text-center">Hamza Gbouri</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, odit nam neque excepturi, illo, nulla </p>

            </div>
            <div class="flex flex-col w-[50%] md:w-[20%]">
                <img class="rounded-t-full " src="../image/3.jpg" alt="">
                <p class="font-bold text-center">Hamza Gbouri</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, odit nam neque excepturi, illo, nulla </p>

            </div>
            <div class="flex flex-col w-[50%] md:w-[20%]">
                <img class="rounded-t-full" src="../image/4.jpg" alt="">
                <p class="font-bold text-center">Hamza Gbouri</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, odit nam neque excepturi, illo, nulla </p>

            </div>

        </div>
    </section>
    <section class="text-black w-full px-4 pb-4  md:px-32 md:pb-32  flex gap-4 flex-col h-full items-center justify-center">
        <div class="flex gap-2">
            <img src="../image/left-shape.svg" alt="">
            <h2> Book Now</h2>
            <img src="../image/right-shape.svg" alt="">
        </div>
        <p class="text-[40px]">Try Our <span class="text-primary font-bold">Experience</span> now!</p>
        <button class="px-4 py-2 bg-primary rounded-xl hover:bg-transparent hover:border hover:text-primary">Book Now</button>

    </section>
    
    <?php
    include 'footer.php';
    ?>
</body>
</html>