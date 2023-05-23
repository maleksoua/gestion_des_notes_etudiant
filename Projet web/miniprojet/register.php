<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="wrapper">
                    <h2>Inscription</h2>
                    <p>Veuillez remplir vos informations pour vous inscrire.</p>
                    <form action="insert.php" method="GET">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="lastname" class="form-control" required>
                        </div>    
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="firstname" class="form-control" required>
                        </div>    
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>    
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Quel est votre rôle?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="teacher" value="teacher" required>
                                <label class="form-check-label" for="teacher">
                                    Enseignant
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="student" value="student" required>
                                <label class="form-check-label" for="student">
                                    Etudiant
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="Admin" value="Admin" required>
                                <label class="form-check-label" for="Admin">
                                    Administrateur
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="s'inscrire">
                        </div>
                        <p>Vous avez déjà un compte? <a href="login.php">Se connecter ici</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
