<template>
    <header>
        <div class="inline-flex flex-row justify-between w-full">
            <div class="columns-1">  
                <h1 class="logo logo-20">AUTOBAHN.SK</h1>
            </div>
            <div class="columns-1">
                <nav class="inline-flex space-x-7">
                    <a class="text-base font-medium">Domov</a>
                    <a class="text-base font-medium">Virtuálny Servis</a>
                    <a class="text-base font-medium">Q&A</a>
                    <a class="text-base font-medium">O Nás</a>
                </nav>
            </div>
            <div class="columns-1">
                <div class="login-button">
                    <a class="text-base font-medium">Prihlásiť sa</a>
                </div>
            </div>
        </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'Header',
  };
  </script>

<style>

header {
    color: white;
}

.login-button::before {
    display: inline-block;
    content: "";
    width: 20px;
    height: 20px;
    background-image: url("../_img/UserIcon.svg");
    background-repeat: no-repeat;
    background-size: contain;
    margin-bottom: -3px;
    margin-right: 5px;
}

</style>