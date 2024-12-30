


<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<style>
    body {
      background-image: url('./assets/login-bg.png');
      background-size: cover;
      background-position: center;
    }
</style>
<body class="flex items-center justify-center min-h-screen">

<div class="bg-white/20 backdrop-blur-md p-6 rounded-lg shadow-lg w-full max-w-md">
<h2 class="text-2xl font-semibold text-white text-center mb-6">Register</h2>

        <?php if (!empty($message)): ?>
            <div class="mb-4">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="#" method="POST">
            
            <div class="mb-4">
                <label for="nom" class="block text-white mb-2">Nom d'utilisateur</label>
                <div class=" bg-white/30 rounded-lg">
                <input type="text" id="nom" name="nom_utilisateur" placeholder="Votre nom" class="w-full placeholder-white/80 bg-transparent text-white flex-grow px-4 py-2 outline-none" required>
                </div>            
            </div>

            <div class="mb-4">
                <label for="email" class="block text-white mb-2">Email</label>
                <div class=" bg-white/30 rounded-lg">
                    <input type="email" id="email" name="email" placeholder="Votre email" class="placeholder-white/80 w-full bg-transparent text-white flex-grow px-4 py-2 outline-none" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-white mb-2">Mot de passe</label>
                <div class=" bg-white/30 rounded-lg">
                    <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" class="w-full  placeholder-white/80 rounded-lg bg-transparent text-white flex-grow px-4 py-2 outline-none" required>
                </div>
            </div>
            
            <button type="submit" name='submit'class="w-full mt-3 bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition">
                Create Account
            </button>
            <p class="text-center text-white mt-4">have an account? <a href="index.php" class="hover:underline text-black">login</a>
      </p>
        </form>
    </div>

</body>
</html>