
<?php
session_start();
require_once '../../app/actions/getReservations.php';
require_once '../../app/actions/getCar.php';
require_once '../../app/actions/getAvis.php';
$id = $_SESSION['id'];
$allReservations = getReservations::getReservationByUserId($id);

$id = $_SESSION['id'];
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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
    <section class="bg-bgcolor py-16 px-8 text-black">
    <div class="container mx-auto">
        <h2 class="text-[40px] text-center text-black font-bold mb-12">
            Your <span class="text-primary">Reservations</span>
        </h2>

        <!-- Reservation Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 ">

            <?php
                if(count($allReservations) > 0){
                    foreach($allReservations as $reservation)
                    {
                       
                        $avis = getAvis::getAvisByIdUserRes($id,$reservation['id']);
                        
                        $car = getCar::getCarById($reservation['car_id']);
                        echo "<div class='bg-white rounded-lg shadow-lg p-6'>
                <h3 class='text-xl font-bold text-primary mb-4'>Reservation 1</h3>
                <img src='../../app/".$car['image_path']."' alt='".$car['modele']."' class='w-full h-48 object-contain rounded-md' />
                <ul class='text-gray-700'>
                    <li><span class='font-bold'>Adresse:</span> ".$reservation['lieu']."</li>
                    <li><span class='font-bold'>Date Debut:</span> ".$reservation['date_debut']."</li>
                    <li><span class='font-bold'>Date Fin:</span> ".$reservation['date_fin']."</li>
                    <li><span class='font-bold'>Date Reservation:</span> ".$reservation['date_reservation']."</li>
                    <li><span class='font-bold'>Status:</span> ".$reservation['status']."</li>

                </ul>
                <div class='flex justify-center gap-2'>
                <form class='cancel-form' action='../../app/actions/updateStatus.php' method='POST' >
                        <input type='hidden' name='res-id' value=".$reservation['id'].">
                        <input type='hidden' name='new-status' value='Canceled'>
                            <input type='hidden' name='action' value='confirm'>
                        ";  
                                                
                        if($reservation['status'] !== 'Canceled')
                        {echo "
                        <button name='confirm' class='mt-6 bg-primary text-white py-2 px-4 rounded hover:bg-[#826642] transition duration-300'>
                        Cancel Reservation
                        </button>";}
                      echo "</form>";
                            
                        if($avis)
                        {
                            echo " <button name='edit_review' onclick=\"openEditReviewModal('".$avis['id']."', '".$avis['avis']."', ".$avis['stars'].")\"   class='mt-6 bg-primary  text-white py-2 px-4 rounded hover:bg-[#826642] transition duration-300'>
                            Modify Review
                        </button>
                        <button name='delete_review'    class='mt-6 bg-red-600  text-white py-2 px-4 rounded hover:bg-[#826642] transition duration-300'>
                            <a href='../../app/actions/deleteAvis.php?".$avis['id']."'>Delete Review</a>
                        </button>";
                        }else 
                        {
                            echo " <button name='edit_reservation' onclick='openReviewModal(".$reservation['id'].")'  class='mt-6 bg-primary  text-white py-2 px-4 rounded hover:bg-[#826642] transition duration-300'>
                            Add Review
                        </button>";
                        }
                        echo "
              
                         </div>        
            </div>";
                    }
                } else{
                    echo "<p class='text-center w-full '> You don't have any reservation</p>";
                }
            ?>

          
<script>
     function openReviewModal(reservationId) {
    document.getElementById('reservationId').value = reservationId;
    document.getElementById('reviewModal').classList.remove('hidden');
}

function closeReviewModal() {
    document.getElementById('reviewModal').classList.add('hidden');
}
function openEditReviewModal(avisId,message,stars) {
    document.getElementById('avisId-edit').value = avisId;
    document.getElementById('message-edit').value = message;
    document.getElementById('stars-edit').value = stars;

    document.getElementById('reviewModal-edit').classList.remove('hidden');
}

function closeEditReviewModal() {
    document.getElementById('reviewModal-edit').classList.add('hidden');
}
</script>
   
        </div>

 <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-md w-1/3 shadow-lg">
        <h2 class="text-lg font-semibold mb-4">Add a Review</h2>
        <form id="reviewForm" action="../../app/actions/addAvis.php" method="POST">
            <input type="hidden" id="reservationId" name="reservation_id" />
            
            <div class="mb-4">
                <label for="stars" class="block text-sm font-medium text-gray-700">Stars</label>
                <select id="stars" name="stars" class="w-full mt-1 border rounded-md p-2">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea id="message" name="message" class="w-full mt-1 border rounded-md p-2" rows="4"></textarea>
            </div>
            
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded mr-2" onclick="closeReviewModal()">Cancel</button>
                <button type="submit" name="submit" class="bg-primary text-white py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </div>
</div>
<div id="reviewModal-edit" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-md w-1/3 shadow-lg">
        <h2 class="text-lg font-semibold mb-4">Modify Review</h2>
        <form id="reviewForm-edit" action="../../app/actions/editAvis.php" method="POST">
            <input type="hidden" id="avisId-edit" name="avisId-edit" />
            
            <div class="mb-4">
                <label for="stars-edit" class="block text-sm font-medium text-gray-700">Stars</label>
                <select id="stars-edit" name="stars-edit" class="w-full mt-1 border rounded-md p-2">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="message-edit" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea id="message-edit" name="message-edit" class="w-full mt-1 border rounded-md p-2" rows="4"></textarea>
            </div>
            
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded mr-2" onclick="closeEditReviewModal()">Cancel</button>
                <button type="submit" name="submit" class="bg-primary text-white py-2 px-4 rounded">Modify</button>
            </div>
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   
       const $allCancel = document.querySelectorAll('.cancel-form')
       $allCancel.forEach(cancel => {
        cancel.addEventListener('submit', function(event){
            event.preventDefault()
            console.log('test')
            Swal.fire({
            title: 'Cancel Reservation',
            text: 'Are you sure you want to cancel this reservation?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Cancel',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(cancel)
                cancel.submit();    
            }
        });
        })

       })
    document.getElementById('reservation-form').addEventListener('submit', function(event) {
        event.preventDefault();

       
        const menuSelect = document.getElementById('menu-select').value;
        const address = document.getElementById('adresse-reservation').value.trim();
        const numberOfPeople = document.getElementById('nbr-personne-reservation').value;
        const datee = document.getElementById('date-reservation').value;
        const time = document.getElementById('heure-reservation').value;

      
        const addressRegex = /^[a-zA-Z0-9\s,.'-]{3,}$/;

        if (!menuSelect) {
            Swal.fire('Error', 'Please select a menu.', 'error');
            return;
        }
        if (!addressRegex.test(address)) {
            Swal.fire('Error', 'Please enter a valid address.', 'error');
            return;
        }
        if (numberOfPeople <= 0) {
            Swal.fire('Error', 'Number of people must be greater than 0.', 'error');
            return;
        }
        if (!datee ||  new Date(datee).getTime() < Date.now()) {
            Swal.fire('Error', 'Please select a valide date.', 'error');
            return;
        } 
  
           
        if (!time) {
            Swal.fire('Error', 'Please select a time.', 'error');
            return;
        }
        const allDate = <?php echo json_encode($reservationDate) ?>;
        // console.log(allDate)
        // console.log(allDate.includes(datee))
        const allHeure = <?php echo json_encode($reservationHeure) ?>;
        if(allDate.includes(datee) == true)
        {
            console.log(allHeure)
            console.log(time)
        console.log(allHeure.includes(time))
            if(allHeure.includes(time+":00") == true)
                {
                    Swal.fire('Error', 'There already a reservation on this date and time choose another time', 'error');
                    return;
                }
        }

        
        Swal.fire({
            title: 'Confirm Reservation',
            text: 'Are you sure you want to confirm this reservation?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('reservation-form').submit();
            }
        });
    });
    document.getElementById('reservation-form-edit').addEventListener('submit', function(event) {
        event.preventDefault();

       
        const menuSelect = document.getElementById('menu-select-edit').value;
        const address = document.getElementById('adresse-reservation-edit').value.trim();
        const numberOfPeople = document.getElementById('nbr-personne-reservation-edit').value;
        const datee = document.getElementById('date-reservation-edit').value;
        const time = document.getElementById('heure-reservation-edit').value;

      
        const addressRegex = /^[a-zA-Z0-9\s,.'-]{3,}$/;

        if (!menuSelect) {
            Swal.fire('Error', 'Please select a menu.', 'error');
            return;
        }
        if (!addressRegex.test(address)) {
            Swal.fire('Error', 'Please enter a valid address.', 'error');
            return;
        }
        if (numberOfPeople <= 0) {
            Swal.fire('Error', 'Number of people must be greater than 0.', 'error');
            return;
        }
        if (!datee || new Date(datee).getTime() < Date.now()) {
            Swal.fire('Error', 'Please select a valide date.', 'error');
            return;
        } 
  
           
        if (!time) {
            Swal.fire('Error', 'Please select a time.', 'error');
            return;
        }
        const allDate = <?php echo json_encode($reservationDate) ?>;
        // console.log(allDate)
        // console.log(allDate.includes(datee))
        const allHeure = <?php echo json_encode($reservationHeure) ?>;
        if(allDate.includes(datee) == true)
        {
            console.log(allHeure)
            console.log(time)
        console.log(allHeure.includes(time))
            if(allHeure.includes(time+":00") == true)
                {
                    Swal.fire('Error', 'There already a reservation on this date and time choose another time', 'error');
                    return;
                }
        }

        
        Swal.fire({
            title: 'Modify Reservation',
            text: 'Are you sure you want to confirm this Modification?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('reservation-form-edit').submit();
            }
        });
    });

    function openEditModal(id,idMenu,heure_reservation,date_reservation,nbrPersonnes,address){
        const modalEdit = document.getElementById('reservationModal-edit');
        modalEdit.classList.remove('hidden');
        document.getElementById('')
        document.getElementById('r-id').value = id
        document.getElementById('heure-reservation-edit').value = heure_reservation
        document.getElementById('date-reservation-edit').value = date_reservation
        document.getElementById('nbr-personne-reservation-edit').value = nbrPersonnes
        document.getElementById('adresse-reservation-edit').value = address
        document.getElementById('menu-select-edit').value = idMenu
    }
</script>

        
</section>

<script>
    function toggleModal() {
        const modal = document.getElementById('reservationModal');
        modal.classList.toggle('hidden');
    }
    function toggleEditModal() {
        const modalEdit = document.getElementById('reservationModal-edit');
        modalEdit.classList.toggle('hidden');
    }
</script>


    <?php include 'footer.php';?>
    
</body>
</html>