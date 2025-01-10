<?php
session_start();

    
  if(!isset($_SESSION['id']  ) )
  {
      header('Location: ../');
  }
  if(!isset($_GET['article_id']))
  {
    header('Location: blog.php');
  }
 
  $article_id = $_GET['article_id'];
  require_once '../../app/actions/blog/theme/get.php';
  require_once '../../app/actions/blog/tag/get.php';
  require_once '../../app/actions/blog/commantaire/get.php';
  $tags = getTag::getAllTags();
  
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
<body class="w-full h-full min-h-screen text-white  ">
<header class="bg-[url('../image/bg22.png')] bg-cover h-[40%] bg-no-repeat object-fit font-primary " >
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
        <div class="h-72 w-[100%] flex p-8 items-center justify-center text-white ">
                <p id="theme" class="text-[50px] " >Articles</p>
        </div>

    </header>
    <section class="py-12 px-16 bg-gray-100">
    <div id='article-container' class="container mx-auto px-4 py-8 text-black">
    <!-- Article Header -->
    
    </div>

    <!-- Comments Section -->
    <div class="mb-8 text-black">
        <h2 class="text-2xl font-bold mb-6">Comments</h2>
        
        <!-- Comment Form -->
        <form id='addcommentForm' class="mb-8">
            <div class="mb-4">
                <textarea 
                name= "commantaire"
                    class="w-full p-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    rows="4"
                    placeholder="Add a comment..."
                ></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Post Comment
            </button>
        </form>

        <!-- Example Comments -->
        <div id="comment-container" class="space-y-6 text-black">
            
        </div>
    </div>
</div>



    </div>
</section>
<script src="commantaire.js"></script>
<?php include('footer.php') ?>
</body>
</html>