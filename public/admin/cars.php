
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }

        td {
            border-bottom-width: 1px;
            border-collapse: collapse;


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

<body>


    <div class="flex min-h-screen h-full ">
        <aside class="w-[16rem] border-r min-h-full  flex flex-col items-center gap-16 ">
            <div class="mt-16">
                <img class="w-32" src="../image/logo2.png" alt="logo">
            </div>
            <div class="">
                <div class="grid gap-4 w-[100%]">
                <a href="index.php" class="flex gap-4 px-4 py-2 rounded-2xl"><img src="./img/home.svg" alt=""> Dashboard </a>
                <a href='cars.php' class='flex gap-4 px-4 py-2 rounded-2xl'><img src='./img/briefcase.svg' alt=''> Cars </a>
                <a href='reservation.php' class='flex gap-4 px-4 py-2 rounded-2xl'><img id='btn-icon' class='mt-1' src='./img/3 User.svg' alt=''> Reservations</a>
                <a href='reservation.php' class='flex gap-4 px-4 py-2 rounded-2xl'><img id='btn-icon' class='mt-1' src='./img/3 User.svg' alt=''> Avis</a>
                </div>
            </div>
        </aside>
        <div class="grow">
            <header class=" h-20 border-b">
                <nav class=" h-full flex justify-between mx-8 items-center">
                    <div class="flex gap-2">
                        <img src="./img/Search.svg" alt="">
                        <input class="search outline-none border-none w-64 px-4 py-2 rounded-2xl" type="search"
                            name="search-input" id="search-input" placeholder="Search anything here">
                    </div>
                    <div class="flex w-72 justify-between  items-center ">
                        <img class="cursor-pointer" src="./img/settings.svg" alt="">
                        <img class="cursor-pointer" src="./img/Icon.svg" alt="">
                        <form action="../../backend/actionsPHP/logout.php" action="post">
                            <button><img src="img/logout.png" class="h-4 w-4" alt=""></button>
                        </form>
                        <div class="flex items-center gap-2 cursor-pointer">
                            <div
                                class=" cursor-pointer w-10 h-10 bg-[url('img/Ana.jpg')] bg-cover rounded-full text-white relative ">
                                <div class="bg-[#228B22] h-3 w-3 rounded-full absolute bottom-0 right-0  "></div>
                            </div>
                            <p class="text-[#606060] font-bold">Hamza GBOURI </p>
                        </div>

                    </div>

                </nav>
            </header>

            <section class="p-4 w-full flex flex-col gap-8">
                <?php
            if (isset($_SESSION['error'])) {
                set_time_limit(2);  
                echo $_SESSION['error'];  
                unset($_SESSION['error']);  
            }
            ?>

                <div class="flex justify-between items-center px-8">
                    <h1>
                        Cars
                    </h1>
                    <div class="flex gap-4">
                        <button class="flex gap-2 items-center border px-4 py-2 rounded-lg text-[#0E2354] ">
                            <img src="./img/Downlaod.svg" alt="">Export
                        </button>
                        <button id="add-etd" onclick="document.getElementById('modal').style.display='flex'"
                            class="flex gap-2 items-center bg-primary px-4 py-2 rounded-lg text-white ">
                            <img src="./img/_Avatar add button.svg" alt="">New Cars
                        </button>
                    </div>
                </div>

                <div class="flex justify-between items-center px-4 border py-4 rounded-lg">
                    <div class="flex gap-2">
                        <img src="./img/Search.svg" alt="">
                        <input class="search outline-none border-none w-72 px-4 py-2 rounded-2xl" type="search"
                            name="search-input" id="search-input" placeholder="Search car by name...">
                    </div>
                    <div class="flex gap-4 items-center">
                        <button class="flex gap-2 items-center border px-4 py-2 rounded-lg">
                            <img src="./img/Filters lines.svg" alt="">Filters
                        </button>
                        <div class="flex gap-2">
                            <img class="px-4 py-3 border rounded-lg cursor-pointer" src="./img/Vector.svg" alt="">
                            <img class="px-4 py-2 border rounded-lg cursor-pointer" src="./img/element-3.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 justify-around ">
                   

                </div>


            </section>

        </div>
        <div id='modal' class='modal bg-black bg-opacity-75 hidden items-center justify-center fixed inset-0 z-50'>
            <div
                class="w-full m-8 h-[90%] border border-2 border-black overflow-auto rounded-3xl bg-white relative z-50 md:w-2/4">
                <svg class="fill-primary absolute cursor-pointer top-0 right-0 pr-4 pt-2 w-10 h-8 "
                    onclick="closeModal()" xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem"
                    viewBox="0 0 24 24">
                    <path
                        d="M20.48 3.512a11.97 11.97 0 0 0-8.486-3.514C5.366-.002-.007 5.371-.007 11.999c0 3.314 1.344 6.315 3.516 8.487A11.97 11.97 0 0 0 11.995 24c6.628 0 12.001-5.373 12.001-12.001c0-3.314-1.344-6.315-3.516-8.487m-1.542 15.427a9.8 9.8 0 0 1-6.943 2.876c-5.423 0-9.819-4.396-9.819-9.819a9.8 9.8 0 0 1 2.876-6.943a9.8 9.8 0 0 1 6.942-2.876c5.422 0 9.818 4.396 9.818 9.818a9.8 9.8 0 0 1-2.876 6.942z" />
                    <path fill="#5051fa"
                        d="m13.537 12l3.855-3.855a1.091 1.091 0 0 0-1.542-1.541l.001-.001l-3.855 3.855l-3.855-3.855A1.091 1.091 0 0 0 6.6 8.145l-.001-.001l3.855 3.855l-3.855 3.855a1.091 1.091 0 1 0 1.541 1.542l.001-.001l3.855-3.855l3.855 3.855a1.091 1.091 0 1 0 1.542-1.541l-.001-.001z" />
                </svg>

                <div class="flex flex-col p-4">
                    <h3 class="flex justify-center items-center" id="modal-title">Add Car</h3>
                    <form id="car-form" method="post" action="../../backend/actionsPHP/car/add.php"
                        enctype="multipart/form-data" class="flex flex-col pt-16 gap-4">

                        <div class="flex flex-col">
                            <label for="car-title">Car Title</label>
                            <input class="border border-gray-200 border-2 rounded-lg p-2" type="text" id="car-title"
                                name="car-title">
                        </div>

                        <div class="flex flex-col">
                            <label for="car-price">Price</label>
                            <input class="border border-gray-200 border-2 rounded-lg p-2" type="number" id="car-price"
                                name="car-price">
                        </div>
                        <div class="flex flex-col">
                            <label for="multi-select" class="block text-lg font-medium text-gray-700 mb-2">
                                Select Options
                            </label>
                            <select id="multi-select" name="options[]" multiple
                                class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary sm:text-sm">
                                <?php
                        if(isset($result)){
                            foreach($result as $row) {
                                echo "<option value ='". $row['id'] ."' >". $row['titre_plat'] ." </option>";
                            }
                        }
                        ?>
                            </select>
                            <p class="mt-2 text-sm text-gray-500">Hold down the Ctrl (Windows) or Command (Mac) key to
                                select multiple options.</p>
                        </div>
                        <div id="plats-container" class="flex flex-col gap-4">

                        </div>

                        <button type="button" id="add-plat" class="bg-gray-300 text-black rounded-lg px-4 py-2">Add
                            Plat</button>
                        <input type="hidden" id="nbr_plat" name='nbr-plat' value="0">
                        <button type="submit" name="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2">Add
                            Car</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function closeModal() {
                const modal = document.getElementById('modal');

                modal.style.display = 'none';
            }
            console.log(document.getElementById('nbr_plat').value)
            document.getElementById('add-plat').addEventListener('click', () => {
                const platsContainer = document.getElementById('plats-container');
                const platCount = platsContainer.children.length + 1;
                document.getElementById('nbr_plat').value = platCount;
                console.log(document.getElementById('nbr_plat').value)
                const newPlat = `
      <div class="plat-fields flex flex-col gap-2">
        <h4 class="text-lg font-semibold">Plat ${platCount}</h4>
        <div class="flex flex-col">
          <label for="plat-title-${platCount}">Plat Title</label>
          <input class="border border-gray-200 border-2 rounded-lg p-2" type="text" id="plat-title-${platCount}" name="plat-title-${platCount}">
        </div>
        <div class="flex flex-col">
          <label for="plat-image-${platCount}">Image</label>
          <input class="border border-gray-200 border-2 rounded-lg p-2" type="file" id="plat-image-${platCount}" name="plat-image-${platCount}">
        </div>
        <div class="flex flex-col">
          <label for="plat-category-${platCount}">Category</label>
          <input class="border border-gray-200 border-2 rounded-lg p-2" type="text" id="plat-category-${platCount}" name="plat-category-${platCount}">
        </div>
        <div class="flex flex-col">
          <label for="plat-description-${platCount}">Description</label>
          <textarea class="border border-gray-200 border-2 rounded-lg p-2" id="plat-description-${platCount}" name="plat-description-${platCount}"></textarea>
        </div>
      </div>`;
                platsContainer.insertAdjacentHTML('beforeend', newPlat);
            });
        </script>

        <!-- Modal Edit -->
        <div id="modalEdit" class="modal bg-black bg-opacity-75 hidden items-center justify-center fixed inset-0 z-50 ">
            <div class="w-full m-8 h-auto border border-2 border-black rounded-3xl bg-white relative z-50 md:w-1/4 ">
                <svg class=" fill-primary absolute cursor-pointer top-0 right-0 pr-4 pt-2 w-10 h-8"
                    onclick="document.getElementById('modalEdit').style.display='none'"
                    xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem" viewBox="0 0 24 24">
                    <path
                        d="M20.48 3.512a11.97 11.97 0 0 0-8.486-3.514C5.366-.002-.007 5.371-.007 11.999c0 3.314 1.344 6.315 3.516 8.487A11.97 11.97 0 0 0 11.995 24c6.628 0 12.001-5.373 12.001-12.001c0-3.314-1.344-6.315-3.516-8.487m-1.542 15.427a9.8 9.8 0 0 1-6.943 2.876c-5.423 0-9.819-4.396-9.819-9.819a9.8 9.8 0 0 1 2.876-6.943a9.8 9.8 0 0 1 6.942-2.876c5.422 0 9.818 4.396 9.818 9.818a9.8 9.8 0 0 1-2.876 6.942z" />
                    <path fill="#5051fa"
                        d="m13.537 12l3.855-3.855a1.091 1.091 0 0 0-1.542-1.541l.001-.001l-3.855 3.855l-3.855-3.855A1.091 1.091 0 0 0 6.6 8.145l-.001-.001l3.855 3.855l-3.855 3.855a1.091 1.091 0 1 0 1.541 1.542l.001-.001l3.855-3.855l3.855 3.855a1.091 1.091 0 1 0 1.542-1.541l-.001-.001z" />
                </svg>

                <div class="flex flex-col p-4">
                    <h3 class=" flex justify-center items-center" id="modal-title"></h3>
                    <form id="student-form-edit" method="post" action="updateStudent.php"
                        class="flex flex-col pt-16 gap-4">

                        <select value="" class="border border-2 border-gray-200 rounded-lg p-2" id="apprenant-list-edit"
                            name="apprenant-input-edit">
                            <option id="apprenant" disabled checked> ------ </option>
                            <option value="A1"> A1 </option>
                            <option value="A2"> A2 </option>
                        </select>
                        <input type="hidden" id="id-edit" name="id-edit">
                        <div class="flex flex-col">
                            <label for="name-input-edit">Nom</label>
                            <input value="" class="border border-gray-200 border-2 rounded-lg p-2" type="text"
                                id="name-input-edit" name="name-input-edit">
                        </div>

                        <div class="flex flex-col">
                            <label for="date-input-edit">Date de Naissance</label>
                            <input value="" class="border border-gray-200 border-2 rounded-lg p-2" type="date"
                                id="date-input-edit" name="date-input-edit">
                        </div>
                        <div class="flex flex-col">
                            <label for="ville-input-edit">Ville</label>
                            <input value="" class="border border-gray-200 border-2 rounded-lg p-2" type="text"
                                id="ville-input-edit" name="ville-input-edit">
                        </div>
                        <div class="flex flex-col">
                            <label for="email-input-edit">Email</label>
                            <input value="" class="border border-gray-200 border-2 rounded-lg p-2" type="text"
                                id="email-input-edit" name="email-input-edit">
                        </div>
                        <div class="flex flex-col">
                            <label for="phone-input-edit">Telephone</label>
                            <input value="" class="border border-gray-200 border-2 rounded-lg p-2" type="text"
                                id="phone-input-edit" name="phone-input-edit">
                        </div>

                        <button type="submit" name="edit-submit" class="bg-blue-500 text-white rounded-lg px-4 py-2">
                            Modify Student
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>

    <script>
        document.getElementById('btn-drop-side').addEventListener("click", function () {
            const cont = document.getElementById("drop-container")
            if (cont.style.display == 'none') {
                document.getElementById('btn-drop-side').className = 'flex gap-4 bg-[#000000] text-[#ffffff] transition-all px-4 py-2 rounded-2xl'
                document.getElementById('btn-icon').setAttribute('src', './img/3 User hover.svg')

                cont.style.display = "block"

            }
            else {
                document.getElementById('btn-drop-side').className = 'flex gap-4 transition-all px-4 py-2 rounded-2xl'
                document.getElementById('btn-icon').setAttribute('src', './img/3 User.svg')
                cont.style.display = "none"
            }

        })

        document.getElementById("add-etd").addEventListener('click', function () {
            console.log('aa')
            document.getElementById("modal").style.display = "flex";
        })
        function openEditModal(id, nom, date_naissance, ville, telehpone, apprenant, email) {
            document.getElementById('modalEdit').style.display = 'flex'
            document.getElementById('id-edit').value = id
            document.getElementById('email-input-edit').value = email;
            document.getElementById('name-input-edit').value = nom;
            document.getElementById('date-input-edit').value = date_naissance;
            document.getElementById('ville-input-edit').value = ville;
            document.getElementById('phone-input-edit').value = telehpone;
            document.getElementById('apprenant-list-edit').value = apprenant;
        }

    </script>
</body>

</html>