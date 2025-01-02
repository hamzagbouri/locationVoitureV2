<?php
require_once '../../app/actions/getCar.php';
$cars = getCar::getAllCars();
require_once '../../app/actions/getCategory.php';
$allCategories = getCategory::getAllCategories();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />



    <style>
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
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

<section class="flex flex-col w-full h-full p-4 md:p-32 items-center justify-center text-black">
    <h1 class="text-[50px] ">Our <span class='text-primary font-bold'>Cars</span></h1>

    <div class="flex flex-wrap gap-8 pt-8 w-full justify-center">
        <div class="w-full sm:w-1/3 md:w-1/4">
            <input type="text" id="carSearch" placeholder="Search for cars..." class="w-full p-2 border rounded-md shadow-sm" />
        </div>
        <div class="w-full sm:w-1/3 md:w-1/4">
            <select id="categoryFilter" onchange="filterCars(<?php echo $cat['id'] ?>)" class="w-full p-2 border rounded-md shadow-sm">
                <option value="">Select Category</option>
                <?php 
                            foreach($allCategories as $cat)
                            echo "<option value='".$cat['id']."'>".$cat['nom']."</option>"
                            ?>
            </select>
        </div>
    </div>

    <div class="flex flex-wrap h-[100%] w-[100%] justify-around gap-8 pt-8" id="carCards">
       
      
          
       

      
    </div>
</section>

    <?php include 'footer.php'  ;?>
    <script src="cars.js">
        

    </script>

</body>

</html>