<?php
if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
    header('Location: /home');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous">
    <link rel="icon" href="/favicon.png">
    <title>COSC 4806</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">MyApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavPublic">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavPublic">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      </ul>
      <a href="/login" class="btn btn-outline-warning">Login</a>
    </div>
  </div>
</nav>
