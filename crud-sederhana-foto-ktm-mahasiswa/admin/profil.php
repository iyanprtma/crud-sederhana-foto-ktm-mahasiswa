<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer Portfolio</title>
    <style>
        body {
    font-family: poppins;
    margin: 0;
    background-color: #eeefff; /* Light purple background */
}

.container {
    
    max-width: 960px;
    margin:auto;
    margin-top:110px;
    padding: 2rem;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
}

nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

nav li {
    margin-left: 2rem;
}

nav a {
    text-decoration: none;
    color: #333;
}

.hero {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 2rem;
}

.hero-text {
    flex: 1;
    margin-right: 2rem;
}

.hero-text h1 {
    font-size: 3rem;
    margin-bottom: 0.5rem;
}

.hero-text p {
    font-size: 1.2rem;
    line-height: 1.6;
}

.hero-image {
    flex: 1;
    text-align: center;
}

.hero-image img {
    margin-top: 80px;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    object-fit: cover;
    border: 10px solid #4e73df; /* Purple border */
}

button {
    background-color: #4e73df; /* Purple button */
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    margin-right: 1rem;
    color:white;
}
a {
    color:white;
    text-decoration:none;
}
        </style>
</head>
<body>
 
    <div class="container">
        <header>
            <div class="logo">
                <!-- <span style="font-weight: bold; font-size: 1.5rem;">Rey Developer.</span> -->
            </div>
            <!-- <nav>
                <ul>
                    <li><a href="#">home</a></li>
                    <li><a href="#">about</a></li>
                    <li><a href="#">portfolio</a></li>
                    <li><a href="#">products</a></li>
                    <li><a href="#">pages</a></li>
                    <li><a href="#">cart <span style="background-color: #673ab7; color: white; padding: 2px 5px; border-radius: 50%;">1</span></a></li>
                </ul> -->
            </nav>
            <!-- <button>contact</button> -->
        </header>

        <section class="hero">
            <div class="hero-text">
                <h1>Rey Developer<br></h1>
                <p>Hanya hobi kecil, bukan bisa tapi terbiasa. <br> Sebuah ketikan menjadikan hal yang berguna <br> adalah perinsip saya.</p>
                <button><a href="../index.php">HOME</button></a>
                <button><a href="https://wa.me:/+628">CONTACT ME</button></a>
            </div>
            <div class="hero-image">
                <img src="../img/pp.jpg" alt="John Moore"> </div>
        </section>
    </div>
</body>
</html>
