<?php
session_start();

    
  if(!isset($_SESSION['id']  ) )
  {
      header('Location: ../');
  }
  if(!isset($_GET['theme_id']))
  {
    header('Location: blog.php');
  }
  $theme_id = $_GET['theme_id'];
  require_once '../../app/actions/blog/theme/get.php';
  $Theme = getTheme::getThemeById($theme_id);
  require_once '../../app/actions/blog/article/get.php';
  require_once '../../app/actions/blog/tag/get.php';
  $tags = getTag::getAllTags();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
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

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">


<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>



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
<header class="bg-[url('../image/bg22.png')] bg-cover h-[40%] bg-no-repeat object-fit  " >
        <nav class="w-full h-[40%] sticky  flex overflow-hidden items-center justify-around">
            <div class="h-full flex items-center h-full ">
                <img class="w-28 h-16 " src="../image/logo2.png" alt="">
            </div>
      
                <ul class="flex w-[30%] justify-around text-lg font-bold tracking-widest">
                    <li ><a class="nav-items hover:text-[#D97706] hover:font-bold" href="home.php">Home</a></li>
                    <li><a class="nav-items hover:text-[#D97706] hover:font-bold "  href="cars.php">Cars</a></li>
                    <li><a class="nav-items hover:text-[#D97706] hover:font-bold"  href="contact.php">Contact</a></li>
                    <li><a class="nav-items hover:text-[#D97706] hover:font-bold"  href="reservation.php">Reservations</a></li>
                    <li><a class="nav-items hover:text-primary hover:font-bold"  href="blog.php">Blog</a></li>
                 
                </ul>
     
            <div>
            <form action="../../app/actions/logout.php" method="post">
                    <button class="px-4 py-2 bg-primary rounded-xl hover:bg-transparent hover:border hover:text-primary">Logout</button>
                    </form>
                        </div>
        </nav>
        <div class="h-72 w-[100%] flex p-8 items-center justify-center ">
                <p class="text-[50px]"><?php echo $Theme['nom']?></p>
        </div>

    </header>
    <section class="py-12 bg-gray-100">
    <div class="container mx-auto px-4 py-8 text-black">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Available Themes</h1>
        <!-- Button to Add Article -->
        <button 
            id="openModal" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300"
        >
            Add Article
        </button>
    </div>

    <!-- Search and Filter -->
    <div class="flex justify-center items-center w-[100%] gap-4 mb-8">
        <!-- Search Input -->
        <div class="relative w-full max-w-md">
            <input 
                type="text" 
                id="search" 
                placeholder="Search themes..." 
                class="w-full px-4 py-2 rounded-lg shadow-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300"
            />
        </div>
        <!-- Tag Filter -->
        <div>
           <select 
               id="tagFilter" 
               class="px-4 py-2 rounded-xl border border-gray-300"
           >
               <option value="">Select a tag</option>
               <option value="Tag1">Tag1</option>
               <option value="Tag2">Tag2</option>
               <option value="Tag3">Tag3</option>
           </select>
        </div>
    </div>

    <!-- Themes List -->
    <div id="articlesList" class="flex flex-wrap -mx-4">
     
    </div>
</div>

<!-- Add Article Modal -->
<div 
    id="addArticleModal" 
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden text-black"
>
    <div class="bg-white p-6 rounded-lg shadow-lg w-4/5 overflow-y-auto h-[90%]">
        <h2 class="text-xl font-bold mb-4">Add New Article</h2>
        <form id="addArticleForm" enctype="multipart/form-data">
            <!-- Title and Image Upload -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Title -->
                <div>
                    <input type="hidden" value="<?php echo $theme_id?>" name="themeId">
                    <label for="articleTitle" class="block font-medium mb-1">Title</label>
                    <input 
                        type="text" 
                        id="articleTitle" 
                        name="title" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required
                    />
                </div>
                <!-- Image Upload -->
                <div>
                    <label for="articleImage" class="block font-medium mb-1">Upload Image</label>
                    <input 
                        type="file" 
                        id="articleImage" 
                        name="image" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        accept="image/*"
                        required
                    />
                </div>
            </div>

            <!-- Tag Selection -->
            <div class="mb-4">
                <label for="articleTags" class="block font-medium mb-1">Tags</label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="articleTags" 
                        name="tags" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Search or add tags"
                        autocomplete="off"
                    />
                    <div 
                        id="tagsList" 
                        class="absolute w-full bg-white border border-gray-300 rounded-lg mt-1 shadow-lg max-h-60 overflow-y-auto hidden"
                    ></div>
                </div>
                <div id="selectedTags" class="flex flex-wrap gap-2 mt-2">
                    
                </div>
            </div>

            <!-- Description with Rich Text Editor -->
            <div class="mb-4">
                <label for="articleDescription" class="block font-medium mb-1">Description</label>
                <div id="articleDescriptionEditor" class="border rounded-lg p-2"></div>
                <textarea 
                    id="articleDescription" 
                    name="description" 
                    class="hidden"
                ></textarea>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-4">
                <button 
                    type="button" 
                    id="closeModal" 
                    class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition"
                >
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</div>




</div>



    </div>
</section>
<script src="article.js"></script>
<?php include('footer.php') ?>
</body>
</html>