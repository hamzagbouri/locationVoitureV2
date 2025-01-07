<?php
session_start();

    
  if(!isset($_SESSION['id']  ) )
  {
      header('Location: ../');
  }
  require_once '../../app/actions/blog/theme/get.php';
  $allThemes = getTheme::getAllTheme();
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
                <p class="text-[50px]">Blog</p>
        </div>

    </header>
    <section class="py-12 bg-gray-100">
    <div class="container mx-auto px-4 py-8">
    <!-- Title -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Available Themes</h1>
        <p class="text-gray-600 mt-2">Browse through our curated themes and explore articles tailored to your interests.</p>
    </div>

    <!-- Search Input -->
    <div class="flex justify-center mb-8 text-black">
        <div class="relative w-full max-w-md">
            <input 
                type="text" 
                id="search" 
                placeholder="Search themes..." 
                class="w-full px-4 py-2 rounded-lg shadow-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300"
            />
        </div>
    </div>

    <!-- Themes List -->
    <div class="flex flex-wrap -mx-4">
        <?php foreach ($allThemes as $theme): ?>
            <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-6">
                <div class="relative group overflow-hidden rounded-lg shadow-lg bg-gray-100">
                    <!-- Theme Image -->
                    <img 
                        src="<?= htmlspecialchars('../../app/'.$theme['image_path']) ?>" 
                        alt="<?= htmlspecialchars($theme['nom']) ?>" 
                        class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110"
                    />
                    <!-- Overlay for hover effect -->
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                        <h3 class="text-white text-lg font-semibold"><?= htmlspecialchars($theme['nom']) ?></h3>
                    </div>
                    <!-- Button -->
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <a 
                            href="viewArticles.php?theme_id=<?php echo $theme['id']?>" 
                            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors duration-300"
                        >
                            View Articles
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer -->
    <footer class="mt-12 text-center text-gray-600">
        <p>&copy; <?= date('Y') ?> Your Blog Name. All rights reserved.</p>
    </footer>
</div>



    </div>
</section>

<?php include('footer.php') ?>
</body>
</html>