<template>
    <header>
        <div class="inline-flex flex-row justify-between w-full text-white">
            <h1 class="logo logo-20">AUTOBAHN.SK</h1>
            <nav class="inline-flex space-x-7 desktopmenu">
                <a class="font-medium">Domov</a>
                <a href="/servis" class="font-medium">Virtuálny Servis</a>
                <a href="/q&a" class="font-medium">Q&A</a>
                <a class="font-medium">O Nás</a>
            </nav>
            <div class="login-button desktopmenu">
                <a class="font-medium">Prihlásiť sa</a>
            </div>
            <!-- <div class="mobilemenu" id="myTopnav">
                <a href="#home" class="active">Home</a>
                <a href="#news">News</a>
                <a href="#contact">Contact</a>
                <a href="#about">About</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div> -->
        </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'Header',
  };

  </script>

<style scoped>

    .mobilemenu {
        visibility: hidden;
    }

    .desktopmenu {
        visibility: visible;
    }

    .login-button::before {
        display: inline-block;
        content: "";
        width: 1.25rem;
        height: 1.25rem;
        background-image: url("../_img/UserIcon.svg");
        background-repeat: no-repeat;
        background-size: contain;
        margin-bottom: -0.18rem;
        margin-right: 0.3rem;
    }

    a:hover{
        cursor: pointer;
        color: #E9E9E9;
    }

    @media only screen and (max-width: 600px) {

        .desktopmenu {
            visibility: hidden;
        }

        .mobilemenu {
            visibility: visible;
            background-color: #333;
            overflow: hidden;
        }

    }

</style>