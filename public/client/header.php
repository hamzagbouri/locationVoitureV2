
<header class="bg-[url('../image/hero.png')] bg-cover  bg-no-repeat object-fit h-screen " >
        <nav class="w-full h-[10%] sticky  flex overflow-hidden items-center justify-around">
            <div class="h-full flex items-center h-full ">
                <img class="w-28 h-16 " src="../image/logo2.png" alt="">
            </div>
      
                <ul class="md:flex justify-center w-[30%]  justify-around text-lg font-bold tracking-widest">
                    <li ><a class="nav-items hover:text-primary hover:font-bold" href="home.php">Home</a></li>
                    <li><a class="nav-items hover:text-primary hover:font-bold "  href="cars.php">Cars</a></li>
                    <li><a class="nav-items hover:text-primary hover:font-bold"  href="contact.php">Contact</a></li>
                    <li><a class="nav-items hover:text-primary hover:font-bold"  href="reservation.php">Reservations</a></li>
                    <li><a class="nav-items hover:text-primary hover:font-bold"  href="blog.php">Blog</a></li>

                 
                </ul>
     
            <div>
      
                <form action="../../app/actions/logout.php" method="post">
                    <button class="px-4 py-2 bg-primary rounded-xl hover:bg-transparent hover:border hover:text-primary">Logout</button>
                    </form>
              
                
                
            
            </div>
        </nav>
        <div class="h-[90%] md:w-[60%] flex p-8 items-center justify-center ">
                <div class="md:w-[70%] h-[50%] flex flex-col justify-evenly bg-black bg-opacity-50 rounded-xl px-8 ">
                    <div>
                        <p class=" font-primary text-2xl tracking-wider text-center animate__pulse animate__animated"> Luxury Cooking</p>
                    </div>
                    <div class="animate__animated animate__backInUp">
                        <p class="md:text-[50px] ">Cooking <span class="text-primary font-bold">Elegance</span>, One <span class="text-primary font-bold">Dish</span> at a Time.</p>
                    </div>
                    <div class="flex items-center gap-2 animate__pulse animate__animated cursor-pointer">
                        <div class="border py-2 px-3 rounded-xl">
                         <i class='fa fa-phone'></i>            
                        </div>
                        <div class="flex flex-col">
                            <p>Book Now</p>
                            <p>+212684608669</p>
                        </div>

                    </div>

                </div>
        </div>

    </header>