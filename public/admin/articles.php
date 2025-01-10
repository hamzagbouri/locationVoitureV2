<?php 
require_once '../../app/actions/getCategory.php';
$allCategories = getCategory::getAllCategories();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
      integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
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
              primary: "#D97706",
              borderColor: "#5f5d5d",
              bgcolor: "#F3F3F3",
            },
            fontFamily: {
              // primary: ['Consolas', 'monospace'],
              primary: ["Playfair Display", "serif"],
              // primary: ['EB Garamond', 'serif'],
              secondary: ["Pattaya", "sans-serif"],
            },
          },
        },
      };
    </script>
  </head>

  <body>
    <div class="flex min-h-screen h-full">
      <aside
        class="w-[16rem] border-r min-h-full flex flex-col items-center gap-16"
      >
        <div class="mt-16">
          <img class="w-32" src="../image/logo2.png" alt="logo" />
        </div>
        <div class="">
          <div class="grid gap-4 w-[100%]">
            <a href="index.php" class="flex gap-4 px-4 py-2 rounded-2xl">
              <img src="./img/home.svg" alt="" /> Dashboard
            </a>
            <div class="relative">
              <button class="flex gap-4 px-4 py-2 rounded-2xl w-full">
                <img src="./img/briefcase.svg" alt="" /> Cars
              </button>

              <div
                id="carsDropdown"
                class="hidden absolute left-0 mt-2 bg-white shadow-lg rounded-xl w-full"
              >
                <a
                  href="category.php"
                  class="flex gap-4 px-4 py-2 rounded-2xl hover:bg-gray-100"
                >
                  <img src="./img/category.svg" alt="" /> Categories
                </a>
                <a
                  href="cars.php"
                  class="flex gap-4 px-4 py-2 rounded-2xl hover:bg-gray-100"
                >
                  <img src="./img/car.svg" alt="" /> Cars
                </a>
              </div>
            </div>
            
            <a href="reservation.php" class="flex gap-4 px-4 py-2 rounded-2xl">
              <img id="btn-icon" class="mt-1" src="./img/3 User.svg" alt="" />
              Reservations
            </a>
            <a href="themes.php" class="flex gap-4 px-4 py-2 rounded-2xl">
              <img id="btn-icon" class="mt-1" src="./img/3 User.svg" alt="" />
              Themes
            </a>
            <a href="tags.php" class="flex gap-4 px-4 py-2 rounded-2xl">
              <img id="btn-icon" class="mt-1" src="./img/3 User.svg" alt="" />
              Tags
            </a>
            <a href="avis.php" class="flex gap-4 px-4 py-2 rounded-2xl">
              <img id="btn-icon" class="mt-1" src="./img/3 User.svg" alt="" />
              Avis
            </a>
          </div>
        </div>
        <script>
          const carsButton = document.querySelector("button");
          const carsDropdown = document.getElementById("carsDropdown");

          carsButton.addEventListener("click", () => {
            carsDropdown.classList.toggle("hidden");
          });

          window.addEventListener("click", (e) => {
            if (!e.target.closest("div.relative")) {
              carsDropdown.classList.add("hidden");
            }
          });
        </script>
      </aside>
      <div class="grow">
        <header class="h-20 border-b">
          <nav class="h-full flex justify-between mx-8 items-center">
            <div class="flex gap-2">
              <img src="./img/Search.svg" alt="" />
              <input
                class="search outline-none border-none w-64 px-4 py-2 rounded-2xl"
                type="search"
                name="search-input"
                id="search-input"
                placeholder="Search anything here"
              />
            </div>
            <div class="flex w-72 justify-between items-center">
              <img class="cursor-pointer" src="./img/settings.svg" alt="" />
              <img class="cursor-pointer" src="./img/Icon.svg" alt="" />
              <form action="../../app/actions/logout.php" action="post">
                <button>
                  <img src="img/logout.png" class="h-4 w-4" alt="" />
                </button>
              </form>
              <div class="flex items-center gap-2 cursor-pointer">
                <div
                  class="cursor-pointer w-10 h-10 bg-[url('img/Ana.jpg')] bg-cover rounded-full text-white relative"
                >
                  <div
                    class="bg-[#228B22] h-3 w-3 rounded-full absolute bottom-0 right-0"
                  ></div>
                </div>
                <p class="text-[#606060] font-bold">Hamza GBOURI</p>
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
            <h1>Cars</h1>
            <div class="flex gap-4">
              <button
                class="flex gap-2 items-center border px-4 py-2 rounded-lg text-[#0E2354]"
              >
                <img src="./img/Downlaod.svg" alt="" />Export
              </button>
              <button
                id="add-etd"
                class="flex gap-2 items-center bg-primary px-4 py-2 rounded-lg text-white"
              >
                <img src="./img/_Avatar add button.svg" alt="" />New Category
              </button>
            </div>
          </div>

          <div
            class="flex justify-between items-center px-4 border py-4 rounded-lg"
          >
            <div class="flex gap-2">
              <img src="./img/Search.svg" alt="" />
              <input
                class="search outline-none border-none w-72 px-4 py-2 rounded-2xl"
                type="search"
                name="search-input"
                id="search-input"
                placeholder="Search car by name..."
              />
            </div>
            <div class="flex gap-4 items-center">
              <button
                class="flex gap-2 items-center border px-4 py-2 rounded-lg"
              >
                <img src="./img/Filters lines.svg" alt="" />Filters
              </button>
              <div class="flex gap-2">
                <img
                  class="px-4 py-3 border rounded-lg cursor-pointer"
                  src="./img/Vector.svg"
                  alt=""
                />
                <img
                  class="px-4 py-2 border rounded-lg cursor-pointer"
                  src="./img/element-3.svg"
                  alt=""
                />
              </div>
            </div>
          </div>
          <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">
            Articles List
            <span class="ml-2 text-sm font-normal text-gray-500">(Showing 10 of 24)</span>
        </h2>
        
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" 
                       placeholder="Search articles..." 
                       class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"/>
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" 
                     fill="none" 
                     stroke="currentColor" 
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" 
                          stroke-linejoin="round" 
                          stroke-width="2" 
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            
            <select class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="all">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="hidden">Hidden</option>
            </select>
        </div>
    </div>

    <!-- Articles Grid -->
    <div id="articlesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Articles will be populated here by JavaScript -->
    </div>
</div>

        </section>
      </div>

    <script src="article.js"></script>
  </body>
</html>
