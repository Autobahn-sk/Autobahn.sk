<template>
    <div class="mt-10 md:mt-24 mb-[11.5rem] site-layout">
        <h2 class="subtitle-32 text-center md:text-left leading-10">Naplánujte si Váš servis</h2>
        <div class="flex flex-col md:flex-row w-full justify-between items-start gap-8 mt-10 md:mt-20">
            <div class="flex flex-col bg-[#F9FBFC] border border-[#E1E1E1] rounded-xl w-full h-auto">
                <div class="pt-8 p-auto md:pr-8 md:pl-8 pb-8">
                    <h3 class="text-2xl font-bold text-center md:text-left">Naplánovať servis</h3>
                    <p class="mt-3.5 text-base text-center md:text-left">„Naplánovať servis“ je funkcia, ktorá umožňuje zákazníkom si zarezervovať termín na servis svojho vozidla priamo prostredníctvom online platformy. Táto služba poskytuje pohodlný spôsob,
                         ako sa vyhnúť dlhému čakaniu a zjednodušuje celý proces plánovania.
                    </p>
                    <div class="flex flex-row flex-wrap md:flex-nowrap mt-1 w-full justify-between">
                        <div class="flex flex-col m-auto md:m-0">
                            <div class="relative input-wrap">
                                <input type="text" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                                <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Meno</label>
                            </div>
                            <div class="relative input-wrap">
                                <input type="number" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                                <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Telefón</label>
                            </div>
                            <div class="relative input-wrap">
                                <input type="number" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                                <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Nájazd (voliteľné)</label>
                            </div>
                        </div>
                        <div class="flex flex-col m-auto md:m-0"> 
                            <div class="relative input-wrap">
                                <input type="text" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                                <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">E-mail</label>
                            </div>
                            <div class="relative input-wrap">
                                <input type="text" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                                <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Model</label>
                            </div>
                            <div class="relative input-wrap">
                                <input type="date" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                                <label class="absolute left-[0.9rem] top-[1.5rem] text-gray-400 text-sm">Dátum</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row w-full mt-3.5">
                        <button class="w-full bg-purple text-white py-2.5 hover:opacity-85">Naplánovať</button>
                    </div>
                    <div class="flex flex-row w-full mt-3.5">
                        <p class="text-sm text-center md:text-left">Odoslaním tohto formulára si nezáväzne dohodnete termín servisnej prehliadky 
                            a budeme vás kontaktovať do 48 hodín. servisný poradca.
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col border border-[#E1E1E1] rounded-xl w-full md:w-1/2 h-auto align-top">
                <div class="pl-5 pt-5 pb-5 pr-5">
                    <h5 class="text-lg font-bold">Otváracie hodiny</h5>
                    <div class="flex flex-row mt-5 justify-between">
                        <div class="flex flex-col text-base">
                            <p>Nedeľa</p>
                            <p>Pondelok</p>
                            <p>Utorok</p>
                            <p>Streda</p>
                            <p>Štvrtok</p>
                            <p>Piatok</p>
                            <p>Sobota</p>
                        </div>
                        <div class="flex flex-col text-base font-medium">
                            <p>8:00 - 12:00</p>
                            <p>8:00 - 17:00</p>
                            <p>8:00 - 17:00</p>
                            <p>8:00 - 17:00</p>
                            <p>8:00 - 17:00</p>
                            <p>8:00 - 17:00</p>
                            <p>8:00 - 12:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

.input-wrap label {
    transition: 300ms ease all;
}
      
.input-wrap input:focus ~ label,
.input-wrap input:valid ~ label {
    top: 1.5rem;
    font-size: 0.75rem;
}

@media screen and (max-width: 640px) {
    .ad-site-layout {
        padding-left: 0rem;
        padding-right: 0rem;  
    }
}

</style>